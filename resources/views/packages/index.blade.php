@extends('layouts.app')

@section('header', 'Katalog Paket')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Daftar Paket Pernikahan</h3>
        @role('Admin')
        <a href="{{ route('packages.create') }}" class="px-4 py-2 bg-gold hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
            + Tambah Paket
        </a>
        @endrole
    </div>
    
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 uppercase font-semibold text-xs">
                <tr>
                    <th class="px-6 py-4">Nama Paket</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Deskripsi</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($packages as $package)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $package->nama_paket }}</td>
                        <td class="px-6 py-4 text-gold font-semibold">Rp {{ number_format($package->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ Str::limit($package->deskripsi, 40) ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($package->status_aktif == 'Aktif')
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Aktif</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">Nonaktif</span>
                            @endif
                        </td>
                        @role('Admin')
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('packages.edit', $package) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs">Edit</a>
                            <form action="{{ route('packages.destroy', $package) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus paket ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs">Hapus</button>
                            </form>
                        </td>
                        @endrole
                        @role('Staff WO')
                        <td class="px-6 py-4 text-right">
                            <button onclick="showPackageDetail('{{ $package->nama_paket }}', '{{ number_format($package->harga, 0, ',', '.') }}', '{{ addslashes($package->deskripsi) }}', '{{ $package->status_aktif }}')" 
                                class="text-gold hover:text-yellow-600 transition-colors p-2 rounded-full hover:bg-yellow-50" title="Liat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </td>
                        @endrole
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data paket.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($packages->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $packages->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<div id="modalDetail" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative z-10">
            <div class="bg-white px-6 pt-6 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-xl leading-6 font-bold text-slate-800 font-heading border-b border-slate-100 pb-3" id="modalTitle"></h3>
                        <div class="mt-4 space-y-4">
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Harga Paket</p>
                                <p class="text-lg font-bold text-gold" id="modalPrice"></p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Deskripsi Layanan</p>
                                <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line" id="modalDescription"></p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</p>
                                <span id="modalStatus" class="inline-block mt-1 px-2.5 py-1 rounded-full text-xs font-medium"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeModal()" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-slate-800 text-base font-medium text-white hover:bg-slate-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showPackageDetail(name, price, desc, status) {
        document.getElementById('modalTitle').innerText = name;
        document.getElementById('modalPrice').innerText = 'Rp ' + price;
        document.getElementById('modalDescription').innerText = desc || '-';
        
        const statusEl = document.getElementById('modalStatus');
        statusEl.innerText = status;
        if(status === 'Aktif') {
            statusEl.className = 'inline-block mt-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700';
        } else {
            statusEl.className = 'inline-block mt-1 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700';
        }
        
        document.getElementById('modalDetail').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
    }

    // Close on click outside
    window.onclick = function(event) {
        let modal = document.getElementById('modalDetail');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
@endpush
