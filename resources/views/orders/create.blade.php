@extends('layouts.app')

@section('header', 'Buat Pesanan Baru')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center space-x-3">
        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        <h3 class="text-lg font-semibold text-slate-800 font-heading">Detail Pesanan (Transaksi)</h3>
    </div>
    
    <form action="{{ route('orders.store') }}" method="POST" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Kiri -->
            <div class="space-y-5">
                <div>
                    <label for="client_id" class="block text-sm font-medium text-slate-700 mb-1">Pilih Klien <span class="text-red-500">*</span></label>
                    <select name="client_id" id="client_id" required
                        class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                        <option value="" disabled selected>-- Pilih Klien --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->nama_klien }} - {{ $client->telepon }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="package_id" class="block text-sm font-medium text-slate-700 mb-1">Pilih Paket Pernikahan <span class="text-red-500">*</span></label>
                    <select name="package_id" id="package_id" required
                        class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                        <option value="" disabled selected data-price="0">-- Pilih Paket --</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" data-price="{{ $package->harga }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                {{ $package->nama_paket }} (Rp {{ number_format($package->harga, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('package_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="biaya_tambahan" class="block text-sm font-medium text-slate-700 mb-1">Nominal Biaya Tambahan (Rp)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-medium">Rp</span>
                        </div>
                        <input type="number" name="biaya_tambahan" id="biaya_tambahan" value="{{ old('biaya_tambahan', 0) }}" min="0" step="1000"
                            class="w-full pl-10 px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors"
                            placeholder="0">
                    </div>
                    @error('biaya_tambahan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="keterangan_tambahan" class="block text-sm font-medium text-slate-700 mb-1">Keterangan Tambahan</label>
                    <textarea name="keterangan_tambahan" id="keterangan_tambahan" rows="2"
                        class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors"
                        placeholder="Contoh: Tambahan transport, custom dekorasi">{{ old('keterangan_tambahan') }}</textarea>
                    @error('keterangan_tambahan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="bg-slate-100 rounded-xl p-4 border border-slate-200">
                    <label for="total_harga" class="block text-sm font-medium text-slate-700 mb-1">Total Harga Akhir <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-slate-600 font-medium">Rp</span>
                        </div>
                        <input type="number" name="total_harga" id="total_harga" value="{{ old('total_harga') }}" required readonly
                            class="w-full pl-10 px-4 py-2.5 bg-slate-200 border border-slate-300 text-slate-900 font-bold rounded-lg cursor-not-allowed outline-none"
                            placeholder="0">
                    </div>
                    <p class="text-xs text-slate-500 mt-2">*Otomatis dihitung (Harga Paket + Biaya Tambahan).</p>
                    @error('total_harga') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="space-y-5">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="tanggal_pesan" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Pesan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_pesan" id="tanggal_pesan" value="{{ old('tanggal_pesan', date('Y-m-d')) }}" required
                            class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                        @error('tanggal_pesan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="tanggal_acara" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Acara <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_acara" id="tanggal_acara" value="{{ old('tanggal_acara') }}" required
                            class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                        @error('tanggal_acara') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="relative">
                    <div class="flex items-center mb-1 group cursor-help w-max">
                        <label for="status_pesanan" class="block text-sm font-medium text-slate-700 cursor-help">Status Pesanan <span class="text-red-500">*</span></label>
                        <svg class="w-4 h-4 ml-2 text-slate-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        
                        <!-- Penjelasan Status Pesanan (Hover) -->
                        <div class="hidden group-hover:block absolute z-50 left-0 top-6 w-72 bg-white border border-slate-200 shadow-xl rounded-lg p-3 text-xs text-slate-600">
                            <p class="font-bold text-slate-800 mb-2 border-b border-slate-200 pb-1">Panduan Status Pesanan:</p>
                            <ul class="space-y-1.5">
                                <li><span class="inline-block w-20 font-semibold text-amber-600">Pending</span>: Tanya-tanya/Booking awal.</li>
                                <li><span class="inline-block w-20 font-semibold text-blue-600">Dikonfirmasi</span>: Vendor di-lock & persiapan.</li>
                                <li><span class="inline-block w-20 font-semibold text-emerald-600">Selesai</span>: Acara berhasil dilaksanakan.</li>
                                <li><span class="inline-block w-20 font-semibold text-red-600">Batal</span>: Acara dibatalkan klien/WO.</li>
                            </ul>
                        </div>
                    </div>

                    <select name="status_pesanan" id="status_pesanan" required
                        class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                        <option value="Pending" {{ old('status_pesanan') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Dikonfirmasi" {{ old('status_pesanan') == 'Dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="Selesai" {{ old('status_pesanan') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Batal" {{ old('status_pesanan') == 'Batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                    @error('status_pesanan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="relative">
                    <div class="flex items-center mb-1 group cursor-help w-max">
                        <label for="status_pembayaran" class="block text-sm font-medium text-slate-700 cursor-help">Status Pembayaran <span class="text-red-500">*</span></label>
                        <svg class="w-4 h-4 ml-2 text-slate-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        
                        <!-- Penjelasan Status Bayar (Hover) -->
                        <div class="hidden group-hover:block absolute z-50 left-0 top-6 w-64 bg-white border border-slate-200 shadow-xl rounded-lg p-3 text-xs text-slate-600">
                            <p class="font-bold text-slate-800 mb-2 border-b border-slate-200 pb-1">Panduan Status Pembayaran:</p>
                            <ul class="space-y-1.5">
                                <li><span class="inline-block w-20 font-semibold text-red-600">Belum Lunas</span>: Belum ada pembayaran.</li>
                                <li><span class="inline-block w-20 font-semibold text-blue-600">DP</span>: Klien sudah membayar uang muka.</li>
                                <li><span class="inline-block w-20 font-semibold text-emerald-600">Lunas</span>: Pembayaran sudah 100%.</li>
                            </ul>
                        </div>
                    </div>
                    <select name="status_pembayaran" id="status_pembayaran" required
                        class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none transition-colors">
                        <option value="Belum Lunas" {{ old('status_pembayaran') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="DP" {{ old('status_pembayaran') == 'DP' ? 'selected' : '' }}>DP (Uang Muka)</option>
                        <option value="Lunas" {{ old('status_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('status_pembayaran') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="pt-8 mt-6 border-t border-slate-100 flex items-center justify-end space-x-4">
            <a href="{{ route('orders.index') }}" class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg transition-colors">
                Batal
            </a>
            <button type="submit" class="px-8 py-2.5 bg-gold hover:bg-yellow-600 text-white font-medium rounded-lg shadow-sm shadow-yellow-500/30 transition-all transform hover:-translate-y-0.5">
                Simpan Pesanan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const packageSelect = document.getElementById('package_id');
        const biayaTambahanInput = document.getElementById('biaya_tambahan');
        const totalHargaInput = document.getElementById('total_harga');

        function calculateTotal() {
            const selectedOption = packageSelect.options[packageSelect.selectedIndex];
            const packagePrice = parseInt(selectedOption.getAttribute('data-price')) || 0;
            const additionalCost = parseInt(biayaTambahanInput.value) || 0;
            
            if (packagePrice > 0) {
                totalHargaInput.value = packagePrice + additionalCost;
                
                totalHargaInput.classList.add('bg-slate-300');
                setTimeout(() => {
                    totalHargaInput.classList.remove('bg-slate-300');
                }, 300);
            } else {
                totalHargaInput.value = '';
            }
        }

        packageSelect.addEventListener('change', calculateTotal);
        biayaTambahanInput.addEventListener('input', calculateTotal);
        
        // Initial calc
        if (packageSelect.value) {
            calculateTotal();
        }
    });
</script>
@endpush
@endsection
