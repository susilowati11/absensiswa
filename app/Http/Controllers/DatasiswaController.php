<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Datasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Make sure to import Hash

class DatasiswaController extends Controller
{
    public function index()
    {
        $datasiswa = User::where('role', 'user')->get();
        $kelas = Kelas::all();
        // dd($datasiswa);
        return view('admin.datasiswa', compact('datasiswa', 'kelas'));
    }

    // Assuming you are trying to create a Datasiswa and associate it with a User
    // ...

    public function store(Request $request)
    {

        // dd($request);
        // Validasi data untuk membuat Datasiswa
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255', // Validasi bahwa nama_siswa harus diisi
            'nis' => 'required|string|max:20|unique:datasiswa,nis',
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'no_tlp' => ['required', 'numeric', 'digits:12'],
            'email' => 'required|email|unique:datasiswa,email',

        ], [
            // 'user_id.required' => 'Kolom User ID harus diisi.',
            // 'user_id.exists' => 'User dengan ID yang dimasukkan tidak ditemukan.',
            'name.required' => 'Kolom Nama harus diisi.',
            'name.string' => 'Kolom Nama harus berupa teks.',
            'name.max' => 'Kolom Nama tidak boleh lebih dari :max karakter.',
            'nis.required' => 'Kolom NIS harus diisi.',
            'nis.string' => 'Kolom NIS harus berupa teks.',
            'nis.max' => 'Kolom NIS tidak boleh lebih dari :max karakter.',
            'nis.unique' => 'NIS sudah digunakan oleh siswa lain.',
            'kelas_id.required' => 'Kolom Kelas ID harus diisi.',
            'kelas_id.exists' => 'Kelas dengan ID yang dimasukkan tidak ditemukan.',
            'jenis_kelamin.required' => 'Kolom Jenis Kelamin harus diisi.',
            'jenis_kelamin.in' => 'Kolom Jenis Kelamin harus diisi dengan Laki-laki atau Perempuan.',
            'tanggal_lahir.required' => 'Kolom Tanggal Lahir harus diisi.',
            'tanggal_lahir.date' => 'Kolom Tanggal Lahir harus berupa tanggal.',
            'alamat.required' => 'Kolom Alamat harus diisi.',
            'alamat.string' => 'Kolom Alamat harus berupa teks.',
            'alamat.max' => 'Kolom Alamat tidak boleh lebih dari :max karakter.',
            'no_tlp.required' => 'Kolom Nomor Telepon harus diisi.',
            'no_tlp.string' => 'Kolom Nomor Telepon harus berupa teks.',
            'digits' => 'Nomor telepon harus terdiri dari 12 digit.',
            'email.required' => 'Kolom Email harus diisi.',
            'email.email' => 'Format Email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh siswa lain.',
            // Tambahkan validasi untuk bidang lainnya sesuai kebutuhan
        ]);
        

        // Jika validasi gagal, kembalikan respon dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();

            // return response()->json($validator->errors());
        }
        // Buat pengguna baru
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>  bcrypt('password'),
            'nis' => $request->input('nis'),
            'kelas_id' => $request->input('kelas_id'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'no_tlp' => $request->input('no_tlp'),
        ]);
        $user->save();
        // Buat data siswa baru (Datasiswa)
        $datasiswa = Datasiswa::create([
            'user_id' => $user->id,
            'nama_siswa' => $request->input('name'),
            'nis' => $request->input('nis'),
            'kelas_id' => $request->input('kelas_id'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input
            ('alamat'),
            'nomor_telepon' => $request->input('no_tlp'),
            'email' => $request->input('email'),
            // tambahkan bidang lainnya sesuai kebutuhan
        ]);
        $datasiswa->save();
        return redirect()->back()->with('success', 'Data Berhasil ditambahkan');
        // Alihkan ke halaman indeks setelah membuat data
    }

    public function update(Request $request, $user_id)
    {
        $datasiswa = Datasiswa::where('user_id', $user_id)->first();
        // dd($datasiswa);
        if (!$datasiswa) {
            return redirect()->back()->with('error', 'Data not found for ID: ' . $user_id);
        }

        // Update the associated User if email changes
        // if ($request->input('email') != optional($datasiswa->user)->email) {
        // dd($user);
        if ($datasiswa->user) {
            $datasiswa->user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'nis' => $request->input('nis'),
                'kelas_id' => $request->input('kelas_id'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'alamat' => $request->input('alamat'),
                'no_tlp' => $request->input('no_tlp'),
            ]);
        }


        // Update the Datasiswa record
        $datasiswa->update([
            'nama_siswa' => $request->input('name'),
            'nis' => $request->input('nis'),
            'kelas_id' => $request->input('kelas_id'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'nomor_telepon' => $request->input('no_tlp'),
            'email' => $request->input('email'),
            // add other fields as needed
        ]);

        return redirect()->back()->with('success', 'Data Berhasil diupdate');
    }


   public function destroy($user_id)
{
    try {
        // Cari data siswa berdasarkan user_id
        $datasiswa = Datasiswa::where('user_id', $user_id)->firstOrFail();

        // Simpan nama file foto (dari tabel user) sebelum menghapus user
        $userFotoToDelete = $datasiswa->user->foto;

        // Simpan nama file foto (dari folder siswa_foto) sebelum menghapus user
        $siswaFotoToDelete = $datasiswa->foto;

        // Hapus data siswa
        $datasiswa->delete();

        // Hapus juga record pada tabel users
        User::where('id', $user_id)->delete();

        // Hapus file foto (dari tabel user) terkait
        if ($userFotoToDelete && Storage::disk('public')->exists($userFotoToDelete)) {
            Storage::disk('public')->delete($userFotoToDelete);
        }

        // Hapus file foto (dari folder siswa_foto) terkait
        if ($siswaFotoToDelete && Storage::disk('public')->exists($siswaFotoToDelete)) {
            Storage::disk('public')->delete($siswaFotoToDelete);
        }

        return redirect()->back()->with('success', 'Data siswa dan user berhasil dihapus');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data siswa dan user: ' . $e->getMessage());
    }
}

}
