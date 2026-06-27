@extends('layouts.app')

@section('header', 'Edit Transaksi Kas')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Edit Laporan Transaksi</h3>
    </div>
    
    <form action="{{ route('financial-reports.update', $financialReport) }}" method="POST" class="p-6 space-y-5">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="tanggal_transaksi" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Transaksi <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="{{ old('tanggal_transaksi', \Carbon\Carbon::parse($financialReport->tanggal_transaksi)->format('Y-m-d')) }}" required
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                @error('tanggal_transaksi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="jenis_transaksi" class="block text-sm font-medium text-slate-700 mb-1">Jenis Arus Kas <span class="text-red-500">*</span></label>
                <select name="jenis_transaksi" id="jenis_transaksi" required
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                    <option value="Pemasukan" {{ old('jenis_transaksi', $financialReport->jenis_transaksi) == 'Pemasukan' ? 'selected' : '' }}>Pemasukan (Uang Masuk)</option>
                    <option value="Pengeluaran" {{ old('jenis_transaksi', $financialReport->jenis_transaksi) == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran (Uang Keluar)</option>
                </select>
                @error('jenis_transaksi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="jumlah" class="block text-sm font-medium text-slate-700 mb-1">Jumlah Nominal (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', (int)$financialReport->jumlah) }}" required min="1" step="1"
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                @error('jumlah') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi / Keterangan Transaksi <span class="text-red-500">*</span></label>
                <input type="text" name="deskripsi" id="deskripsi" value="{{ old('deskripsi', $financialReport->deskripsi) }}" required
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="order_id" class="block text-sm font-medium text-slate-700 mb-1">Terkait Pesanan (Opsional)</label>
                <select name="order_id" id="order_id"
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                    <option value="">-- Tidak Terkait Pesanan Tertentu / Pengeluaran Umum --</option>
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}" {{ old('order_id', $financialReport->order_id) == $order->id ? 'selected' : '' }}>
                            Order #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }} - {{ $order->client->nama_klien ?? 'Klien' }}
                        </option>
                    @endforeach
                </select>
                @error('order_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="pt-4 flex items-center space-x-3">
            <button type="submit" class="px-5 py-2.5 bg-gold hover:bg-yellow-600 text-white font-medium rounded-lg shadow-sm transition-colors">
                Perbarui Transaksi
            </button>
            <a href="{{ route('financial-reports.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
