@extends('layouts.app')

@section('header', 'Data Pesanan (Order)')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Daftar Transaksi Pesanan</h3>
        <a href="{{ route('orders.create') }}" class="px-4 py-2 bg-gold hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
            + Buat Pesanan Baru
        </a>
    </div>
    
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 uppercase font-semibold text-xs">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Klien & Acara</th>
                    <th class="px-6 py-4">Paket</th>
                    <th class="px-6 py-4">Total Harga</th>
                    <th class="px-6 py-4 relative group cursor-help">
                        <div class="flex items-center gap-2">
                            <span>Status Pesanan</span>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <!-- Popover -->
                        <div class="hidden group-hover:block absolute z-50 mt-2 left-6 w-56 bg-white border border-slate-200 shadow-xl rounded-lg p-3 text-[11px] font-normal text-slate-600 normal-case">
                            <ul class="space-y-1.5">
                                <li><span class="inline-block w-16 font-bold text-amber-600">Pending</span>: Tanya/Booking.</li>
                                <li><span class="inline-block w-16 font-bold text-blue-600">Dikonfirmasi</span>: Vendor Fix & Jalan.</li>
                                <li><span class="inline-block w-16 font-bold text-emerald-600">Selesai</span>: Acara sukses.</li>
                                <li><span class="inline-block w-16 font-bold text-red-600">Batal</span>: Dibatalkan.</li>
                            </ul>
                        </div>
                    </th>
                    <th class="px-6 py-4 relative group cursor-help">
                        <div class="flex items-center gap-2">
                            <span>Status Bayar</span>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <!-- Popover -->
                        <div class="hidden group-hover:block absolute z-50 mt-2 left-6 w-52 bg-white border border-slate-200 shadow-xl rounded-lg p-3 text-[11px] font-normal text-slate-600 normal-case">
                            <ul class="space-y-1.5">
                                <li><span class="inline-block w-16 font-bold text-red-600">Belum Lunas</span>: Belum bayar.</li>
                                <li><span class="inline-block w-16 font-bold text-blue-600">DP</span>: Cicilan masuk.</li>
                                <li><span class="inline-block w-16 font-bold text-emerald-600">Lunas</span>: Lunas 100%.</li>
                            </ul>
                        </div>
                    </th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-800">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-800">{{ $order->client->nama_klien ?? '-' }}</div>
                            <div class="text-xs text-slate-500 mt-1">Acara: {{ \Carbon\Carbon::parse($order->tanggal_acara)->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $order->package->nama_paket ?? '-' }}</td>
                        <td class="px-6 py-4 font-semibold text-gold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                                {{ $order->status_pesanan == 'Selesai' ? 'bg-emerald-100 text-emerald-700' : 
                                  ($order->status_pesanan == 'Pending' ? 'bg-amber-100 text-amber-700' : 
                                  ($order->status_pesanan == 'Batal' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700')) }}">
                                {{ $order->status_pesanan }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                                {{ $order->status_pembayaran == 'Lunas' ? 'bg-emerald-100 text-emerald-700' : 
                                  ($order->status_pembayaran == 'DP' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700') }}">
                                {{ $order->status_pembayaran }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('orders.edit', $order) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs">Edit</a>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500">Belum ada data pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
