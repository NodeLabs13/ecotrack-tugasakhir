@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-500 p-8 shadow-xl">
        {{-- Decorative circles --}}
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-32 translate-x-32 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24 pointer-events-none"></div>
        <div class="absolute inset-0 pointer-events-none opacity-[0.03]"
             style="background-image: radial-gradient(rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 20px 20px;">
        </div>

        <div class="relative flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg flex-shrink-0">
                <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold text-white">Selamat Datang, {{ auth()->user()->name }}!</h2>
                <p class="text-emerald-100 text-sm font-medium">Kelola dan pantau proyek lingkungan Anda</p>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        {{-- Total Proyek --}}
        <div class="stat-glow bg-white rounded-2xl border border-emerald-100 p-6 card-hover shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">Semua</span>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ $totalProyek ?? 0 }}</h3>
            <p class="text-sm text-gray-500 mt-1 font-medium">Total Proyek</p>
        </div>

        {{-- Proyek Aktif --}}
        <div class="stat-glow bg-white rounded-2xl border border-teal-100 p-6 card-hover shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center shadow-lg shadow-teal-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-teal-600 bg-teal-50 px-2.5 py-1 rounded-full border border-teal-100">Aktif</span>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ $proyekAktif ?? 0 }}</h3>
            <p class="text-sm text-gray-500 mt-1 font-medium">Proyek Aktif</p>
        </div>

        {{-- Proyek Selesai --}}
        <div class="stat-glow bg-white rounded-2xl border border-emerald-100 p-6 card-hover shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-500 flex items-center justify-center shadow-lg shadow-emerald-400/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">Selesai</span>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ $proyekSelesai ?? 0 }}</h3>
            <p class="text-sm text-gray-500 mt-1 font-medium">Proyek Selesai</p>
        </div>

        {{-- Total Klien --}}
        <div class="stat-glow bg-white rounded-2xl border border-emerald-100 p-6 card-hover shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">Klien</span>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ $totalKlien ?? 0 }}</h3>
            <p class="text-sm text-gray-500 mt-1 font-medium">Total Klien</p>
        </div>
    </div>

    {{-- Proyek Terbaru --}}
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
        <div class="px-6 py-5 border-b border-gray-50 bg-gradient-to-r from-emerald-50 to-teal-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Proyek Terbaru</h3>
                        <p class="text-xs text-gray-500 font-medium">Daftar proyek terkini</p>
                    </div>
                </div>
                <a href="{{ route('proyek.index') }}"
                   class="text-sm text-emerald-600 hover:text-emerald-800 font-semibold flex items-center gap-1 bg-white px-3 py-1.5 rounded-lg border border-emerald-200 hover:border-emerald-300 transition-all shadow-sm">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($proyekList ?? [] as $proyek)
            <div class="px-6 py-4 hover:bg-emerald-50/30 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                            {{ substr($proyek->nama_proyek, 0, 2) }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 text-sm">{{ $proyek->nama_proyek }}</h4>
                            <p class="text-xs text-gray-500">{{ $proyek->klien->nama_klien ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        @if($proyek->status_proyek === 'berjalan')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Berjalan
                            </span>
                        @elseif($proyek->status_proyek === 'selesai')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Selesai
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600">
                                {{ ucfirst($proyek->status_proyek) }}
                            </span>
                        @endif
                        <a href="{{ route('proyek.show', $proyek) }}"
                           class="text-xs text-emerald-600 hover:text-emerald-800 font-semibold bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors">
                            Detail →
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-12 text-center">
                <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">Belum ada proyek</p>
                <p class="text-sm text-gray-400 mt-1">Mulai dengan membuat proyek baru</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection