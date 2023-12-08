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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nis');
            $table->foreignId('kelas_id')->references('id')->on('kelas')->onUpdate('cascade')->onDelete('cascade'); // Menambahkan foreign key ke tabel siswa
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->string('email');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('siswa');

        Schema::table('siswa', function (Blueprint $table) {
            $table->id('id');
            $table->dropColumn('nama_siswa');
            $table->dropColumn('nis');
            $table->foreignId('kelas_id')->references('id')->on('kelas');
            $table->dropColumn('tanggal_lahir');
            $table->dropColumn('jenis_kelamin');
            $table->dropColumn('alamat');
            $table->dropColumn('nomor_telepon');
            $table->dropColumn('email');
            $table->dropColumn('foto');
        });
    }
};
