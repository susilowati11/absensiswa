<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        

        return view('kelas.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'jurusan' => 'required|string|max:255',
            'tingkat_kelas' => 'required|string|max:255',
        ]);



        $kelas = Kelas::create([
            'jurusan' => $request->jurusan,
            'tingkat_kelas' => $request->tingkat_kelas
        ]);


        return redirect()->back()->with('success', 'Data kelas berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'jurusan' => 'required|string|max:255',
                'tingkat_kelas' => 'required|string|max:255',
            ]);


            // Update the Siswa with the validated data
            $kelas = Kelas::find($id); // Replace $id with the actual ID of the record you want to update

            if ($kelas) {
                $kelas->update([
                    'jurusan' => $request->jurusan,
                    'tingkat_kelas' => $request->tingkat_kelas
                ]);
            }
            // If a new photo is uploaded, store it and update the photo path

            // Redirect back or to a success page
            return redirect()->back()->with('success', 'Siswa updated successfully');
        } catch (\Exception $else) {
            return redirect()->back()->with('error', 'Failed to update Siswa');
        }
    }

    public function destroy($id)
    {
        try {
            // Menggunakan metode findOrFail untuk menemukan siswa berdasarkan ID
            $kelas = Kelas::findOrFail($id);

            // Menghapus foto dari penyimpanan jika ada
            // if ($siswa->foto) {
            //     Storage::delete('public/foto/' . $siswa->foto);
            // }

            // Menghapus siswa dari database
            $kelas->delete();

            return redirect()->back()->with('success', 'Siswa berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kes
        }
    }

}
