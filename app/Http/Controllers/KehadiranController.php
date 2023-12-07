<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\Siswa;
use Carbon\Carbon;

class KehadiranController extends Controller
{
    public function index()
    {
        $kehadiran = Kehadiran::all();
        $siswa = Siswa::all();
// dd($kehadiran);
        return view('kehadiran.index', compact('kehadiran', 'siswa'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Lakukan logika pencarian sesuai kebutuhan Anda

        // Misalnya, mengembalikan hasil pencarian ke tampilan
        return view('search_results', ['query' => $query]);
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

        try {
            $siswa = Siswa::findOrFail($request->siswa_id);
            $riwayat = Carbon::now()->format('Y-m-d H:i:s');
            Kehadiran::create([
                'siswa_id' => $siswa->id,
                'tanggal' => $request->tanggal,
                'status_kehadiran' => $request->status_kehadiran,
                'waktu_masuk' => $request->waktu_masuk,
                'waktu_pulang' => $request->waktu_pulang,
                'catatan' => $request->catatan,
                'riwayat' => $riwayat
            ]);
            return redirect()->back()->with('success', 'Kehadiran berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        dd($request);
    }

    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required',
            'status_kehadiran' => 'required',
            'waktu_masuk' => 'required',
            'waktu_pulang' => 'required',
            'catatan' => 'required',
        ]);

        // Temukan data kehadiran berdasarkan ID
        $kehadiran = Kehadiran::findOrFail($id);

        // Periksa apakah data ditemukan
        if (!$kehadiran) {
            return redirect()->back()->with('error', 'Data kehadiran tidak ditemukan');
        }

        // Perbarui atribut kehadiran dengan data baru
        $kehadiran->update([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'status_kehadiran' => $request->status_kehadiran,
            'waktu_masuk' => $request->waktu_masuk,
            'waktu_pulang' => $request->waktu_pulang,
            'catatan' => $request->catatan,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data kehadiran berhasil diperbarui');
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
