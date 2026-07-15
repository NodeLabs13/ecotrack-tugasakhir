<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('progres_proyeks', function (Blueprint $table) {
            $table->unsignedTinyInteger('persentase_penyelesaian')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progres_proyeks', function (Blueprint $table) {
            $table->unsignedTinyInteger('persentase_penyelesaian')->nullable(false)->change();
        });
    }
};