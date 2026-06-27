<?php

namespace App\Http\Controllers;

use App\Models\FinancialReport;
use App\Models\Order;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    public function index()
    {
        $reports = FinancialReport::with('order.client')->latest()->paginate(15);
        
        $totalPemasukan = FinancialReport::where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = FinancialReport::where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;
        
        return view('financial_reports.index', compact('reports', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir'));
    }

    public function create()
    {
        $orders = Order::with('client')->get();
        return view('financial_reports.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_transaksi' => 'required|date',
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'jumlah' => 'required|numeric|min:1',
            'deskripsi' => 'required|string|max:255',
            'order_id' => 'nullable|exists:orders,id',
        ]);

        FinancialReport::create($validated);

        return redirect()->route('financial-reports.index')->with('success', 'Laporan transaksi berhasil dicatat.');
    }

    public function show(FinancialReport $financialReport)
    {
        // $financialReport->load('order.client');
        // return view('financial_reports.show', compact('financialReport'));
        return redirect()->route('financial-reports.index');
    }

    public function edit(FinancialReport $financialReport)
    {
        $orders = Order::with('client')->get();
        return view('financial_reports.edit', compact('financialReport', 'orders'));
    }

    public function update(Request $request, FinancialReport $financialReport)
    {
        $validated = $request->validate([
            'tanggal_transaksi' => 'required|date',
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'jumlah' => 'required|numeric|min:1',
            'deskripsi' => 'required|string|max:255',
            'order_id' => 'nullable|exists:orders,id',
        ]);

        $financialReport->update($validated);

        return redirect()->route('financial-reports.index')->with('success', 'Laporan transaksi berhasil diperbarui.');
    }

    public function destroy(FinancialReport $financialReport)
    {
        $financialReport->delete();
        return redirect()->route('financial-reports.index')->with('success', 'Laporan transaksi berhasil dihapus.');
    }
}
