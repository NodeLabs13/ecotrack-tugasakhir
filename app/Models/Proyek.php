<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    public static $kategoriRoles = [
        'Pembangunan IPAL/WTP/STP' => ['civil_engineer', 'perizinan_lingkungan'],
        'Jasa Konstruksi Umum' => ['civil_engineer', 'perizinan_lingkungan'],
        'Konsultasi & Perizinan' => ['perizinan_lingkungan'],
        'Desain Teknis (DED)' => ['civil_engineer'],
    ];

    protected $fillable = [
        'kode_proyek',
        'nama_proyek',
        'klien_id',
        'lokasi_proyek',
        'deskripsi',
        'kategori',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_proyek',
        'assigned_to',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'assigned_to' => 'array',
    ];

    public function klien()
    {
        return $this->belongsTo(Klien::class);
    }

    public function progres()
    {
        return $this->hasMany(ProgresProyek::class)->orderByDesc('created_at');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenProyek::class)->orderByDesc('tanggal_unggah');
    }
}
