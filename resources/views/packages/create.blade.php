@extends('layouts.app')

@section('header', 'Tambah Katalog Paket')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Form Paket Baru</h3>
    </div>
    
    <form action="{{ route('packages.store') }}" method="POST" class="p-6 space-y-5">
        @csrf
        
        <div>
            <label for="nama_paket" class="block text-sm font-medium text-slate-700 mb-1">Nama Paket <span class="text-red-500">*</span></label>
            <input type="text" name="nama_paket" id="nama_paket" value="{{ old('nama_paket') }}" required
                class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors"
                placeholder="Cth: Paket Diamond Intimate">
            @error('nama_paket') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="harga" class="block text-sm font-medium text-slate-700 mb-1">Harga Dasar (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="harga" id="harga" value="{{ old('harga') }}" required min="0" step="1000"
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors"
                    placeholder="Cth: 25000000">
                @error('harga') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="status_aktif" class="block text-sm font-medium text-slate-700 mb-1">Status Ketersediaan <span class="text-red-500">*</span></label>
                <select name="status_aktif" id="status_aktif" required
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                    <option value="Aktif" {{ old('status_aktif') == 'Aktif' ? 'selected' : '' }}>Aktif (Tersedia)</option>
                    <option value="Nonaktif" {{ old('status_aktif') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif (Disembunyikan)</option>
                </select>
                @error('status_aktif') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi & Fasilitas</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors"
                placeholder="Rincian fasilitas yang didapatkan dari paket ini...">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4 flex items-center space-x-3">
            <button type="submit" class="px-5 py-2.5 bg-gold hover:bg-yellow-600 text-white font-medium rounded-lg shadow-sm transition-colors">
                Simpan Paket
            </button>
            <a href="{{ route('packages.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
