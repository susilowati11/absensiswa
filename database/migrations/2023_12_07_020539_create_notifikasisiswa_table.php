<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifikasisiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notifikasikehadiran_id')->constrained('notifikasikehadiran')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifikasisiswa');
    }
};
