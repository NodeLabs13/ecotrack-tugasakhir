<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_proyek')->unique();
            $table->string('nama_proyek');
            $table->foreignId('klien_id')->constrained('kliens')->cascadeOnDelete();
            $table->string('lokasi_proyek')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            // status: berjalan, selesai, tertunda
            $table->string('status_proyek')->default('berjalan');
            $table->unsignedTinyInteger('progres_persen')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
