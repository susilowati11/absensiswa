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



    

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    public function notifikasikehadirans()
    {
        return $this->hasMany(NotifikasiKehadiran::class);
    }

}
