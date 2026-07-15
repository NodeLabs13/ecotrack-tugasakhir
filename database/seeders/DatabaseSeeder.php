<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Klien;
use App\Models\Proyek;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $klien = Klien::create([
            'nama_klien' => 'Budi Santoso',
            'nama_perusahaan' => 'PT Sumber Air Jaya',
            'alamat' => 'Jl. Merdeka No. 10, Tangerang',
            'no_telepon' => '081234567890',
            'email' => 'budi@sumberairjaya.co.id',
        ]);

        Proyek::create([
            'kode_proyek' => 'ECO-2026-001',
            'nama_proyek' => 'Instalasi Pengolahan Air Limbah (IPAL)',
            'klien_id' => $klien->id,
            'lokasi_proyek' => 'Tigaraksa, Tangerang',
            'tanggal_mulai' => '2026-01-10',
            'tanggal_selesai' => '2026-06-30',
            'status_proyek' => 'berjalan',
            'progres_persen' => 45,
        ]);

        User::create([
            'name' => 'Direktur Utama',
            'email' => 'direktur@ecotrack.test',
            'password' => 'password',
            'role' => 'direktur',
        ]);

        User::create([
            'name' => 'Arif Sunandar',
            'email' => 'civil@ecotrack.test',
            'password' => 'password',
            'role' => 'civil_engineer',
        ]);

        User::create([
            'name' => 'Benny Senjaya',
            'email' => 'perizinan@ecotrack.test',
            'password' => 'password',
            'role' => 'perizinan_lingkungan',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'klien@ecotrack.test',
            'password' => 'password',
            'role' => 'klien',
            'klien_id' => $klien->id,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@ecotrack.test',
            'password' => 'password',
            'role' => 'admin',
        ]);
    }
}
