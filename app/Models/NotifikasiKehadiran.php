<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiKehadiran extends Model
{
    use HasFactory;
    protected $table = 'notifikasikehadiran';
    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'jenis_notifikasi',
        'tanggal_notifikasi',
        'waktu_notifikasi',
        'status_pengiriman',
        'informasi_tambahan',
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function notifikasiSiswa()
    {
        return $this->hasMany(NotifikasiSiswa::class, 'notifikasikehadiran_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
