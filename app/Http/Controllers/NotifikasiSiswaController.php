<?php

namespace App\Http\Controllers;

use App\Models\NotifikasiSiswa;
use App\Models\Kehadiran; // Tambahkan use statement untuk model Kehadiran
use App\Models\NotifikasiKehadiran; // Tambahkan use statement untuk model NotifikasiKehadiran
use Illuminate\Http\Request;

class NotifikasiSiswaController extends Controller
{
    public function index()
    {
        $notifikasiSiswa = NotifikasiKehadiran::all();
        // try {
        //     $notifikasiSiswa = NotifikasiSiswa::with('notifikasiKehadiran', 'siswa')
        //     ->where('siswa_id', auth()->user()->id)
        //     ->get();        
        //     // dd($notifikasiSiswa);
        // } catch (\Exception $e) {
        //     dd($e->getMessage()); // Tampilkan pesan kesalahan
        // }
        // dd($notifikasiSiswa);       
        return view('user.notifikasisiswa', compact('notifikasiSiswa'));
    }

    public function store(Request $request)
    {
        try {
            // Proses menyimpan kehadiran
            // ...
            $siswa_id = $request->siswa_id;
            // Tambahkan notifikasi
            $notifikasiKehadiran = NotifikasiKehadiran::create([
                'siswa_id' => $siswa_id, // Ganti dengan ID siswa yang sesuai
                'jenis_notifikasi' => '...',
                'tanggal_notifikasi' => '...',
                'waktu_notifikasi' => '...',
                'status_pengiriman' => '...',
                'informasi_tambahan' => '...',
            ]);

            // Tambahkan notifikasi siswa
            $notifikasiSiswa = NotifikasiSiswa::create([
                'siswa_id' => $siswa_id,
                'notifikasi_kehadiran_id' => $notifikasiKehadiran->id,
                'pesan' => $notifikasiKehadiran->jenis_notifikasi, // Sesuaikan dengan struktur notifikasi kehadiran
            ]);

            // Hubungkan notifikasi_siswa dengan kehadiran
            Kehadiran::where('notifikasi_siswa_id', $notifikasiKehadiran->id)->update(['notifikasi_siswa_id' => $notifikasiSiswa->id]);

            // Redirect atau kembali ke halaman yang sesuai
            // ...
        } catch (\Exception $e) {
            dd($e->getMessage()); // Tampilkan pesan kesalahan
        }
    }
}
