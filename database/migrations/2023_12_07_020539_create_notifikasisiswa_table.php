<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('notifikasisiswa')) {
            Schema::create('notifikasisiswa', function (Blueprint $table) {
                $table->id();
                $table->foreignId('siswa_id')->constrained('siswa');
                $table->unsignedBigInteger('notifikasikehadiran_id');
                $table->timestamps();
                $table->foreign('notifikasikehadiran_id')->references('id')->on('notifikasikehadiran')->onDelete('cascade');
            });
            
        }
    }

    public function down()
    {
        Schema::dropIfExists('notifikasisiswa');
    }
};

