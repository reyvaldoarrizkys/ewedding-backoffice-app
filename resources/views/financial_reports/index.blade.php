@extends('layouts.app')

@section('header', 'Laporan Keuangan')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-emerald-100">
        <p class="text-sm font-medium text-emerald-600 mb-1">Total Pemasukan</p>
        <h3 class="text-2xl font-bold text-slate-800">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-red-100">
        <p class="text-sm font-medium text-red-600 mb-1">Total Pengeluaran</p>
        <h3 class="text-2xl font-bold text-slate-800">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
    </div>
    <div class="bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-800 text-white relative overflow-hidden">
        <div class="absolute -right-6 -bottom-6 opacity-10">
            <svg class="w-32 h-32 text-gold" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
        </div>
        <p class="text-sm font-medium text-slate-400 mb-1">Saldo Kas / Laba</p>
        <h3 class="text-2xl font-bold {{ $saldoAkhir >= 0 ? 'text-gold' : 'text-red-400' }}">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</h3>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Buku Besar Transaksi</h3>
        <div class="flex space-x-3">
            <button onclick="window.print()" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors flex items-center print:hidden">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
            </button>
            <a href="{{ route('financial-reports.create') }}" class="px-4 py-2 bg-gold hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition-colors print:hidden">
                + Catat Transaksi Kas
            </a>
        </div>
    </div>
    
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 uppercase font-semibold text-xs">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Deskripsi / Keterangan</th>
                    <th class="px-6 py-4">Terkait Pesanan</th>
                    <th class="px-6 py-4 text-right">Jumlah (Rp)</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($reports as $report)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($report->tanggal_transaksi)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($report->jenis_transaksi == 'Pemasukan')
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-700">Pemasukan</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-red-100 text-red-700">Pengeluaran</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $report->deskripsi }}</td>
                        <td class="px-6 py-4 text-xs">
                            @if($report->order)
                                <a href="{{ route('orders.edit', $report->order_id) }}" class="text-blue-600 hover:underline">
                                    Order #{{ str_pad($report->order_id, 4, '0', STR_PAD_LEFT) }}<br>
                                    <span class="text-slate-500">{{ $report->order->client->nama_klien ?? '' }}</span>
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right font-semibold {{ $report->jenis_transaksi == 'Pemasukan' ? 'text-emerald-600' : 'text-red-600' }}">
                            {{ $report->jenis_transaksi == 'Pemasukan' ? '+' : '-' }} {{ number_format($report->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                            <a href="{{ route('financial-reports.edit', $report) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs">Edit</a>
                            <form action="{{ route('financial-reports.destroy', $report) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus catatan transaksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">Belum ada catatan transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($reports->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $reports->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<style>
    @media print {
        aside, header, .print\:hidden, form, .text-right.space-x-2 {
            display: none !important;
        }
        main {
            padding: 0 !important;
            background: white !important;
        }
        .bg-gray-50, .bg-slate-50 {
            background-color: white !important;
        }
        .rounded-2xl, .shadow-sm {
            border-radius: 0 !important;
            shadow: none !important;
            border: 1px solid #eee !important;
        }
        table {
            border-collapse: collapse !important;
        }
        th, td {
            border: 1px solid #eee !important;
        }
        .flex-1 {
            overflow: visible !important;
        }
    }
</style>
@endpush
