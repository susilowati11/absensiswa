<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // Nama tabel yang terkait dengan model
    protected $fillable = [
        'nama_siswa',
        'nis',
        'kelas_id',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'email',
        'foto'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function riwayatKehadiran()
    {
        return $this->hasMany(riwayatKehadiran::class, 'siswa_id');
    }
    public function NotifikasiKehadiran()
    {
        return $this->hasMany(NotifikasiKehadiran::class, 'siswa_id');
    }
}
