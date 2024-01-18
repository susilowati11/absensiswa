<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class SiswaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        

        // Mengambil semua siswa bersama dengan informasi kelasnya
        $siswa = Siswa::with('kelas')->where('user_id', $userId)->get();
        $kelas = Kelas::all();

        return view('user.siswa', compact('siswa', 'kelas'));
    }
    
}