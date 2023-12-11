<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nis',
        'kelas_id',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_tlp',
        'alamat',
        'foto',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kehadiran()
    {
        return $this->belongsTo(Kehadiran::class);
    }

    // Update the relationship to use hasOne
    public function datasiswa()
    {
        return $this->hasOne(Datasiswa::class, 'user_id');
    }
}
