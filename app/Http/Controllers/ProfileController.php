<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request, $id)
    {

        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {   
            $user = User::find($id);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }

            // Delete old photo if it exists
            if ($user->foto) {
                Storage::disk('')->delete($user->foto);
            }

            // Upload new photo
            $foto = $request->file('foto');
            $fotoPath = $foto->storeAs('foto', uniqid() . '.' . $foto->getClientOriginalExtension(), 'public');

            // Update user with the new photo path
            $user->update(['foto' => $fotoPath]);
            // dd($user);
            return redirect()->route('upload-photo', ['id' => $user->id])->with('success', 'Foto profil berhasil diunggah.');
        } catch (\Exception $e) {
            return redirect()->route('upload-photo', ['id' => $user->id])->with('error', 'Failed to upload photo: ' . $e->getMessage());
        }
    }

}