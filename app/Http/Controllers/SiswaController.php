<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SiswaController extends Controller
{
    public function index()
    {
        // Mengambil semua siswa bersama dengan informasi kelasnya
        $siswa = Siswa::with('kelas')->get();
        $kelas = Kelas::all();

        return view('siswa.index', compact('siswa', 'kelas'));
    }
    
    public function siswa(Request $request)
    {
        // dd($request);
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama_siswa' => 'required|string',
            'nis' => 'required|numeric',
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|numeric',
            'email' => 'required|email',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nama_siswa.required' => 'Nama siswa harus diisi.',
            'nis.required' => 'NIS siswa harus diisi.',
            'nis.numeric' => 'NIS siswa harus berupa angka.',
            'nis.digits' => 'NIS siswa harus terdiri dari 8 digit.',
            'nis.unique' => 'NIS siswa sudah digunakan oleh siswa lain.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus diisi dengan "laki-laki" atau "perempuan".',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat siswa harus diisi.',
            'nomor_telepon.required' => 'Nomor telepon siswa harus diisi.',
            'nomor_telepon.numeric' => 'Nomor telepon siswa harus berupa angka.',
            'email.required' => 'Alamat email siswa harus diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'foto.image' => 'Berkas harus berupa gambar.',
            'foto.mimes' => 'Berkas harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran berkas tidak boleh melebihi 2048 kilobita.',
        ]);

        $fotoPath = $request->file('foto')->store('siswa_foto', 'public');

        // Create a new Siswa instance and fill it with the validated data
        $siswa = Siswa::create(array_merge($validatedData, ['foto' => $fotoPath]));

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Siswa added successfully');
    }
   
    public function update(Request $request, $id)
    {
     
        try {
            $validatedData = $request->validate([
                'nama_siswa' => 'required|string',
                'nis' => 'required|numeric',
                'kelas_id' => 'required|exists:kelas,id',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string',
                'nomor_telepon' => 'required|numeric',
                'email' => 'required|email',
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
          
            $siswa = Siswa::find($id);
    
            $siswa->update([
                'nama_siswa' => $request->nama_siswa,
                'nis' => $request->nis,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
                'email' => $request->email,
            ]);
            
            if ($request->hasFile('foto')) {
                Storage::disk('public')->delete($siswa->foto);
                $siswa->foto = $request->file('foto')->store('siswa_foto', 'public');
                $siswa->save();
            }
            
            $siswa->update($request->all());            
    
            return redirect()->back()->with('success', 'Siswa updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Siswa');
        }
    }
    
    public function destroy($id)
    {
        try {
            // Menggunakan metode findOrFail untuk menemukan siswa berdasarkan ID
            $siswa = Siswa::findOrFail($id);
    
            // Menghapus foto dari penyimpanan jika ada
            $filePath = public_path('storage/siswa_foto/' . $siswa->foto);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
    
            // Menghapus siswa dari database
            $siswa->delete();
    
            return redirect()->back()->with('success', 'Siswa berhasil dihapus');
        } catch (\Exception $e) {
            // Tangani kesalahan di sini
            return redirect()->back()->with('error', 'Gagal menghapus siswa');
        }
    }
    
}
