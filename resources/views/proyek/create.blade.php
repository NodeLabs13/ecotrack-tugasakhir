@extends('layouts.app')
@section('title', 'Tambah Proyek')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header Card -->
    <div class="bg-gradient-to-r from-primary-600 to-accent-500 rounded-2xl shadow-lg p-6 mb-6 text-white">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold">Tambah Proyek Baru</h2>
                <p class="text-primary-100 text-sm mt-1">Lengkapi informasi proyek dengan detail</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <form method="POST" action="{{ route('proyek.store') }}" class="space-y-6">
            @csrf
            
            <!-- Kode Proyek -->
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Kode Proyek <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                        </svg>
                    </div>
                    <input type="text" name="kode_proyek" value="{{ old('kode_proyek') }}" required
                        class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                        placeholder="Contoh: PRJ-2024-001">
                </div>
            </div>

            <!-- Nama Proyek -->
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Nama Proyek <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <input type="text" name="nama_proyek" value="{{ old('nama_proyek') }}" required
                        class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                        placeholder="Masukkan nama proyek">
                </div>
            </div>

            <!-- Kategori Proyek (hanya untuk role admin) -->
            @if(auth()->user()->role === 'admin')
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Kategori Proyek <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <select name="kategori" required class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm appearance-none bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(\App\Models\Proyek::$kategoriRoles as $kategori => $roles)
                            <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <p class="text-xs text-gray-400 mt-2">Kategori akan menentukan role mana yang dapat melihat proyek ini.</p>
            </div>
            @endif

            <!-- Klien -->
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Klien <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <select name="klien_id" required class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm appearance-none bg-white">
                        <option value="">-- Pilih Klien --</option>
                        @foreach($kliens as $k)
                            <option value="{{ $k->id }}" {{ old('klien_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_klien }} ({{ $k->nama_perusahaan }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Lokasi Proyek -->
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Lokasi Proyek</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="lokasi_proyek" value="{{ old('lokasi_proyek') }}"
                        class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                        placeholder="Contoh: Jakarta Selatan">
                </div>
            </div>

            <!-- Deskripsi Proyek -->
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Deskripsi Proyek</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                    placeholder="Jelaskan detail proyek...">{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">Tanggal Mulai</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm">
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">Tanggal Target Selesai</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm">
                    </div>
                </div>
            </div>

            <!-- Status Proyek -->
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Status Proyek</label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary-500 transition-all">
                        <input type="radio" name="status_proyek" value="berjalan" checked class="mr-3">
                        <div>
                            <p class="font-semibold text-sm text-gray-800">Berjalan</p>
                            <p class="text-xs text-gray-500">Sedang dikerjakan</p>
                        </div>
                    </label>
                    <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-amber-500 transition-all">
                        <input type="radio" name="status_proyek" value="tertunda" class="mr-3">
                        <div>
                            <p class="font-semibold text-sm text-gray-800">Tertunda</p>
                            <p class="text-xs text-gray-500">Ditunda sementara</p>
                        </div>
                    </label>
                    <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-all">
                        <input type="radio" name="status_proyek" value="selesai" class="mr-3">
                        <div>
                            <p class="font-semibold text-sm text-gray-800">Selesai</p>
                            <p class="text-xs text-gray-500">Sudah selesai</p>
                        </div>
                    </label>
                </div>
            </div>


            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-accent-500 hover:from-primary-700 hover:to-accent-600 text-white font-bold px-6 py-3.5 rounded-xl text-sm shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Proyek
                </button>
                <a href="{{ route('proyek.index') }}" class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection