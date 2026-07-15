<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KlienController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->query('search');

        $query = Klien::query();

        // For civil_engineer & perizinan_lingkungan, only show clients from their assigned projects
        if (in_array($user->role, ['civil_engineer', 'perizinan_lingkungan'])) {
            $proyekIds = \App\Models\Proyek::where(function ($q) use ($user) {
                $q->whereNull('assigned_to')
                  ->orWhere('assigned_to', '[]')
                  ->orWhereJsonContains('assigned_to', $user->role);
            })->pluck('klien_id')->unique()->filter();

            $query->whereIn('id', $proyekIds);
        }

        $query->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_klien', 'like', "%{$search}%")
                  ->orWhere('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_telepon', 'like', "%{$search}%");
            });
        }

        $kliens = $query->paginate(10)->withQueryString();

        return view('klien.index', compact('kliens', 'search'));
    }

    public function show(Klien $klien)
    {
        return view('klien.show', compact('klien'));
    }

    public function create()
    {
        return view('klien.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_klien' => 'required|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:30',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Simpan data klien
        $klien = Klien::create([
            'nama_klien' => $data['nama_klien'],
            'nama_perusahaan' => $data['nama_perusahaan'],
            'alamat' => $data['alamat'],
            'no_telepon' => $data['no_telepon'],
            'email' => $data['email'],
        ]);

        // Buat akun user untuk klien
        User::create([
            'name' => $data['nama_klien'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'klien',
            'klien_id' => $klien->id,
        ]);

        return redirect()->route('klien.index')->with('success', 'Data klien dan akun login berhasil ditambahkan.');
    }

    public function edit(Klien $klien)
    {
        return view('klien.edit', compact('klien'));
    }

    public function update(Request $request, Klien $klien)
    {
        $data = $request->validate([
            'nama_klien' => 'required|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
        ]);

        $klien->update($data);

        // Update juga data user terkait jika ada
        if ($klien->user) {
            $klien->user->update([
                'name' => $data['nama_klien'],
                'email' => $data['email'] ?? $klien->user->email,
            ]);
        }

        return redirect()->route('klien.index')->with('success', 'Data klien berhasil diperbarui.');
    }

    public function destroy(Klien $klien)
    {
        // Hapus juga user terkait jika ada
        if ($klien->user) {
            $klien->user->delete();
        }

        $klien->delete();
        return redirect()->route('klien.index')->with('success', 'Data klien berhasil dihapus.');
    }
}