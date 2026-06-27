<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Package;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Information;
use App\Models\FinancialReport;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Dummy Clients (5 data)
        $clients = [];
        $clientNames = ['Ayu & Budi', 'Citra & Dika', 'Eka & Fikri', 'Gita & Hadi', 'Intan & Joko'];
        foreach ($clientNames as $index => $name) {
            $clients[] = Client::create([
                'nama_klien' => $name,
                'alamat' => 'Jl. Kebahagiaan No. ' . ($index + 1) . ', Jakarta',
                'telepon' => '08123456789' . $index,
                'email' => strtolower(str_replace([' & ', ' '], '', $name)) . '@example.com',
            ]);
        }

        // 2. Data Dummy Packages (5 data)
        $packages = [];
        $packageData = [
            ['nama' => 'Paket Silver Intimate', 'harga' => 15000000, 'desc' => 'Paket intimate untuk 100 pax. Termasuk dekorasi standar, makeup pengantin, dan dokumentasi foto.'],
            ['nama' => 'Paket Gold Elegance', 'harga' => 35000000, 'desc' => 'Paket elegan untuk 300 pax. Termasuk dekorasi pelaminan, makeup, busana, MC, dan entertainment akustik.'],
            ['nama' => 'Paket Platinum Royal', 'harga' => 65000000, 'desc' => 'Paket mewah untuk 500 pax. Termasuk catering, dekorasi eksklusif, dokumentasi lengkap (video cinematic).'],
            ['nama' => 'Paket Diamond Luxury', 'harga' => 100000000, 'desc' => 'Paket all-in untuk 1000 pax. Venue, catering, dekorasi premium, entertainment band lengkap, dan mobil pengantin.'],
            ['nama' => 'Paket Custom Spesial', 'harga' => 25000000, 'desc' => 'Paket dapat disesuaikan dengan budget klien. Harga awal adalah estimasi dasar.'],
        ];

        foreach ($packageData as $data) {
            $packages[] = Package::create([
                'nama_paket' => $data['nama'],
                'deskripsi' => $data['desc'],
                'harga' => $data['harga'],
                'status_aktif' => 'Aktif',
            ]);
        }

        // 3. Data Dummy Orders (5 data)
        $orders = [];
        $statuses = ['Selesai', 'Selesai', 'Dikonfirmasi', 'Pending', 'Batal'];
        $payStatuses = ['Lunas', 'Lunas', 'DP', 'Belum Lunas', 'Belum Lunas'];

        for ($i = 0; $i < 5; $i++) {
            $tanggalAcara = Carbon::now()->addDays(($i * 15) - 30); // Campuran masa lalu dan masa depan
            
            $biayaTambahan = $i * 1000000;
            $orders[] = Order::create([
                'client_id' => $clients[$i]->id,
                'package_id' => $packages[$i]->id,
                'biaya_tambahan' => $biayaTambahan,
                'keterangan_tambahan' => $biayaTambahan > 0 ? 'Biaya tambahan custom/transport' : null,
                'tanggal_pesan' => $tanggalAcara->copy()->subMonths(3),
                'tanggal_acara' => $tanggalAcara,
                'total_harga' => $packages[$i]->harga + $biayaTambahan,
                'status_pesanan' => $statuses[$i],
                'status_pembayaran' => $payStatuses[$i],
            ]);
        }

        // 4. Data Dummy Payments (5 data)
        foreach ($orders as $index => $order) {
            if ($order->status_pembayaran !== 'Belum Lunas') {
                $jumlahBayar = $order->status_pembayaran === 'Lunas' ? $order->total_harga : $order->total_harga * 0.5; // DP 50%
                Payment::create([
                    'order_id' => $order->id,
                    'tanggal_bayar' => $order->tanggal_pesan->addDays(5),
                    'jumlah_bayar' => $jumlahBayar,
                    'metode_pembayaran' => $index % 2 == 0 ? 'Transfer Bank BCA' : 'Transfer Bank Mandiri',
                    'bukti_pembayaran_url' => null, // Dummy null
                ]);
            } else {
                // Buat payment dengan jumlah 0 atau lewati
                Payment::create([
                    'order_id' => $order->id,
                    'tanggal_bayar' => Carbon::now(),
                    'jumlah_bayar' => 0,
                    'metode_pembayaran' => '-',
                    'bukti_pembayaran_url' => null,
                ]);
            }
        }

        // 5. Data Dummy Financial Reports (5 data)
        $reportTypes = ['Pemasukan', 'Pemasukan', 'Pengeluaran', 'Pemasukan', 'Pengeluaran'];
        for ($i = 0; $i < 5; $i++) {
            $isIncome = $reportTypes[$i] === 'Pemasukan';
            FinancialReport::create([
                'tanggal_transaksi' => Carbon::now()->subDays($i * 5),
                'jenis_transaksi' => $reportTypes[$i],
                'jumlah' => $isIncome ? 15000000 : 5000000,
                'deskripsi' => $isIncome ? 'Pembayaran DP Klien ' . $clients[$i]->nama_klien : 'Belanja bahan dekorasi / operasional',
                'order_id' => $isIncome ? $orders[$i]->id : null, // Hubungkan ke order jika pemasukan
            ]);
        }

        // 6. Data Dummy Information / Pengumuman (5 data)
        for ($i = 1; $i <= 5; $i++) {
            Information::create([
                'tipe_info' => 'Pengumuman',
                'judul' => 'Pengumuman Internal Ke-' . $i,
                'konten_teks' => 'Ini adalah konten detail dari pengumuman ke-' . $i . '. Harap seluruh staf memperhatikan operasional bulan ini.',
                'url_media' => null,
            ]);
        }
    }
}
