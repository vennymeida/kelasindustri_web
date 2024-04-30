<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Storage;


class ProfilePerusahaanController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan profil perusahaan
        $perusahaan = auth()->user()->perusahaan;
        $kotas = Kota::all();
        return view('profile.perusahaan', compact('perusahaan', 'kotas'));
    }

    public function edit()
    {
        // Logika untuk halaman pengeditan profil perusahaan
        $perusahaan = auth()->user()->perusahaan;
        $kotas = Kota::all();
        return view('profile.edit-perusahaan', compact('perusahaan', 'kotas'));
    }

        public function update(Request $request)
    {
        // Logika untuk menyimpan perubahan yang dilakukan oleh pengguna
        $perusahaan = auth()->user()->perusahaan;

        // Validasi data dari request
        $validatedData = $request->validate([
            'kota_id' => 'nullable',
            'nama_perusahaan' => 'nullable|string|max:255',
            'email_perusahaan' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'no_telp' => 'nullable|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,8}$/',
            'deskripsi' => 'nullable',
            'logo_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'surat_mou' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Cek jika ada file logo perusahaan yang diunggah
        if ($request->hasFile('logo_perusahaan')) {
            // Hapus logo perusahaan lama jika ada
            if ($perusahaan->logo_perusahaan) {
                Storage::delete(public_path('logos/' . $perusahaan->logo_perusahaan));
            }

            // Validasi file logo perusahaan
            $request->validate([
                'logo_perusahaan' => 'image|mimes:jpeg,png,jpg|max:2048', // Sesuaikan dengan kebutuhan Anda
            ]);

            // Simpan file logo perusahaan baru dan update path di database
            $logoPath = $request->file('logo_perusahaan')->store('logos', 'public');
            $validatedData['logo_perusahaan'] = $logoPath;
        }

        // Cek jika ada file surat MOU yang diunggah
        if ($request->hasFile('surat_mou')) {
            // Hapus surat MOU lama jika ada
            if ($perusahaan->surat_mou) {
                Storage::delete(public_path('mou/' . $perusahaan->surat_mou));
            }

            // Validasi file surat MOU
            $request->validate([
                'surat_mou' => 'file|mimes:pdf|max:2048', // Sesuaikan dengan kebutuhan Anda
            ]);

            // Simpan file surat MOU baru dan update path di database
            $mouPath = $request->file('surat_mou')->store('mou', 'public');
            $validatedData['surat_mou'] = $mouPath;
        }

        // Update data perusahaan
        $perusahaan->update($validatedData);

        $kotas = Kota::all();

        return redirect()->route('profile.perusahaan')
            ->with('success', 'Profil perusahaan berhasil diperbarui.')
            ->with('kotas', $kotas);
    }
}
