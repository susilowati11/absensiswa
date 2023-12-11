<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'jurusan',
        'tingkat_kelas'
    ];





    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function notifikasikehadirans()
    {
        return $this->hasMany(NotifikasiKehadiran::class);
    }

    public function user()
    {
        return $this->hasMany(User::class, 'kelas_id', 'id');
    }

    
    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'kelas_id', 'id');
    }

}
