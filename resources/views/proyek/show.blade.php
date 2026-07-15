@extends('layouts.app')
@section('title', 'Detail Proyek')

@section('content')
<!-- Header Info Card -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Main Info Card -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-start justify-between mb-5">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2.5 py-1 bg-primary-100 text-primary-700 text-xs font-bold rounded-lg">
                        {{ $proyek->kode_proyek }}
                    </span>
                    @if($proyek->status_proyek == 'selesai')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 border border-green-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Selesai
                    </span>
                    @elseif($proyek->status_proyek == 'tertunda')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700 border border-amber-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tertunda
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-primary-100 to-accent-100 text-primary-700 border border-primary-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Berjalan
                    </span>
                    @endif
                </div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $proyek->nama_proyek }}</h2>
            </div>
        </div>

        <!-- Deskripsi -->
        @if($proyek->deskripsi)
        <div class="mb-5 p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                </svg>
                <p class="text-xs text-gray-500 font-semibold uppercase">Deskripsi Proyek</p>
            </div>
            <p class="text-sm text-gray-700 leading-relaxed">{{ $proyek->deskripsi }}</p>
        </div>
        @endif

        <!-- Kategori -->
        @if($proyek->kategori)
        <div class="mb-5 p-4 bg-gradient-to-r from-primary-50 to-white rounded-xl border border-primary-100">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <p class="text-xs text-primary-600 font-semibold uppercase">Kategori Proyek</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-primary-100 text-primary-700 border border-primary-200">
                {{ $proyek->kategori }}
            </span>
            @if($proyek->assigned_to)
            <div class="mt-2 flex gap-2">
                @foreach($proyek->assigned_to as $role)
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-gray-100 text-gray-600">
                        {{ $role === 'civil_engineer' ? 'Civil Engineer' : 'Perizinan Lingkungan' }}
                    </span>
                @endforeach
            </div>
            @endif
        </div>
        @endif

        <!-- Project Details Grid -->
        <div class="grid grid-cols-2 gap-4 mb-5">
            <div class="bg-gradient-to-br from-primary-50 to-white p-4 rounded-xl border border-primary-100">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="text-xs text-primary-600 font-semibold uppercase">Klien</p>
                </div>
                <p class="font-bold text-gray-800">{{ $proyek->klien->nama_klien ?? '-' }}</p>
            </div>

            <div class="bg-gradient-to-br from-accent-50 to-white p-4 rounded-xl border border-accent-100">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <p class="text-xs text-accent-600 font-semibold uppercase">Lokasi</p>
                </div>
                <p class="font-bold text-gray-800">{{ $proyek->lokasi_proyek ?? '-' }}</p>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-white p-4 rounded-xl border border-green-100">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-xs text-green-600 font-semibold uppercase">Tanggal Mulai</p>
                </div>
                <p class="font-bold text-gray-800">{{ optional($proyek->tanggal_mulai)->format('d M Y') ?? '-' }}</p>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 to-white p-4 rounded-xl border border-emerald-100">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <p class="text-xs text-emerald-600 font-semibold uppercase">Target Selesai</p>
                </div>
                <p class="font-bold text-gray-800">{{ optional($proyek->tanggal_selesai)->format('d M Y') ?? '-' }}</p>
            </div>
        </div>

        <!-- Project Status -->
        <div class="bg-gradient-to-r from-gray-50 to-white p-4 rounded-xl border border-gray-100">
            <div class="flex justify-between items-center">
                <span class="text-sm font-semibold text-gray-700">Status Pekerjaan</span>
                @if($proyek->status_proyek == 'selesai')
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 border border-green-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Selesai
                </span>
                @elseif($proyek->status_proyek == 'tertunda')
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700 border border-amber-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tertunda
                </span>
                @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-primary-100 to-accent-100 text-primary-700 border border-primary-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Berjalan
                </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Buttons Card -->
    <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl shadow-lg border border-gray-100 p-6 flex flex-col justify-center gap-3">
        @if(in_array(auth()->user()->role, ['civil_engineer','perizinan_lingkungan']))
        <a href="{{ route('progres.create', $proyek) }}" class="flex items-center justify-center gap-2 bg-gradient-to-r from-primary-600 to-accent-500 hover:from-primary-700 hover:to-accent-600 text-white font-bold px-5 py-3.5 rounded-xl text-sm shadow-lg hover:shadow-xl transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Catat Progres
        </a>
        @endif
        @if(in_array(auth()->user()->role, ['klien','civil_engineer','perizinan_lingkungan']))
        <a href="{{ route('dokumen.create', $proyek) }}" class="flex items-center justify-center gap-2 bg-white border-2 border-primary-500 text-primary-700 hover:bg-primary-50 font-bold px-5 py-3.5 rounded-xl text-sm transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
            </svg>
            Unggah Dokumen
        </a>
        @endif
        <a href="{{ route('proyek.index') }}" class="flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-3 rounded-xl text-sm transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>
</div>

<!-- Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Riwayat Progres -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 bg-gradient-to-r from-primary-50 to-white border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Riwayat Progres</h3>
                    <p class="text-xs text-gray-500">Timeline pekerjaan proyek</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="max-h-96 overflow-y-auto pr-2">
                @if($proyek->progres->count() > 0)
                    <div class="relative ml-4">
                        <!-- Continuous Timeline Line -->
                        <div class="absolute left-0 top-0 bottom-0 w-0.5 bg-primary-200"></div>
                        
                        @foreach($proyek->progres as $pr)
                        <div class="relative pl-8 pb-8 last:pb-0">
                            <!-- Timeline Dot -->
                            <div class="absolute -left-[7px] top-0 w-4 h-4 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full border-2 border-white shadow-lg z-10"></div>
                            
                            <!-- Content Card -->
                            <div class="bg-gradient-to-r from-gray-50 to-white p-4 rounded-xl border border-gray-100 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold text-primary-600">{{ \Carbon\Carbon::parse($pr->tanggal_progres)->format('d M Y') }}</span>
                                </div>
                                <p class="text-sm text-gray-700 font-medium">{{ $pr->uraian_pekerjaan }}</p>
                                @if($pr->dokumentasi)
                                <img src="{{ asset('storage/' . $pr->dokumentasi) }}" class="mt-3 rounded-lg w-full h-32 object-cover border-2 border-gray-100 shadow-sm">
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-8">
                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500 font-medium">Belum ada catatan progres</p>
                        <p class="text-xs text-gray-400 mt-1">Progres akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Dokumen Proyek -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 bg-gradient-to-r from-accent-50 to-white border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-accent-500 to-primary-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Dokumen Proyek</h3>
                    <p class="text-xs text-gray-500">File dan lampiran proyek</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                @forelse($proyek->dokumen as $d)
                <div class="bg-gradient-to-r from-gray-50 to-white border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all duration-200">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-start gap-3 flex-1 min-w-0">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-100 to-accent-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-800 truncate">{{ $d->nama_dokumen }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <span class="font-semibold">{{ $d->jenis_dokumen ?? 'Dokumen' }}</span> 
                                    · {{ \Carbon\Carbon::parse($d->tanggal_unggah)->format('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">oleh {{ ucfirst(str_replace('_',' ', $d->diunggah_oleh)) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('dokumen.download', $d) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-100 hover:bg-primary-200 text-primary-700 font-semibold rounded-lg transition-colors text-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Unduh
                            </a>
                            @if(in_array(auth()->user()->role, ['civil_engineer','perizinan_lingkungan']))
                            <form action="{{ route('dokumen.destroy', $d) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?')">
                                @csrf @method('DELETE')
                                <button class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 font-semibold rounded-lg transition-colors text-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center py-8">
                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">Belum ada dokumen</p>
                    <p class="text-xs text-gray-400 mt-1">Dokumen akan muncul di sini</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
