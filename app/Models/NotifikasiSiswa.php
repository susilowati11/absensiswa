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

    // Relasi dengan model Siswa
    // Model NotifikasiSiswa
    public function notifikasiKehadiran()
    {
        return $this->belongsTo(NotifikasiKehadiran::class, 'notifikasikehadiran_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
