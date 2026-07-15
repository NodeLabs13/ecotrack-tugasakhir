<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_proyeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('proyeks')->cascadeOnDelete();
            $table->string('nama_dokumen');
            $table->string('jenis_dokumen')->nullable();
            $table->string('berkas'); // path file
            $table->date('tanggal_unggah');
            $table->string('diunggah_oleh')->nullable(); // role/nama pengunggah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_proyeks');
    }
};
