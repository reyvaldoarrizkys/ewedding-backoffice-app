@extends('layouts.app')

@section('header', 'Data Klien')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Daftar Klien</h3>
        <a href="{{ route('clients.create') }}" class="px-4 py-2 bg-gold hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
            + Tambah Klien
        </a>
    </div>
    
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 uppercase font-semibold text-xs">
                <tr>
                    <th class="px-6 py-4">Nama Klien</th>
                    <th class="px-6 py-4">Telepon</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Alamat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($clients as $client)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $client->nama_klien }}</td>
                        <td class="px-6 py-4">{{ $client->telepon ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $client->email ?? '-' }}</td>
                        <td class="px-6 py-4">{{ Str::limit($client->alamat, 30) ?? '-' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('clients.edit', $client) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs">Edit</a>
                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus klien ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data klien.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($clients->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $clients->links() }}
        </div>
    @endif
</div>
@endsection
