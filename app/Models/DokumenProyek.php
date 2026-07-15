<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenProyek extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyek_id',
        'nama_dokumen',
        'jenis_dokumen',
        'berkas',
        'tanggal_unggah',
        'diunggah_oleh',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }
}
