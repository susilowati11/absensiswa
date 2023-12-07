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
        Schema::create('riwayatkehadiran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->date('tanggal');
            $table->date('status_kehadiran');
            $table->time('waktu_masuk');
            $table->time('waktu_pulang');
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayatkehadiran');
    }
};
