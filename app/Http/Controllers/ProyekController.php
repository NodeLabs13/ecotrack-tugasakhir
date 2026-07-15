<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Klien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = $request->query('status');
        $search = $request->query('search');

        $query = Proyek::with('klien');

        if ($user->isKlien()) {
            $query->where('klien_id', $user->klien_id);
        }

        // Filter by assigned_to for non-admin roles
        if (in_array($user->role, ['civil_engineer', 'perizinan_lingkungan'])) {
            $query->where(function ($q) use ($user) {
                $q->whereNull('assigned_to')
                  ->orWhere('assigned_to', '[]')
                  ->orWhereJsonContains('assigned_to', $user->role);
            });
        }

        if ($status) {
            $query->where('status_proyek', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_proyek', 'like', "%{$search}%")
                  ->orWhere('kode_proyek', 'like', "%{$search}%")
                  ->orWhere('lokasi_proyek', 'like', "%{$search}%");
            });
        }

        $proyeks = $query->latest()->paginate(10)->withQueryString();

        return view('proyek.index', compact('proyeks', 'status', 'search'));
    }

    public function create()
    {
        $kliens = Klien::orderBy('nama_klien')->get();
        return view('proyek.create', compact('kliens'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_proyek' => 'required|string|max:50|unique:proyeks,kode_proyek',
            'nama_proyek' => 'required|string|max:255',
            'klien_id' => 'required|exists:kliens,id',
            'lokasi_proyek' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status_proyek' => 'required|in:berjalan,tertunda,selesai',
        ]);

        // Set assigned_to automatically based on kategori
        $kategori = $request->kategori;
        $data['assigned_to'] = isset(\App\Models\Proyek::$kategoriRoles[$kategori])
            ? \App\Models\Proyek::$kategoriRoles[$kategori]
            : [];

        Proyek::create($data);

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function show(Proyek $proyek)
    {
        $user = Auth::user();
        if ($user->isKlien() && $proyek->klien_id != $user->klien_id) {
            abort(403);
        }

        $proyek->load(['klien', 'progres', 'dokumen']);
        return view('proyek.show', compact('proyek'));
    }

    public function edit(Proyek $proyek)
    {
        $kliens = Klien::orderBy('nama_klien')->get();
        return view('proyek.edit', compact('proyek', 'kliens'));
    }

    public function update(Request $request, Proyek $proyek)
    {
        $data = $request->validate([
            'kode_proyek' => 'required|string|max:50|unique:proyeks,kode_proyek,' . $proyek->id,
            'nama_proyek' => 'required|string|max:255',
            'klien_id' => 'required|exists:kliens,id',
            'lokasi_proyek' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status_proyek' => 'required|in:berjalan,tertunda,selesai',
        ]);

        // Only admin can change kategori and assigned_to
        if (auth()->user()->role === 'admin') {
            $data['kategori'] = $request->kategori;
            $kategori = $request->kategori;
            $data['assigned_to'] = isset(\App\Models\Proyek::$kategoriRoles[$kategori])
                ? \App\Models\Proyek::$kategoriRoles[$kategori]
                : [];
        } else {
            // Non-admin: keep existing kategori and assigned_to untouched
            unset($data['kategori']);
        }

        $proyek->update($data);

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Proyek $proyek)
    {
        $proyek->delete();
        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
