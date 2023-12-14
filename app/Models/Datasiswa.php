<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Datasiswa extends Model
{
    use HasFactory;

    protected $table = 'datasiswa';
    protected $fillable = [ 
    'user_id',
    'nama_siswa',
    'nis',
    'kelas_id',
    'jenis_kelamin',
    'tanggal_lahir',
    'alamat',
    'nomor_telepon',
    'email',
 
];

public function user()
{
    return $this->belongsTo(User::class);
}
}
