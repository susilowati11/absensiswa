<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiSiswa extends Model
{
    use HasFactory;

    protected $table = 'notifikasisiswa';

    protected $fillable = [
        'siswa_id',
        'notifikasikehadiran_id',
    ];

    public function notifikasiKehadiran()
    {
        // belongsTo adalah relasi dari banyak kesatu,
        //digunakan pada model "anak" untuk menunjukkan bahwa satu model "anak" dimiliki oleh satu model "induk.
        return $this->belongsTo(NotifikasiKehadiran::class);
    }
}
