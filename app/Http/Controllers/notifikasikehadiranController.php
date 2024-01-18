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
        $kelas = Kelas::all(); // Ambil semua data kelas
        $user = User::all();
        return view('Admin.notifikasikehadiran', compact('notifikasikehadiran', 'kelas','user'));
    }
    

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
                'id_siswa' => 'required',
                'kelas_id' => 'required',
                'jenis_notifikasi' => 'required',
                'tanggal_notifikasi' => 'required|date',
                'informasi_tambahan' => 'nullable',
            ], [
                'id_siswa.required' => 'Kolom Nama Siswa harus diisi.',
                'kelas_id.required' => 'Kolom Kelas harus diisi.',
                'jenis_notifikasi.required' => 'Kolom Jenis Notifikasi harus diisi.',
                'tanggal_notifikasi.required' => 'Kolom Tanggal Notifikasi harus diisi.',
                'tanggal_notifikasi.date' => 'Kolom Tanggal Notifikasi harus berformat tanggal.',
        ]);
    
        try {
            NotifikasiKehadiran::create([
                'user_id' => $request->id_siswa,
                'kelas_id' => $request->kelas_id,
                'jenis_notifikasi' => $request->jenis_notifikasi,
                'tanggal_notifikasi' => $request->tanggal_notifikasi,
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
    $validator = Validator::make($request->all(), [
        'id_siswa' => 'required',
        'jenis_notifikasi' => 'required',
        'tanggal_notifikasi' => 'required|date',
        'informasi_tambahan' => 'nullable',
    ], [
        'id_siswa.required' => 'Kolom nama siswa harus diisi.',
        'jenis_notifikasi.required' => 'Kolom jenis notifikasi harus diisi.',
        'tanggal_notifikasi.required' => 'Kolom tanggal notifikasi harus diisi.',
        'tanggal_notifikasi.date' => 'Format tanggal notifikasi tidak valid.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
        $notifikasi = NotifikasiKehadiran::findOrFail($id);
        $notifikasi->update([
            'user_id' => $request->id_siswa,
            'jenis_notifikasi' => $request->jenis_notifikasi,
            'tanggal_notifikasi' => $request->tanggal_notifikasi,
            'informasi_tambahan' => $request->informasi_tambahan,
        ]);
    } catch (\Throwable $th) {
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
