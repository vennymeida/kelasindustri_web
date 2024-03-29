<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Superadmin;
use Illuminate\Support\Facades\Storage;


class ProfileSuperadminController extends Controller
{
    public function index()
    {
        return view('profile.super-admin');
    }

        public function update(Request $request)
    {
        $request->validate([
            // Validasi lainnya
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::find(auth()->user()->id);
        // $user->name = $request->name;
        // $user->email = $request->email;
        $user->save();

        $superadmin = $user->superadmin ? $user->superadmin : new Superadmin();
        $superadmin->user_id = $user->id;
        $superadmin->alamat = $request->alamat;
        $superadmin->jenis_kelamin = $request->jenis_kelamin;
        $superadmin->no_hp = $request->no_hp;

        // Penyimpanan foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($superadmin->foto) {
                Storage::delete('images/' . $superadmin->foto);
            }

            $fotoName = time() . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('images'), $fotoName);
            $superadmin->foto = $fotoName; // Simpan nama file di database
        }

        $superadmin->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
