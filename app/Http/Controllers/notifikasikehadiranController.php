<?php

namespace App\Http\Controllers;
use App\Models\NotifikasiKehadiran;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class notifikasikehadiranController extends Controller
{
    public function index()
    {
        $notifikasikehadiran = NotifikasiKehadiran::all();
        $siswa = Siswa::all(); // Ambil semua data siswa
        $kelas = Kelas::all(); // Ambil semua data kelas

        return view('Admin.notifikasikehadiran', compact('notifikasikehadiran', 'siswa', 'kelas'));
    }
    

    public function store(Request $request)
{
    //dd($request->all());
    // dd($request);       
    $validatedData = $request->validate([
        'siswa_kelas' => 'required',
        'jenis_notifikasi' => 'required',
        'tanggal_notifikasi' => 'required|date',
        'waktu_notifikasi' => 'required',
        'status_pengiriman' => 'required',
        'informasi_tambahan' => 'nullable',
    ]);

    $siswa=Siswa::find($request->siswa_kelas);
    try {
        NotifikasiKehadiran::create([
            'siswa_id'=>$request->siswa_kelas,
            'kelas_id'=>$siswa->kelas_id,
            'jenis_notifikasi'=>$request->jenis_notifikasi,
            'tanggal_notifikasi'=>$request->tanggal_notifikasi,
            'waktu_notifikasi'=>$request->waktu_notifikasi,
            'status_pengiriman'=>$request->status_pengiriman,
            'informasi_tambahan'=>$request->informasi_tambahan,
        ]);
    } catch (\Throwable $th) {
        throw $th;
        return redirect()->back()->with('success', 'Data kehadiran berhasil disimpan.');

    }
    

    return redirect()->back()->with('success', 'Data kehadiran berhasil disimpan.');
}
public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'siswa_kelas' => 'required',
        'jenis_notifikasi' => 'required',
        'tanggal_notifikasi' => 'required|date',
        'waktu_notifikasi' => 'required',
        'status_pengiriman' => 'required',
        'informasi_tambahan' => 'nullable',
    ], [
        'siswa_kelas.required' => 'Kolom siswa kelas harus diisi.',
        'jenis_notifikasi.required' => 'Kolom jenis notifikasi harus diisi.',
        'tanggal_notifikasi.required' => 'Kolom tanggal notifikasi harus diisi.',
        'tanggal_notifikasi.date' => 'Format tanggal notifikasi tidak valid.',
        'waktu_notifikasi.required' => 'Kolom waktu notifikasi harus diisi.',
        'status_pengiriman.required' => 'Kolom status pengiriman harus diisi.',
    ]);
    
    $siswa = Siswa::find($request->siswa_kelas);
    
    try {
        $notifikasi = NotifikasiKehadiran::findOrFail($id);
        $notifikasi->update([
            'siswa_id' => $request->siswa_kelas,
            'kelas_id' => $siswa->kelas_id,
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


}
