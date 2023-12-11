<?php

namespace App\Http\Controllers;
use App\Models\NotifikasiKehadiran;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class notifikasikehadiranController extends Controller
{
    public function index()
    {
        $notifikasikehadiran = NotifikasiKehadiran::all();
        // $siswa = Siswa::all(); // Ambil semua data siswa
        $kelas = Kelas::all(); // Ambil semua data kelas
        $user = User::all();
        return view('Admin.notifikasikehadiran', compact('notifikasikehadiran', 'kelas','user'));
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required',
            'kelas_id' => 'required',
            'jenis_notifikasi' => 'required',
            'tanggal_notifikasi' => 'required|date',
            'waktu_notifikasi' => 'required',
            'status_pengiriman' => 'required',
            'informasi_tambahan' => 'nullable',
        ]);
    
        try {
            NotifikasiKehadiran::create([
                'user_id' => $request->id_siswa,
                'kelas_id' => $request->kelas_id,
                'jenis_notifikasi' => $request->jenis_notifikasi,
                'tanggal_notifikasi' => $request->tanggal_notifikasi,
                'waktu_notifikasi' => $request->waktu_notifikasi,
                'status_pengiriman' => $request->status_pengiriman,
                'informasi_tambahan' => $request->informasi_tambahan,
            ]);
    
            return redirect()->back()->with('success', 'Data kehadiran berhasil disimpan.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data kehadiran.');
        }
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_siswa' => 'required',
            'jenis_notifikasi' => 'required',
            'tanggal_notifikasi' => 'required|date',
            'waktu_notifikasi' => 'required',
            'status_pengiriman' => 'required',
            'informasi_tambahan' => 'nullable',
        ], [
            'nama_siswa.required' => 'Kolom nama siswa harus diisi.',
            'jenis_notifikasi.required' => 'Kolom jenis notifikasi harus diisi.',
            'tanggal_notifikasi.required' => 'Kolom tanggal notifikasi harus diisi.',
            'tanggal_notifikasi.date' => 'Format tanggal notifikasi tidak valid.',
            'waktu_notifikasi.required' => 'Kolom waktu notifikasi harus diisi.',
            'status_pengiriman.required' => 'Kolom status pengiriman harus diisi.',
        ]);
    
        try {
            $notifikasi = NotifikasiKehadiran::findOrFail($id);
            $notifikasi->update([
                'nama_siswa' => $request->nama_siswa,
                'jenis_notifikasi' => $request->jenis_notifikasi,
                'tanggal_notifikasi' => $request->tanggal_notifikasi,
                'waktu_notifikasi' => $request->waktu_notifikasi,
                'status_pengiriman' => $request->status_pengiriman,
                'informasi_tambahan' => $request->informasi_tambahan,
            ]);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data kehadiran.');
        }
    
        return redirect()->back()->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    public function destroy($id)
{
    try {
        $notifikasi = NotifikasiKehadiran::findOrFail($id);
        $notifikasi->delete();
    } catch (\Throwable $th) {
        throw $th;
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data kehadiran.');
    }

    return redirect()->back()->with('success', 'Data kehadiran berhasil dihapus.');
}
}
