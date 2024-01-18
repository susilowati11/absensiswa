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
        'status_kehadiran',
        'user_id',
        'kelas_id',
    ];



    public function kelas()
    {
        return $this->belongsTo(Kelas::class);//kalau ditabel anak menggunakan belongsTo
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
