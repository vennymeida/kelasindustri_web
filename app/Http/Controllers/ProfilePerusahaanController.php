<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;

class ProfilePerusahaanController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan profil perusahaan
        $perusahaan = auth()->user()->perusahaan;
        return view('profile.perusahaan', compact('perusahaan'));
    }

    public function edit()
    {
        // Logika untuk halaman pengeditan profil perusahaan
        $perusahaan = auth()->user()->perusahaan;
        return view('profile.edit-perusahaan', compact('perusahaan'));
    }

    public function update(Request $request)
    {
        // Logika untuk menyimpan perubahan yang dilakukan oleh pengguna
        $perusahaan = auth()->user()->perusahaan;

        // Validasi data dari request
        $validatedData = $request->validate([
            'nama_perusahaan' => 'required',
            'email_perusahaan' => 'required|email',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        // Update data perusahaan
        $perusahaan->update($validatedData);

        return redirect()->route('profile.perusahaan')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
