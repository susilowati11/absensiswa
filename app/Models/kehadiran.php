<?php

namespace App\Models;

use App\Models\User; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kehadiran extends Model
{
    use HasFactory;
    protected $table = 'kehadiran';

    protected $fillable = [
        'nama_siswa',
        'tanggal',
        'status_kehadiran',
        'waktu_masuk',
        'waktu_pulang',
        'catatan',
        'riwayat',
        'user_id',
        'kelas_id',
    ];


    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
