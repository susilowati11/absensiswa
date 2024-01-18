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
            $table->string('nama_siswa')->nullable();
            $table->string('jenis_notifikasi');
            $table->date('tanggal_notifikasi');
            $table->text('informasi_tambahan')->nullable();
            $table->foreignId('kelas_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
