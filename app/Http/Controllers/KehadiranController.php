<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kehadiran;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KehadiranController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $kehadiran = Kehadiran::all();
        $kelas = Kelas::all();
        return view('User.kehadiran', compact('user', 'kehadiran','kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'tanggal' => 'required',
            'status_kehadiran' => 'required',
            'waktu_masuk' => 'required',
            'waktu_pulang' => 'required',
            'catatan' => 'required',
            'kelas_id' => 'required' // Validasi kelas_id
        ]);

        try {
            $kelas = Kelas::find($request['kelas_id']);
            $riwayat = Carbon::now()->format('Y-m-d H:i:s');
            Kehadiran::create([
                'nama_siswa' => $request->nama_siswa,
                'tanggal' => $request->tanggal,
                'status_kehadiran' => $request->status_kehadiran,
                'waktu_masuk' => $request->waktu_masuk,
                'waktu_pulang' => $request->waktu_pulang,
                'catatan' => $request->catatan,
                'riwayat' => $riwayat,
                'kelas_id' => $request->kelas_id // Menyimpan kelas_id
            ]);
            return redirect()->back()->with('success', 'Kehadiran berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'tanggal' => 'required',
            'status_kehadiran' => 'required',
            'waktu_masuk' => 'required',
            'waktu_pulang' => 'required',
            'catatan' => 'required',
            'kelas_id' => 'required' // Validasi kelas_id
        ]);

        $kehadiran = Kehadiran::findOrFail($id);

        if (!$kehadiran) {
            return redirect()->back()->with('error', 'Data kehadiran tidak ditemukan');
        }

        $kehadiran->update([
            'nama_siswa' => $request->nama_siswa,
            'tanggal' => $request->tanggal,
            'status_kehadiran' => $request->status_kehadiran,
            'waktu_masuk' => $request->waktu_masuk,
            'waktu_pulang' => $request->waktu_pulang,
            'catatan' => $request->catatan,
            'kelas_id' => $request->kelas_id // Perbarui kelas_id
        ]);

        return redirect()->back()->with('success', 'Data kehadiran berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $kehadiran = Kehadiran::findOrFail($id);

            $kehadiran->delete();

            return redirect()->route('kehadiran.kehadiran')->with('success', 'Kehadiran berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kehadiran: ' . $e->getMessage());
        }
    }
}