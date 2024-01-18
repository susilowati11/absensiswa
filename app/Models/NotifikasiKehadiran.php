<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\User;

class NotifikasiKehadiran extends Model
{
    use HasFactory;
    protected $table = 'notifikasikehadiran';
    protected $fillable = [
        'nama_siswa',
        'kelas_id',
        'jenis_notifikasi',
        'tanggal_notifikasi',
        'informasi_tambahan',
        'user_id',
    ];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function notifikasiSiswa()
    {
        return $this->hasMany(NotifikasiSiswa::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
