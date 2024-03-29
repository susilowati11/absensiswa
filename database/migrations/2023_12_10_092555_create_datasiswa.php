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
        Schema::create('datasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nis');
            $table->foreignId('kelas_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->string('email');
           
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasiswa');
    }
};
