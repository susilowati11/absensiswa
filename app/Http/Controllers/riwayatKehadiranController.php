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

        // Filter berdasarkan hari
        if ($request->has('hari')) {
            $query->whereDay('created_at', $request->hari);
        }

        // Filter berdasarkan bulan
        if ($request->has('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->has('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $riwayatKehadiran = $query->get();

        $hariIni = Carbon::now()->isoFormat("YYYY-MM-DD");

        $user = User::whereDoesntHave('kehadiran',function($query) use ($hariIni) {
            $query->whereDate('created_at', $hariIni);
        })->where("role","user")->get();

        // dd(Carbon::now()->isoFormat("HH::mm"));

       if(Carbon::now()->isoFormat("HH:mm") > "08:00")
       {
        foreach ($user as $key => $data) {
            // dd($data->kelas);
            Kehadiran::create([
                'user_id' => $data->id,
                'status_kehadiran' => 'tidak hadir',
                'kelas_id' => $data->kelas->id// Menyimpan kelas_id
            ]);
        }
       }

        return view('admin.riwayatkehadiran', compact('riwayatKehadiran'));
    }    

    public function create()
    {
        return view('riwayatkehadiran.create');
    }
}
