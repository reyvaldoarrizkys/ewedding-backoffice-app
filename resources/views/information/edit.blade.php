@extends('layouts.app')

@section('header', 'Edit Informasi')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Edit Informasi</h3>
    </div>
    
    <form action="{{ route('information.update', $information) }}" method="POST" class="p-6 space-y-5">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label for="judul" class="block text-sm font-medium text-slate-700 mb-1">Judul Informasi <span class="text-red-500">*</span></label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $information->judul) }}" required
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                @error('judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="tipe_info" class="block text-sm font-medium text-slate-700 mb-1">Tipe / Kategori <span class="text-red-500">*</span></label>
                <select name="tipe_info" id="tipe_info" required
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                    <option value="Pengumuman" {{ old('tipe_info', $information->tipe_info) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman Internal</option>
                    <option value="SOP" {{ old('tipe_info', $information->tipe_info) == 'SOP' ? 'selected' : '' }}>Standar Operasional (SOP)</option>
                    <option value="Event" {{ old('tipe_info', $information->tipe_info) == 'Event' ? 'selected' : '' }}>Event Tim</option>
                    <option value="Lainnya" {{ old('tipe_info', $information->tipe_info) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('tipe_info') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="url_media" class="block text-sm font-medium text-slate-700 mb-1">Tautan Lampiran (URL Opsional)</label>
                <input type="url" name="url_media" id="url_media" value="{{ old('url_media', $information->url_media) }}"
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                @error('url_media') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="konten_teks" class="block text-sm font-medium text-slate-700 mb-1">Detail Konten / Pesan</label>
                <textarea name="konten_teks" id="konten_teks" rows="5"
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">{{ old('konten_teks', $information->konten_teks) }}</textarea>
                @error('konten_teks') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="pt-4 flex items-center space-x-3">
            <button type="submit" class="px-5 py-2.5 bg-gold hover:bg-yellow-600 text-white font-medium rounded-lg shadow-sm transition-colors">
                Perbarui Informasi
            </button>
            <a href="{{ route('information.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
