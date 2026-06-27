@extends('layouts.app')

@section('header', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-4 transition-transform hover:-translate-y-1 duration-300">
        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Total Klien</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $totalClients }}</h3>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-4 transition-transform hover:-translate-y-1 duration-300">
        <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Total Pesanan</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $totalOrders }}</h3>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-4 transition-transform hover:-translate-y-1 duration-300">
        <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Pesanan Pending</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $pendingOrders }}</h3>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading flex items-center gap-2">
            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Jadwal Acara Terdekat
        </h3>
        <a href="{{ route('orders.index') }}" class="text-sm text-gold hover:text-yellow-600 font-medium">Lihat Semua</a>
    </div>
    <div class="p-0">
        @if($upcomingEvents->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-semibold text-xs">
                        <tr>
                            <th class="px-6 py-4">Tanggal Acara</th>
                            <th class="px-6 py-4">Klien</th>
                            <th class="px-6 py-4">Paket</th>
                            <th class="px-6 py-4">Status Pesanan</th>
                            <th class="px-6 py-4">Status Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($upcomingEvents as $event)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-800">
                                    {{ \Carbon\Carbon::parse($event->tanggal_acara)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">{{ $event->client->nama_klien ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $event->package->nama_paket ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                                        {{ $event->status_pesanan == 'Selesai' ? 'bg-emerald-100 text-emerald-700' : 
                                          ($event->status_pesanan == 'Pending' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                                        {{ $event->status_pesanan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                                        {{ $event->status_pembayaran == 'Lunas' ? 'bg-emerald-100 text-emerald-700' : 
                                          ($event->status_pembayaran == 'DP' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $event->status_pembayaran }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-8 text-center text-slate-500">
                <div class="inline-block p-4 rounded-full bg-slate-50 mb-3">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <p>Belum ada jadwal acara terdekat.</p>
            </div>
        @endif
    </div>
</div>
@endsection
