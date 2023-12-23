<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\User;
use Carbon\Carbon;

class RiwayatkehadiranController extends Controller
{
    public function index(Request $request)
    {
        $query = Kehadiran::query();

        // Filter berdasarkan tanggal
        if ($request->has('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter berdasarkan bulan
        if ($request->has('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->has('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        if ($request->has('tanggal')) {
            session(['tanggal' => $request->tanggal]);
        }

        if ($request->has('bulan')) {
            session(['bulan' => $request->bulan]);
        }

        if ($request->has('tahun')) {   
            session(['tahun' => $request->tahun]);
        }

        $riwayatKehadiran = $query->get();

        $hariIni = Carbon::now()->isoFormat("YYYY-MM-DD");

        // Ambil user yang belum melakukan absen hari ini
        $user = User::whereDoesntHave('kehadiran', function ($query) use ($hariIni) {
            $query->whereDate('created_at', $hariIni);
        })->where("role", "user")->get();

        // Periksa waktu untuk menentukan apakah sudah melewati waktu absen
        if (Carbon::now()->isoFormat("HH:mm") > "08:00") {
            foreach ($user as $key => $data) {
                // Periksa apakah siswa sudah melakukan absen hari ini
                if (!$data->kehadiran()->whereDate('created_at', $hariIni)->exists()) {


                    Kehadiran::create([
                        'user_id' => $data->id,


                        'status_kehadiran' => 'tidak hadir',


                        'kelas_id' => $data->kelas->id // Menyimpan kelas_id
                    ]);
                }
            }
        }

        return view('admin.riwayatkehadiran', compact('riwayatKehadiran'));
    }

    public function create()
    {
        return view('riwayatkehadiran.create');
    }
}
