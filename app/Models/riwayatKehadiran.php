<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayatkehadiran extends Model
{
    use HasFactory;
    protected $table = 'riwayatkehadiran';

    protected $fillable = [
        'nama_siswa',
        'tanggal',
        'status_kehadiran',
        'waktu_masuk',
        'waktu_pulang',
        'catatan',
    ];
}
