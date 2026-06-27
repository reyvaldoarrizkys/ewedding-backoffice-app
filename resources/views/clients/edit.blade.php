@extends('layouts.app')

@section('header', 'Edit Data Klien')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Edit Klien: {{ $client->nama_klien }}</h3>
    </div>
    
    <form action="{{ route('clients.update', $client) }}" method="POST" class="p-6 space-y-5">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nama_klien" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap Klien <span class="text-red-500">*</span></label>
            <input type="text" name="nama_klien" id="nama_klien" value="{{ old('nama_klien', $client->nama_klien) }}" required
                class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
            @error('nama_klien') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="telepon" class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon / WA</label>
                <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $client->telepon) }}"
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                @error('telepon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}"
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="alamat" class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
            <textarea name="alamat" id="alamat" rows="3"
                class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">{{ old('alamat', $client->alamat) }}</textarea>
            @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4 flex items-center space-x-3">
            <button type="submit" class="px-5 py-2.5 bg-gold hover:bg-yellow-600 text-white font-medium rounded-lg shadow-sm transition-colors">
                Perbarui Data
            </button>
            <a href="{{ route('clients.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
