<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kehadiran;
use App\Models\User;

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
        'notifikasikehadiran',
        'foto',
        'user_id',
        'kehadiran',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

