<?php

namespace App\Http\Controllers;

use App\Models\Datasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Make sure to import Hash
use App\Http\Controllers\Controller;

class DatasiswaController extends Controller
{
    public function index()
    {
        $datasiswa = User::all();
        // dd($datasiswa);
        return view('admin.datasiswa', compact('datasiswa'));
    }

    // Assuming you are trying to create a Datasiswa and associate it with a User
    protected function create(Request $request)
    {
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

        $datasiswa = Datasiswa::create([
            // Add fields specific to Datasiswa model
            'user_id' => $user->id,
            'nama_siswa' => $request->input('nama_siswa'),
            'nis' => $request->input('nis'),
            'kelas_id' => $request->input('kelas_id'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'nomor_telepone' => $request->input('nomor_telepone'),
            'email' => $request->input('email'),
            // Add other fields as needed
        ]);

        return redirect()->route('datasiswa.index'); // Redirect to the index page after creating the data
    }
}
