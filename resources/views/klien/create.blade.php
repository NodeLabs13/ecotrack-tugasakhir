@extends('layouts.app')
@section('title', 'Tambah Klien')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header Card -->
    <div class="bg-gradient-to-r from-primary-600 to-accent-500 rounded-2xl shadow-lg p-6 mb-6 text-white">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold">Tambah Klien Baru</h2>
                <p class="text-primary-100 text-sm mt-1">Lengkapi data klien dengan detail</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <form method="POST" action="{{ route('klien.store') }}" class="space-y-6">
            @csrf
            
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Nama Klien <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input type="text" name="nama_klien" value="{{ old('nama_klien') }}" required
                        class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                        placeholder="Nama lengkap klien">
                </div>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Nama Perusahaan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                        class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                        placeholder="PT. Nama Perusahaan">
                </div>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Alamat</label>
                <textarea name="alamat" rows="3" 
                    class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                    placeholder="Alamat lengkap perusahaan">{{ old('alamat') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">No. Telepon</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                            placeholder="08xx-xxxx-xxxx">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">Email <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                            placeholder="email@perusahaan.com">
                    </div>
                </div>
            </div>

            {{-- Password --}}
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-2 block">Password Akun Login <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input type="password" name="password" required minlength="6"
                        class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-sm"
                        placeholder="Minimal 6 karakter">
                </div>
                <p class="text-xs text-gray-400 mt-1.5">Password ini akan digunakan klien untuk login ke aplikasi</p>
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-accent-500 hover:from-primary-700 hover:to-accent-600 text-white font-bold px-6 py-3.5 rounded-xl text-sm shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Klien
                </button>
                <a href="{{ route('klien.index') }}" class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2">
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
