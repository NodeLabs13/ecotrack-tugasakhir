<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\ProgresProyekController;
use App\Http\Controllers\DokumenProyekController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman awal & Autentikasi
|--------------------------------------------------------------------------
|
| - "/" dan "/login" menampilkan form login (guest).
| - Semua route di bawah ini membutuhkan user yang sudah login (auth).
|
| Hak akses per role (RBAC) sesuai spesifikasi:
|   1. Direktur            : READ-ONLY semua data (tidak bisa create/edit/delete).
|   2. Civil Engineer       : FULL CRUD klien & proyek; kelola dokumen; FULL progres.
|   3. Perizinan Lingkungan: FULL CRUD klien & proyek; kelola dokumen; tambah & update progres (tidak hapus).
|   4. Klien              : READ-ONLY data proyek/klien/dokumen MILIKNYA sendiri; bisa unggah & unduh dokumen.
*/

Route::get('/', [LoginController::class, 'showLoginForm']);

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Dashboard: semua role (termasuk klien) bsa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Proyek: INDEX (semua role)
    Route::get('/proyek', [ProyekController::class, 'index'])->name('proyek.index');

    // Proyek: CREATE & STORE - HARUS sebelum {proyek}!
    Route::middleware('role:admin')->group(function () {
        Route::get('/proyek/create', [ProyekController::class, 'create'])->name('proyek.create');
        Route::post('/proyek', [ProyekController::class, 'store'])->name('proyek.store');
    });

    // Proyek: SHOW (semua role, controller membatasi klien)
    Route::get('/proyek/{proyek}', [ProyekController::class, 'show'])->name('proyek.show');

    // Proyek: EDIT & UPDATE (Civil Engineer, Perizinan Lingkungan & Admin)
    Route::middleware('role:civil_engineer,perizinan_lingkungan,admin')->group(function () {
        Route::get('/proyek/{proyek}/edit', [ProyekController::class, 'edit'])->name('proyek.edit');
        Route::put('/proyek/{proyek}', [ProyekController::class, 'update'])->name('proyek.update');
    });

    // Proyek: DESTROY (Admin only)
    Route::middleware('role:admin')->group(function () {
        Route::delete('/proyek/{proyek}', [ProyekController::class, 'destroy'])->name('proyek.destroy');
    });

    // Klien: CREATE & STORE (Admin only) - HARUS sebelum {klien}!
    Route::middleware('role:admin')->group(function () {
        Route::get('/klien/create', [KlienController::class, 'create'])->name('klien.create');
        Route::post('/klien', [KlienController::class, 'store'])->name('klien.store');
    });

    // Klien: INDEX & SHOW (semua role kecuali klien dibatasi di controller)
    Route::middleware('role:civil_engineer,direktur,perizinan_lingkungan,klien,admin')->group(function () {
        Route::get('/klien', [KlienController::class, 'index'])->name('klien.index');
        Route::get('/klien/{klien}', [KlienController::class, 'show'])->name('klien.show');
    });

    // Klien: EDIT, UPDATE, DESTROY (Admin only)
    Route::middleware('role:admin')->group(function () {
        Route::get('/klien/{klien}/edit', [KlienController::class, 'edit'])->name('klien.edit');
        Route::put('/klien/{klien}', [KlienController::class, 'update'])->name('klien.update');
        Route::delete('/klien/{klien}', [KlienController::class, 'destroy'])->name('klien.destroy');
    });

    // Progres proyek: Civil Engineer (penuh) & Perizinan Lingkungan (tambah & update, tidak hapus)
    Route::middleware('role:civil_engineer,perizinan_lingkungan')->group(function () {
        Route::get('/proyek/{proyek}/progres/create', [ProgresProyekController::class, 'create'])->name('progres.create');
        Route::post('/proyek/{proyek}/progres', [ProgresProyekController::class, 'store'])->name('progres.store');
    });

    // Dokumen: Unggah bsa dilakukan Klien, Civil Engineer, Perizinan Lingkungan (bukan Direktur)
    Route::middleware('role:klien,civil_engineer,perizinan_lingkungan')->group(function () {
        Route::get('/proyek/{proyek}/dokumen/create', [DokumenProyekController::class, 'create'])->name('dokumen.create');
        Route::post('/proyek/{proyek}/dokumen', [DokumenProyekController::class, 'store'])->name('dokumen.store');
    });

    // Dokumen: Unduh bsa SEMUA role (termasuk Direktur)
    Route::middleware('role:klien,civil_engineer,perizinan_lingkungan,direktur')->group(function () {
        Route::get('/dokumen/{dokumen}/download', [DokumenProyekController::class, 'download'])->name('dokumen.download');
    });

    // Dokumen: Hapus bsa Civil Engineer & Perizinan Lingkungan (bukan Direktur & Klien)
    Route::middleware('role:civil_engineer,perizinan_lingkungan')->group(function () {
        Route::delete('/dokumen/{dokumen}', [DokumenProyekController::class, 'destroy'])->name('dokumen.destroy');
    });
});