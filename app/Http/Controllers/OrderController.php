<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Package;
use App\Models\FinancialReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['client', 'package'])->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Client::all();
        $packages = Package::where('status_aktif', 'Aktif')->get();
        return view('orders.create', compact('clients', 'packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id|unique:orders,client_id',
            'package_id' => 'required|exists:packages,id',
            'biaya_tambahan' => 'nullable|numeric|min:0',
            'keterangan_tambahan' => 'nullable|string|max:255',
            'tanggal_pesan' => 'required|date',
            'tanggal_acara' => 'required|date|after_or_equal:tanggal_pesan',
            'status_pesanan' => 'required|in:Pending,Dikonfirmasi,Selesai,Batal',
            'status_pembayaran' => 'required|in:Belum Lunas,DP,Lunas',
        ], [
            'client_id.unique' => 'Klien ini sudah memiliki pesanan aktif. Satu klien hanya bisa didaftarkan pada satu pesanan.',
        ]);

        $package = Package::findOrFail($validated['package_id']);
        $biayaTambahan = $validated['biaya_tambahan'] ?? 0;
        $validated['biaya_tambahan'] = $biayaTambahan;
        $validated['total_harga'] = $package->harga + $biayaTambahan;
        $validated['user_id'] = Auth::id(); // Mencatat siapa staff yang menginput

        $order = Order::create($validated);

        // Logika otomatis pembayaran (DP 50% / Lunas 100%)
        if ($validated['status_pembayaran'] === 'DP') {
            $nominal = $validated['total_harga'] * 0.5;
            $order->payments()->create([
                'tanggal_bayar' => now(),
                'jumlah_bayar' => $nominal,
                'metode_pembayaran' => 'Otomatis (Sistem DP 50%)',
            ]);
            FinancialReport::create([
                'jenis_transaksi' => 'Pemasukan',
                'deskripsi' => 'Pembayaran DP 50% Pesanan #' . str_pad($order->id, 4, '0', STR_PAD_LEFT) . ' - ' . $order->client->nama_klien,
                'jumlah' => $nominal,
                'tanggal_transaksi' => now(),
                'order_id' => $order->id
            ]);
        } elseif ($validated['status_pembayaran'] === 'Lunas') {
            $nominal = $validated['total_harga'];
            $order->payments()->create([
                'tanggal_bayar' => now(),
                'jumlah_bayar' => $nominal,
                'metode_pembayaran' => 'Otomatis (Sistem Lunas 100%)',
            ]);
            FinancialReport::create([
                'jenis_transaksi' => 'Pemasukan',
                'deskripsi' => 'Pembayaran Lunas 100% Pesanan #' . str_pad($order->id, 4, '0', STR_PAD_LEFT) . ' - ' . $order->client->nama_klien,
                'jumlah' => $nominal,
                'tanggal_transaksi' => now(),
                'order_id' => $order->id
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function show(Order $order)
    {
        $order->load(['client', 'package']);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load('payments');
        $clients = Client::all();
        $packages = Package::all(); // Show all packages including non-active in edit in case they picked it before
        return view('orders.edit', compact('order', 'clients', 'packages'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id|unique:orders,client_id,' . $order->id,
            'package_id' => 'required|exists:packages,id',
            'biaya_tambahan' => 'nullable|numeric|min:0',
            'keterangan_tambahan' => 'nullable|string|max:255',
            'tanggal_pesan' => 'required|date',
            'tanggal_acara' => 'required|date',
            'status_pesanan' => 'required|in:Pending,Dikonfirmasi,Selesai,Batal',
            'status_pembayaran' => 'required|in:Belum Lunas,DP,Lunas',
        ], [
            'client_id.unique' => 'Klien ini sudah memiliki pesanan lain. Satu klien hanya bisa didaftarkan pada satu pesanan.',
        ]);

        $package = Package::findOrFail($validated['package_id']);
        $biayaTambahan = $validated['biaya_tambahan'] ?? 0;
        $validated['biaya_tambahan'] = $biayaTambahan;
        $validated['total_harga'] = $package->harga + $biayaTambahan;

        $order->update($validated);

        // Logika penyesuaian pembayaran otomatis
        $totalDibayar = $order->payments()->sum('jumlah_bayar');

        if ($validated['status_pembayaran'] === 'DP' && $totalDibayar < ($validated['total_harga'] * 0.5)) {
            $kurang = ($validated['total_harga'] * 0.5) - $totalDibayar;
            $order->payments()->create([
                'tanggal_bayar' => now(),
                'jumlah_bayar' => $kurang,
                'metode_pembayaran' => 'Otomatis Penyesuaian (Sistem DP 50%)',
            ]);
            FinancialReport::create([
                'jenis_transaksi' => 'Pemasukan',
                'deskripsi' => 'Penyesuaian DP 50% Pesanan #' . str_pad($order->id, 4, '0', STR_PAD_LEFT) . ' - ' . $order->client->nama_klien,
                'jumlah' => $kurang,
                'tanggal_transaksi' => now(),
                'order_id' => $order->id
            ]);
        } elseif ($validated['status_pembayaran'] === 'Lunas' && $totalDibayar < $validated['total_harga']) {
            $kurang = $validated['total_harga'] - $totalDibayar;
            $order->payments()->create([
                'tanggal_bayar' => now(),
                'jumlah_bayar' => $kurang,
                'metode_pembayaran' => 'Otomatis Penyesuaian (Sistem Lunas 100%)',
            ]);
            FinancialReport::create([
                'jenis_transaksi' => 'Pemasukan',
                'deskripsi' => 'Pelunasan 100% Pesanan #' . str_pad($order->id, 4, '0', STR_PAD_LEFT) . ' - ' . $order->client->nama_klien,
                'jumlah' => $kurang,
                'tanggal_transaksi' => now(),
                'order_id' => $order->id
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
