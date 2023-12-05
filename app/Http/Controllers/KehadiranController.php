<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\Siswa;

class KehadiranController extends Controller
{
    public function index()
    {
        $kehadiran = Kehadiran::all();
        $Siswa = Siswa::all();

        return view('kehadiran.index', compact('kehadiran', 'Siswa'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required',
            'status_kehadiran' => 'required',
            'waktu_masuk' => 'required',
            'waktu_pulang' => 'required',
            'catatan' => 'required',
        ]);

        // Temukan siswa berdasarkan nama
        $siswa = Siswa::where('nama_siswa', $request->nama_siswa)->first();

        try {
            Kehadiran::create([
                'siswa_id' => $siswa->siswa_id, // Gunakan id siswa yang ditemukan
                'tanggal' => $request->tanggal,
                'status_kehadiran' => $request->status_kehadiran,
                'waktu_masuk' => $request->waktu_masuk,
                'waktu_pulang' => $request->waktu_pulang,
                'catatan' => $request->catatan,
            ]);

            return redirect()->back()->with('success', 'Kehadiran berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kehadiran');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required',
            'status_kehadiran' => 'required',
            'waktu_masuk' => 'required',
            'waktu_pulang' => 'required',
            'catatan' => 'required',
        ]);

        try {
            $kehadiran = Kehadiran::findOrFail($id);
            $kehadiran->update([
                'siswa_id' => $request->siswa_id,
                'tanggal' => $request->tanggal,
                'status_kehadiran' => $request->status_kehadiran,
                'waktu_masuk' => $request->waktu_masuk,
                'waktu_pulang' => $request->waktu_pulang,
                'catatan' => $request->catatan,
            ]);

            return redirect()->back()->with('success', 'Data kehadiran berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data kehadiran');
        }
    }

    public function destroy($id)
    {
        try {
            $kehadiran = Kehadiran::findOrFail($id);
            $kehadiran->delete();

            return redirect()->route('kehadiran.kehadiran')->with('success', 'Kehadiran berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kehadiran');
        }
    }
}
