@extends('layouts.app')

@section('header', 'Pengumuman & Informasi')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Daftar Informasi Internal</h3>
        @role('Admin')
        <a href="{{ route('information.create') }}" class="px-4 py-2 bg-gold hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
            + Tambah Informasi
        </a>
        @endrole
    </div>
    
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 uppercase font-semibold text-xs">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Tipe & Judul</th>
                    <th class="px-6 py-4">Konten Singkat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($information as $info)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-800 whitespace-nowrap">
                            {{ $info->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full bg-slate-100 text-slate-600 mb-1">
                                {{ $info->tipe_info }}
                            </span>
                            <div class="font-medium text-slate-800">{{ $info->judul }}</div>
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::limit($info->konten_teks, 60) ?: '-' }}
                            @if($info->url_media)
                                <div class="mt-1"><a href="{{ $info->url_media }}" target="_blank" class="text-xs text-blue-500 hover:underline">Lampiran Media</a></div>
                            @endif
                        </td>
                        @role('Admin')
                        <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                            <a href="{{ route('information.edit', $info) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs">Edit</a>
                            <form action="{{ route('information.destroy', $info) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus informasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs">Hapus</button>
                            </form>
                        </td>
                        @endrole
                        @role('Staff WO')
                        <td class="px-6 py-4 text-right">
                            <button onclick="showInfoDetail('{{ $info->judul }}', '{{ $info->tipe_info }}', '{{ addslashes($info->konten_teks) }}', '{{ $info->created_at->format('d M Y') }}', '{{ $info->url_media }}')" 
                                class="text-blue-600 hover:text-blue-800 transition-colors p-2 rounded-full hover:bg-blue-50" title="Lihat Pengumuman">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </td>
                        @endrole
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada data informasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($information->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $information->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<div id="modalInfo" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative z-10">
            <div class="bg-white px-6 pt-6 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <div class="flex justify-between items-start border-b border-slate-100 pb-3">
                            <div>
                                <span id="modalInfoType" class="inline-block px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full bg-slate-100 text-slate-600 mb-1"></span>
                                <h3 class="text-xl leading-6 font-bold text-slate-800 font-heading" id="modalInfoTitle"></h3>
                            </div>
                            <span id="modalInfoDate" class="text-xs text-slate-400"></span>
                        </div>
                        <div class="mt-4 space-y-4">
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Isi Pengumuman</p>
                                <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-xl border border-slate-100" id="modalInfoContent"></p>
                            </div>
                            <div id="modalInfoLinkContainer" class="hidden">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Lampiran Media</p>
                                <a id="modalInfoLink" href="#" target="_blank" class="inline-flex items-center text-sm text-blue-600 hover:underline">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    Buka File Lampiran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeInfoModal()" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-slate-800 text-base font-medium text-white hover:bg-slate-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showInfoDetail(title, type, content, date, link) {
        document.getElementById('modalInfoTitle').innerText = title;
        document.getElementById('modalInfoType').innerText = type;
        document.getElementById('modalInfoContent').innerText = content || '-';
        document.getElementById('modalInfoDate').innerText = date;
        
        const linkContainer = document.getElementById('modalInfoLinkContainer');
        const linkEl = document.getElementById('modalInfoLink');
        if(link && link !== '') {
            linkEl.href = link;
            linkContainer.classList.remove('hidden');
        } else {
            linkContainer.classList.add('hidden');
        }
        
        document.getElementById('modalInfo').classList.remove('hidden');
    }

    function closeInfoModal() {
        document.getElementById('modalInfo').classList.add('hidden');
    }

    // Close on click outside
    window.onclick = function(event) {
        let modalPackage = document.getElementById('modalDetail');
        let modalInfo = document.getElementById('modalInfo');
        if (event.target == modalPackage) modalPackage.classList.add('hidden');
        if (event.target == modalInfo) modalInfo.classList.add('hidden');
    }
</script>
@endpush
