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
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->date('tanggal');
            $table->enum('status_kehadiran', ['Hadir', 'Tidak Hadir', 'Izin'])->default('Hadir');
            $table->time('waktu_masuk');
            $table->time('waktu_pulang');
            $table->string('catatan');
            $table->datetime('riwayat');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->timestamps();
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kehadiran', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
        });

        Schema::dropIfExists('kehadiran');
    }
};
