<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Klien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_klien' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nama_klien.required' => 'Nama lengkap wajib diisi',
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'no_telepon.required' => 'Nomor telepon wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Buat data klien
            $klien = Klien::create([
                'nama_klien' => $request->nama_klien,
                'nama_perusahaan' => $request->nama_perusahaan,
                'email' => $request->email,
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat,
            ]);

            // Buat user dengan role klien
            $user = User::create([
                'name' => $request->nama_klien,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'klien',
                'klien_id' => $klien->id,
            ]);

            DB::commit();

            // Auto login setelah registrasi
            auth()->login($user);

            return redirect()->route('dashboard')
                ->with('success', 'Registrasi berhasil! Selamat datang di Eco Track.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.'])
                ->withInput();
        }
    }
}