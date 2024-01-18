<?php

namespace App\Http\Controllers;

use App\Models\NotifikasiSiswa;
use App\Models\Kehadiran;
use App\Models\NotifikasiKehadiran;
use Illuminate\Http\Request;

class NotifikasiSiswaController extends Controller
{
    public function index()
    {
        $notifikasiSiswa = NotifikasiKehadiran::where('user_id', auth()->user()->id)->get();
        return view('user.notifikasisiswa', compact('notifikasiSiswa'));
    }

    public function store(Request $request)
    {
        try {
            // Proses menyimpan kehadiran

            $siswa_id = $request->siswa_id;
            $jenis_notifikasi = $request->jenis_notifikasi;
            $tanggal_notifikasi = $request->tanggal_notifikasi;
            $informasi_tambahan = $request->informasi_tambahan;

            // Tambahkan notifikasi
            $notifikasiKehadiran = NotifikasiKehadiran::create([
                'siswa_id' => $siswa_id, // Ganti dengan ID siswa yang sesuai
                'jenis_notifikasi' =>  $jenis_notifikasi,
                'tanggal_notifikasi' =>  $tanggal_notifikasi,
                'informasi_tambahan' =>  $informasi_tambahan,
            ]);


            // Tambahkan notifikasi siswa
            $notifikasiSiswa = NotifikasiSiswa::create([
                'siswa_id' => $siswa_id,
                'notifikasi_kehadiran_id' => $notifikasiKehadiran->id,
                'pesan' => $notifikasiKehadiran->jenis_notifikasi, // Sesuaikan dengan struktur notifikasi kehadiran
            ]);

            // Hubungkan notifikasi_siswa dengan kehadiran
            Kehadiran::where('notifikasi_siswa_id', $notifikasiKehadiran->id)->update(['notifikasi_siswa_id' => $notifikasiSiswa->id]);
        } catch (\Exception $e) {
            ($e->getMessage()); // Tampilkan pesan kesalahan
        }
    }
}
