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
        Schema::create('notifikasikehadiran', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_notifikasi');
            $table->date('tanggal_notifikasi');
            $table->time('waktu_notifikasi');
            $table->string('status_pengiriman');
            $table->text('informasi_tambahan')->nullable();

            // Menambahkan kunci asing
            $table->unsignedBigInteger('siswa_id');
            
            // Foreign key to Kelas table
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');

            $table->timestamps();
        });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasikehadiran');
    }
};
