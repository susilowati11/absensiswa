<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KehadiranController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $user = User::where('id', $userId)->get();

        $kehadiran = Kehadiran::where('user_id', $userId)->get();

        $kelas = Kelas::all();

        return view('User.kehadiran', compact('user', 'kehadiran', 'kelas'));
    }
  
    public function store(Request $request)
    {
        $time = Carbon::now();

        if ($time->diffInHours(Carbon::now()) < 8) {
            $status = 'Tidak Hadir';
        } else {
            $status = 'Hadir';
        }

        $request->validate([
            'kelas_id' => 'required'
        ]);
    
        try {
            $userId = Auth::id();
            $hariIni = Carbon::now()->format('Y-m-d');

            // Periksa apakah siswa sudah melakukan absen hari ini
            if (!Kehadiran::where('user_id', $userId)->whereDate('created_at', $hariIni)->exists()) {
                Kehadiran::create([
                    'user_id' => $userId,
                    'status_kehadiran' => $status,
                    'kelas_id' => $request->kelas_id
                ]);

                return redirect()->back()->with('success', 'Kehadiran berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Anda sudah melakukan absensi hari ini');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kehadiran = Kehadiran::findOrFail($id);

            $kehadiran->delete();

            return redirect()->back()->with('success', 'Kehadiran berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kehadiran');
        }
    }
}