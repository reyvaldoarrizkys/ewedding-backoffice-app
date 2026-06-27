@extends('layouts.app')

@section('header', 'Edit Akun Pengguna')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Edit Akun: {{ $user->name }}</h3>
    </div>
    
    <form action="{{ route('users.update', $user) }}" method="POST" class="p-6 space-y-5">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Hak Akses (Role) <span class="text-red-500">*</span></label>
            <select name="role" id="role" required
                class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ (old('role') == $role->name || $user->hasRole($role->name)) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="border-t border-slate-100 pt-5 mt-5">
            <h4 class="text-sm font-semibold text-slate-800 mb-4">Ganti Password (Opsional)</h4>
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors"
                    placeholder="Biarkan kosong jika tidak ingin mengganti password">
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="pt-4 flex items-center space-x-3">
            <button type="submit" class="px-5 py-2.5 bg-gold hover:bg-yellow-600 text-white font-medium rounded-lg shadow-sm transition-colors">
                Perbarui Akun
            </button>
            <a href="{{ route('users.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
