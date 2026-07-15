@extends('layouts.app')
@section('title', 'Unggah Dokumen')

@section('content')
<div class="mb-6">
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-500 p-8 shadow-xl">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24 pointer-events-none"></div>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg flex-shrink-0">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-white">Unggah Dokumen</h1>
                <p class="text-emerald-100 text-sm font-medium">Tambahkan dokumen ke proyek</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 max-w-2xl">
    <div class="mb-6 pb-6 border-b border-gray-100">
        <p class="text-sm text-gray-500 font-medium">Proyek:</p>
        <p class="text-lg font-extrabold text-gray-900">{{ $proyek->nama_proyek }}</p>
    </div>

    <form method="POST" action="{{ route('dokumen.store', $proyek) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="text-sm font-semibold text-gray-700 mb-1.5 block">Nama Dokumen <span class="text-red-500">*</span></label>
            <div class="relative">
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input type="text" name="nama_dokumen" value="{{ old('nama_dokumen') }}" required
                    class="w-full pl-11 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all text-sm"
                    placeholder="Contoh: Kontrak Kerja">
            </div>
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700 mb-1.5 block">Jenis Dokumen</label>
            <div class="relative">
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <input type="text" name="jenis_dokumen" value="{{ old('jenis_dokumen') }}"
                    class="w-full pl-11 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all text-sm"
                    placeholder="Kontrak, Izin, Foto, Laporan, dll">
            </div>
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700 mb-1.5 block">Berkas <span class="text-red-500">*</span></label>
            <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-emerald-400 transition-colors group">
                <svg class="w-14 h-14 mx-auto text-gray-300 group-hover:text-emerald-400 mb-3 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                <input type="file" name="berkas" required id="berkas"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <p class="text-sm text-gray-600 font-medium" id="file-label">Klik atau seret berkas ke sini</p>
                <p class="text-xs text-gray-400 mt-1">Format: PDF, JPG, PNG, DOC, max 10MB</p>
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit"
                class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white font-bold px-6 py-3.5 rounded-xl text-sm shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Unggah Dokumen
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
document.getElementById('berkas').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name;
    const label = document.getElementById('file-label');
    if (fileName) {
        label.textContent = '📎 ' + fileName;
        label.classList.add('text-emerald-600', 'font-semibold');
    } else {
        label.textContent = 'Klik atau seret berkas ke sini';
        label.classList.remove('text-emerald-600', 'font-semibold');
    }
});
</script>
@endsection