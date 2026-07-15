@extends('layouts.app')
@section('title', 'Data Proyek')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div>
        <p class="text-sm text-gray-500">Kelola dan pantau seluruh proyek</p>
        <p class="text-xs text-gray-400 mt-1">Total {{ $proyeks->total() }} proyek ditemukan</p>
    </div>
    <div class="flex items-center gap-3">
        <form action="{{ route('proyek.index') }}" method="GET" class="relative">
            <input type="text" name="search" placeholder="Cari proyek..." value="{{ request('search') }}"
                   class="pl-9 pr-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-400 transition-all w-48 lg:w-56">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            @if(request('search'))
            <a href="{{ route('proyek.index', array_merge(request()->except('search'), ['status' => request('status')])) }}" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </a>
            @endif
        </form>
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('proyek.create') }}" class="bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white text-sm font-bold px-5 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Proyek
        </a>
        @endif
    </div>
</div>

<div class="flex p-1 bg-gray-200/50 rounded-2xl mb-6 w-fit">
    <a href="{{ route('proyek.index') }}" 
       class="px-6 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ !($status) ? 'bg-white text-primary-600 shadow-sm' : 'text-gray-600 hover:text-primary-600' }}">
        Semua
    </a>
    <a href="{{ route('proyek.index', ['status' => 'berjalan']) }}" 
       class="px-6 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ ($status == 'berjalan') ? 'bg-white text-primary-600 shadow-sm' : 'text-gray-600 hover:text-primary-600' }}">
        Berjalan
    </a>
    <a href="{{ route('proyek.index', ['status' => 'tertunda']) }}" 
       class="px-6 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ ($status == 'tertunda') ? 'bg-white text-primary-600 shadow-sm' : 'text-gray-600 hover:text-primary-600' }}">
        Tertunda
    </a>
    <a href="{{ route('proyek.index', ['status' => 'selesai']) }}" 
       class="px-6 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ ($status == 'selesai') ? 'bg-white text-primary-600 shadow-sm' : 'text-gray-600 hover:text-primary-600' }}">
        Selesai
    </a>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <colgroup>
                <col class="w-[110px]">
                <col>
                @unless(auth()->user()->isKlien())
                <col class="w-[180px]">
                @endunless
                <col class="w-[200px]">
                <col class="w-[105px]">
                <col class="w-[240px]">
            </colgroup>
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-600 text-xs uppercase tracking-wider">
                <tr>
                    <th class="text-left px-6 py-4 font-semibold">Kode</th>
                    <th class="text-left px-6 py-4 font-semibold">Nama Proyek</th>
                    @unless(auth()->user()->isKlien())
                    <th class="text-left px-6 py-4 font-semibold">Klien</th>
                    @endunless
                    <th class="text-left px-6 py-4 font-semibold">Lokasi</th>
                    <th class="text-left px-6 py-4 font-semibold">Status</th>
                    <th class="text-center px-6 py-4 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($proyeks as $p)
                <tr class="hover:bg-gradient-to-r hover:from-primary-50/30 hover:to-accent-50/30 transition-all duration-200">
                    <td class="px-6 py-4">
                        <span class="font-bold text-primary-600 text-xs">{{ $p->kode_proyek }}</span>
                    </td>
                    <td class="px-6 py-4 truncate max-w-0">
                        <span class="font-semibold text-gray-800 truncate block text-sm">{{ $p->nama_proyek }}</span>
                    </td>
                    @unless(auth()->user()->isKlien())
                    <td class="px-6 py-4 truncate max-w-0">
                        <div class="flex items-center gap-2 truncate">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-primary-400 to-accent-500 flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">
                                {{ substr($p->klien->nama_klien ?? 'N', 0, 1) }}
                            </div>
                            <span class="text-gray-700 truncate text-sm">{{ $p->klien->nama_klien ?? '-' }}</span>
                        </div>
                    </td>
                    @endunless
                    <td class="px-6 py-4 truncate max-w-0">
                        <div class="flex items-center gap-1.5 text-gray-600 truncate">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="truncate text-sm">{{ $p->lokasi_proyek ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($p->status_proyek == 'selesai')
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 border border-green-200 whitespace-nowrap">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Selesai
                        </span>
                        @elseif($p->status_proyek == 'tertunda')
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700 border border-amber-200 whitespace-nowrap">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tertunda
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-gradient-to-r from-primary-100 to-accent-100 text-primary-700 border border-primary-200 whitespace-nowrap">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Berjalan
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('proyek.show', $p) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold rounded-lg transition-colors text-xs whitespace-nowrap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Detail
                            </a>
                            @if(in_array(auth()->user()->role, ['civil_engineer', 'perizinan_lingkungan', 'admin']))
                            <a href="{{ route('proyek.edit', $p) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold rounded-lg transition-colors text-xs whitespace-nowrap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            @endif
                            @if(auth()->user()->role === 'admin')
                            <form action="{{ route('proyek.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Hapus proyek ini?')">
                                @csrf @method('DELETE')
                                <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 font-semibold rounded-lg transition-colors text-xs whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->isKlien() ? 5 : 6 }}" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 font-medium">Belum ada data proyek</p>
                                <p class="text-sm text-gray-400 mt-1">Proyek akan muncul di sini setelah ditambahkan</p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $proyeks->links() }}</div>
@endsection