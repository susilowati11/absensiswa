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
        // $user = User::all();
        // Mendapatkan ID pengguna yang login
        $userId = Auth::id();

        $user = User::where('id', $userId)->get();

        // Mendapatkan data kehadiran hanya untuk pengguna yang login
        $kehadiran = Kehadiran::where('user_id', $userId)->get();

        $kelas = Kelas::all();
        return view('User.kehadiran', compact('user', 'kehadiran', 'kelas'));
    }

    public function store(Request $request)
    {
        $time = Carbon::now();
        if ($time->diffInHours(Carbon::now()) < 8) {
            $status = 'Tidak Hadir';
        }else {
            $status = 'Hadir';
        }
        $request->validate([
            // 'id_siswa' => 'required',
            // 'tanggal' => 'required',
            // 'status_kehadiran' => 'required',
            // 'waktu_masuk' => 'required',
            // 'waktu_pulang' => 'required',
            // 'catatan' => 'required',
            'kelas_id' => 'required' // Validasi kelas_id
        ]);

        try {
            // dd($status);
            $kelas = Kelas::find($request['kelas_id']);
            $riwayat = Carbon::now()->format('Y-m-d H:i:s');
            $user = Auth::user();
           $data = Kehadiran::create([
                'user_id' => $user->id,
                // 'tanggal' => $request->tanggal,
                'status_kehadiran' => $status,
                // 'waktu_masuk' => $request->waktu_masuk,
                // 'waktu_pulang' => $request->waktu_pulang,
                // 'catatan' => $request->catatan,
                // 'riwayat' => $riwayat,
                'kelas_id' => $user->kelas_id// Menyimpan kelas_id
            ]);
            // dd($data);
            return redirect()->back()->with('success', 'Kehadiran berhasil ditambahkan');
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'id_siswa' => 'required',
    //         'tanggal' => 'required',
    //         'status_kehadiran' => 'required',
    //         'waktu_masuk' => 'required',
    //         'waktu_pulang' => 'required',
    //         'catatan' => 'required',
    //         'kelas_id' => 'required' // Validasi kelas_id
    //     ]);

    //     $kehadiran = Kehadiran::findOrFail($id);

    //     if (!$kehadiran) {
    //         return redirect()->back()->with('error', 'Data kehadiran tidak ditemukan');
    //     }

    //     $kehadiran->update([
    //         'user_id' => $request->id_siswa,
    //         'tanggal' => $request->tanggal,
    //         'status_kehadiran' => $request->status_kehadiran,
    //         'waktu_masuk' => $request->waktu_masuk,
    //         'waktu_pulang' => $request->waktu_pulang,
    //         'catatan' => $request->catatan,
    //         'kelas_id' => $request->kelas_id // Perbarui kelas_id
    //     ]);

    //     return redirect()->back()->with('success', 'Data kehadiran berhasil diperbarui');
    // }

    public function destroy($id)
    {
        try {
            $kehadiran = Kehadiran::findOrFail($id);

            $kehadiran->delete();

            return redirect()->back()->with('success', 'Kehadiran berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kehadiran: ' );
        }
    }
}
