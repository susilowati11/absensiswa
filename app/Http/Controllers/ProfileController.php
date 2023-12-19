<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        // Hapus foto lama jika ada
        if ($user->foto) {
            Storage::delete('public/' . $user->foto);
        }

        // Simpan foto baru
        $fotoPath = $request->file('foto')->store('foto', 'public');
        $user->foto = $fotoPath;
        try {
            $user->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diunggah.');
    }
}
