<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proyeks', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('lokasi_proyek');
            $table->json('assigned_to')->nullable()->after('status_proyek');
        });
    }

    public function down(): void
    {
        Schema::table('proyeks', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'assigned_to']);
        });
    }
};