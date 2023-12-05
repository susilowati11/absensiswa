<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Siswa;

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
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    
}