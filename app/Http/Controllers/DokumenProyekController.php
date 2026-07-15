<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\DokumenProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenProyekController extends Controller
{
    public function create(Proyek $proyek)
    {
        $user = Auth::user();
        if ($user->isKlien() && $proyek->klien_id != $user->klien_id) {
            abort(403);
        }

        return view('dokumen.create', compact('proyek'));
    }

    public function store(Request $request, Proyek $proyek)
    {
        $user = Auth::user();
        if ($user->isKlien() && $proyek->klien_id != $user->klien_id) {
            abort(403);
        }

        $data = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'jenis_dokumen' => 'nullable|string|max:100',
            'berkas' => 'required|file|max:10240',
        ]);

        $data['berkas'] = $request->file('berkas')->store('dokumen', 'public');
        $data['proyek_id'] = $proyek->id;
        $data['tanggal_unggah'] = now()->toDateString();
        $data['diunggah_oleh'] = $user->role;

        DokumenProyek::create($data);

        return redirect()->route('proyek.show', $proyek)->with('success', 'Dokumen berhasil diunggah.');
    }

    public function download(DokumenProyek $dokumen)
    {
        $user = Auth::user();
        if ($user->isKlien() && $dokumen->proyek->klien_id != $user->klien_id) {
            abort(403);
        }

        return Storage::disk('public')->download($dokumen->berkas, $dokumen->nama_dokumen);
    }

    public function destroy(DokumenProyek $dokumen)
    {
        $proyek = $dokumen->proyek;
        Storage::disk('public')->delete($dokumen->berkas);
        $dokumen->delete();

        return redirect()->route('proyek.show', $proyek)->with('success', 'Dokumen berhasil dihapus.');
    }
}
