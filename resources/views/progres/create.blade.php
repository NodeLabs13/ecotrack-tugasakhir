@extends('layouts.app')
@section('title', 'Catat Progres Proyek')

@section('content')
<div class="mb-6">
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-500 p-8 shadow-xl">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24 pointer-events-none"></div>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg flex-shrink-0">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-white">Catat Progres Proyek</h1>
                <p class="text-emerald-100 text-sm font-medium">Update perkembangan pekerjaan proyek</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 max-w-2xl">
    <div class="mb-6 pb-6 border-b border-gray-100">
        <p class="text-sm text-gray-500 font-medium">Proyek:</p>
        <p class="text-lg font-extrabold text-gray-900">{{ $proyek->nama_proyek }}</p>
    </div>

    <form method="POST" action="{{ route('progres.store', $proyek) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div>
            <label class="text-sm font-semibold text-gray-700 mb-1.5 block">Tanggal Progres</label>
            <div class="relative">
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input type="date" name="tanggal_progres" value="{{ old('tanggal_progres', now()->toDateString()) }}" required
                    class="w-full pl-11 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all text-sm">
            </div>
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700 mb-1.5 block">Uraian Pekerjaan</label>
            <div class="relative">
                <div class="absolute left-3.5 top-3.5 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <textarea name="uraian_pekerjaan" rows="4" 
                    class="w-full pl-11 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all text-sm resize-none"
                    placeholder="Jelaskan detail pekerjaan yang telah diselesaikan...">{{ old('uraian_pekerjaan') }}</textarea>
            </div>
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700 mb-1.5 block">Dokumentasi Foto <span class="text-xs text-gray-400 font-normal">(Opsional)</span></label>
            <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-emerald-400 transition-colors group">
                <svg class="w-14 h-14 mx-auto text-gray-300 group-hover:text-emerald-400 mb-3 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <input type="file" name="dokumentasi" accept="image/*" id="dokumentasi"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <p class="text-sm text-gray-600 font-medium" id="file-label">Klik atau seret foto ke sini</p>
                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, max 5MB</p>
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" 
                class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white font-bold px-6 py-3.5 rounded-xl text-sm shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Progres
            </button>
            <a href="{{ route('proyek.show', $proyek) }}" 
                class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </a>
        </div>
    </form>
</div>

<script>
document.getElementById('dokumentasi').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name;
    const label = document.getElementById('file-label');
    if (fileName) {
        label.textContent = '📎 ' + fileName;
        label.classList.add('text-emerald-600', 'font-semibold');
    } else {
        label.textContent = 'Klik atau seret foto ke sini';
        label.classList.remove('text-emerald-600', 'font-semibold');
    }
});
</script>
@endsection