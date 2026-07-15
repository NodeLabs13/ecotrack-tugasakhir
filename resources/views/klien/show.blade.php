@extends('layouts.app')
@section('title', 'Detail Klien - ' . $klien->nama_klien)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('klien.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary-600 transition-colors text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke daftar klien
        </a>
    </div>

    <!-- Client Detail Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-600 to-accent-500 px-8 py-6">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-white text-2xl font-bold">
                    {{ substr($klien->nama_klien, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $klien->nama_klien }}</h1>
                    <p class="text-primary-100 text-sm mt-1">{{ $klien->nama_perusahaan ?? 'Perusahaan tidak disebutkan' }}</p>
                </div>
            </div>
        </div>

        <!-- Detail Information -->
        <div class="p-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Informasi Kontak</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-wider text-gray-400">Nama Klien</label>
                        <p class="mt-1.5 text-gray-800 font-medium">{{ $klien->nama_klien }}</p>
                    </div>
                    
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-wider text-gray-400">Perusahaan</label>
                        <p class="mt-1.5 text-gray-800 font-medium">{{ $klien->nama_perusahaan ?? '-' }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-wider text-gray-400">No. Telepon</label>
                        <p class="mt-1.5 text-gray-800 font-medium">{{ $klien->no_telepon ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-wider text-gray-400">Email</label>
                        <p class="mt-1.5 text-gray-800 font-medium">{{ $klien->email ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @if($klien->alamat)
            <div class="mt-8 pt-8 border-t border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Alamat</h2>
                <p class="text-gray-600 leading-relaxed">{{ $klien->alamat }}</p>
            </div>
            @endif

            <!-- Footer Actions -->
            @if(auth()->user()->role === 'admin')
            <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('klien.edit', $klien) }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold rounded-xl transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Data
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Related Projects Section (optional enhancement) -->
    @php
        $proyeks = $klien->proyeks ?? collect();
    @endphp
    @if($proyeks->count() > 0)
    <div class="mt-8 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">Proyek Terkait</h2>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                @foreach($proyeks as $proyek)
                <a href="{{ route('proyek.show', $proyek) }}" class="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-primary-50 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800 group-hover:text-primary-700 transition-colors">{{ $proyek->nama_proyek }}</p>
                            <p class="text-sm text-gray-500">{{ $proyek->lokasi ?? '' }}</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection