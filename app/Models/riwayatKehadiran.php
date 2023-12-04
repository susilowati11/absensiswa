<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayatKehadiran extends Model
{
    use HasFactory;

    protected $table = 'riwayat'; // Jika nama tabel tidak mengikuti konvensi Laravel, perlu didefinisikan

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'waktu_masuk',
        'waktu_pulang',
        'catatan',
    ];

    // Relasi ke tabel siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
