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
        try {
            // Validate the incoming request data
            $request->validate([
                'jurusan' => 'required|string|max:255',
                'tingkat_kelas' => 'required|numeric|min:1|max:255|unique:kelas', // Menambahkan aturan unique
            ], [
                'jurusan.required' => 'Kolom jurusan harus diisi.',
                'tingkat_kelas.required' => 'Kolom tingkat kelas harus diisi.',
                'tingkat_kelas.unique' => 'Kelas sudah ada dalam database.', // Pesan validasi jika kelas sudah ada
            ]);

            // Create a new Kelas instance
            $kelas = Kelas::create([
                'jurusan' => $request->jurusan,
                'tingkat_kelas' => $request->tingkat_kelas
            ]);

            return redirect()->back()->with('success', 'Kelas berhasil disimpan.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Gagal menyimpan kelas. Kelas sudah ada dalam database.')->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'jurusan' => 'required|string|max:255',
                'tingkat_kelas' => 'required|string|max:255|unique:kelas,tingkat_kelas,' . $id, // Menambahkan aturan unique dengan pengecualian pada ID yang sedang diupdate
            ], [
                'jurusan.required' => 'Kolom jurusan harus diisi.',
                'tingkat_kelas.required' => 'Kolom tingkat kelas harus diisi.',
                'tingkat_kelas.unique' => 'Kelas sudah ada dalam database.', // Pesan validasi jika kelas sudah ada
            ]);

            // Update the Kelas with the validated data
            $kelas = Kelas::find($id); // Replace $id with the actual ID of the record you want to update

            if ($kelas) {
                $kelas->update([
                    'jurusan' => $request->jurusan,
                    'tingkat_kelas' => $request->tingkat_kelas
                ]);
            }

            return redirect()->back()->with('success', 'Kelas berhasil diperbarui.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Gagal memperbarui kelas. Kelas sudah ada dalam database.')->withInput();
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
