<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kehadiran extends Model
{
    use HasFactory;
    protected $table = 'kehadiran';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'status_kehadiran',
        'waktu_masuk',
        'waktu_pulang',
        'catatan',
        'riwayat',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    
}