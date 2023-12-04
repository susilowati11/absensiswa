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
        Schema::create('Riwayatkehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->date('tanggal');
            $table->time('waktu_masuk');
            $table->time('waktu_pulang');
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Menambahkan kunci asing
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat');
    }
};
