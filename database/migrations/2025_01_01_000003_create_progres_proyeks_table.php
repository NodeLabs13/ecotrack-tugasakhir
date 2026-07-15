<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progres_proyeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('proyeks')->cascadeOnDelete();
            $table->date('tanggal_progres');
            $table->unsignedTinyInteger('persentase_penyelesaian');
            $table->text('uraian_pekerjaan')->nullable();
            $table->string('dokumentasi')->nullable(); // path foto dokumentasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progres_proyeks');
    }
};
