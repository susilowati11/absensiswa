<?php

namespace App\Http\Controllers;

use App\Models\Datasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Make sure to import Hash
use App\Http\Controllers\Controller;
use App\Models\Kelas;

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
        // Display request data
        // dd($request->all());

        // Validasi permintaan
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users|max:255',
        //     'password' => 'required|string|min:8',
        //     'nis' => 'required|string|max:255',
        //     'kelas_id' => 'required|numeric',
        //     'jenis_kelamin' => 'required|string|max:255',
        //     'tanggal_lahir' => 'required|date',
        //     'alamat' => 'required|string',
        //     'no_tlp' => 'required|string|max:255', // Tambahkan validasi untuk nomor telepon
        // ],[
        //     'name.required' => 'Inputan harus di isi',
        //     'email.required'=>'inputan harus diisi',
        //     'password.required'=>'inputan harus diisi',
        //     'nis.required'=>'inputan harus diisi',
        //     'kelas_id.required'=>'inputan harus diisi',
        //     'jenis_kelamin.required'=>'inputan harus diisi',
        //     'tanggal_lahir.required'=>'inputan harus diisi',
        //     'alamat.required'=>'inputan harus diisi',
        //     'no_tlp.required'=>'inputan harus diisi',
        // ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
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
            'alamat' => $request->input('alamat'),
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

        // Hapus data siswa
        $datasiswa->delete();

        // Hapus juga record pada tabel users
        User::where('id', $user_id)->delete();

        return redirect()->back()->with('success', 'Data siswa dan user berhasil dihapus');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data siswa dan user: ' . $e->getMessage());
    }
}
}
