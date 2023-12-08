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

        return view('user.siswa', compact('siswa', 'kelas'));
    }
    
    public function siswa(Request $request)
    {
        // dd($request);
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama_siswa' => 'required|string',
            'nis' => 'required|numeric|digits:8|unique:siswa,nis|min:0', // Menambahkan aturan min:0
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|numeric|digits:12|min:0', // Menambahkan aturan min:0
            'email' => 'required|email',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_siswa.required' => 'Nama siswa harus diisi.',
            'nis.required' => 'NIS siswa harus diisi.',
            'nis.numeric' => 'NIS siswa harus berupa angka.',
            'nis.digits' => 'NIS siswa harus terdiri dari 8 digit.',
            'nis.unique' => 'NIS siswa sudah digunakan oleh siswa lain.',
            'nis.min' => 'NIS siswa tidak boleh bernilai negatif.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus diisi dengan "laki-laki" atau "perempuan".',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat siswa harus diisi.',
            'nomor_telepon.required' => 'Nomor telepon siswa harus diisi.',
            'nomor_telepon.numeric' => 'Nomor telepon siswa harus berupa angka.',
            'nomor_telepon.digits' => 'Nomor telepon siswa harus terdiri dari 12 digit.',
            'nomor_telepon.min' => 'Nomor telepon siswa tidak boleh bernilai negatif.',
            'email.required' => 'Alamat email siswa harus diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'foto.image' => 'Berkas harus berupa gambar.',
            'foto.mimes' => 'Berkas harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran berkas tidak boleh melebihi 2048 kilobita.',
        ]);        
        
        $fotoPath = $request->file('foto')->store('foto', 'public');

        // Create a new Siswa instance and fill it with the validated data
        $siswa = Siswa::create(array_merge($validatedData, ['foto' => $fotoPath]));

        // Redirect back or to a success page1
        return redirect()->back()->with('success', 'Siswa added successfully');
    }
   
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        try {
            $validatedData = $request->validate([
                'nama_siswa' => 'required|string',
                'nis' => 'required|numeric|digits:8|unique:siswa,nis,' . $id,
                'kelas_id' => 'required|exists:kelas,id',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string',
                'nomor_telepon' => 'required|numeric|digits:12|min:0',
                'email' => 'required|email',
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
          
    
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
                $siswa->foto = $request->file('foto')->store('foto', 'public');
                $siswa->save();
            }           
    
            return redirect()->back()->with('success', 'Siswa updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Siswa');
        }
    }
    
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
       
        if ($siswa->NotifikasiKehadiran()->exists()) {
            return redirect()->back()->with('error', 'Data tidak dapat dihapus karena masih digunakan.');
        }

        if (Storage::disk('public')->exists($siswa->foto)) {
            // Hapus file menggunakan Storage facade
            Storage::disk('public')->delete($siswa->foto);
        }
        // Menghapus siswa dari database
        $siswa->delete();

        return redirect()->back()->with('success', 'Siswa berhasil dihapus');
    }
    
}
