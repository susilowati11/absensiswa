<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();


        return view('Admin.kelas', compact('kelas'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'jurusan' => 'required|string|max:255',
            'tingkat_kelas' => 'required|numeric|min:1|max:255',

        ], [
            'jurusan.required' => 'Kolom jurusan harus diisi.',
            'tingkat_kelas.required' => 'Kolom tingkat kelas harus diisi.',
        ]);

        // Create a new Kelas instance
        $kelas = Kelas::create([
            'jurusan' => $request->jurusan,
            'tingkat_kelas' => $request->tingkat_kelas
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil disimpan.');
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
            // Menggunakan metode findOrFail untuk menemukan kelas berdasarkan ID
            $kelas = Kelas::findOrFail($id);

            // // Mengecek apakah kelas masih memiliki siswa terkait
            // if ($kelas->siswa()->exists()) {
            // }
            
            // Menghapus kelas dari database
            $kelas->delete();
            
            return redirect()->back()->with('success', 'Kelas berhasil dihapus');
        } catch (\Exception $e) {
            // Tangani kesalahan di sini
            // return redirect()->back()->with('error', 'Gagal menghapus kelas: ' );
            return redirect()->back()->with('error', 'Data masih digunakan');
        }
    }
}
