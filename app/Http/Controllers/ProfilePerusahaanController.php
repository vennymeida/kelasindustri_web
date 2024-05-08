<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Storage;


class ProfilePerusahaanController extends Controller
{
    public function index()
    {

        // $perusahaan = auth()->user()->perusahaan;
        $perusahaan = DB::table('users as us')->Leftjoin('perusahaan as ps', 'us.id', '=', 'ps.user_id')
            ->select(
                'us.name',
                'us.email',
                'ps.nama_pemilik',
                'ps.surat_mou',
                'ps.nama_perusahaan',
                'ps.logo_perusahaan',
                'ps.email_perusahaan',
                'ps.alamat_perusahaan',
                'ps.deskripsi',
                'ps.no_telp',
                'ps.website',
            )->where('us.id', '=', auth()->user()->id)->first();

        // dd($perusahaan);
        return view('profile.perusahaan', compact('perusahaan'));
    }


    public function edit()
    {
        // Logika untuk halaman pengeditan profil perusahaan
        // $perusahaan = auth()->user()->perusahaan;
        $perusahaan = DB::table('users as us')->Leftjoin('perusahaan as ps', 'us.id', '=', 'ps.user_id')
            ->select(
                'us.name',
                'us.email',
                'us.id as userId',
                'ps.nama_pemilik',
                'ps.surat_mou',
                'ps.nama_perusahaan',
                'ps.logo_perusahaan',
                'ps.email_perusahaan',
                'ps.alamat_perusahaan',
                'ps.deskripsi',
                'ps.no_telp',
                'ps.website',
                'ps.kota_id',
            )->where('us.id', '=', auth()->user()->id)->first();

        $kotas = DB::table('kotas')->get();

        // dd($perusahaan);
        return view('profile.edit-perusahaan', ['kotas' => $kotas, 'perusahaan' => $perusahaan]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nama_pemilik' => 'required',
            'user_id' => 'required',
            'nama_perusahaan' => 'required',
            'email_perusahaan' => 'required|email',
            'kota_id' => 'required',
            'alamat_perusahaan' => 'nullable|string',
            'website' => 'nullable',
            'no_telp' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'logo_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'surat_mou' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('logo_perusahaan')) {
            if ($user->perusahaan && $user->perusahaan->logo_perusahaan) {
                Storage::disk('public')->delete('logos/' . $user->perusahaan->logo_perusahaan);
            }
            $logoPath = $request->file('logo_perusahaan')->store('logos', 'public');
            $validatedData['logo_perusahaan'] = $logoPath;
        }

        if ($request->hasFile('surat_mou')) {
            if ($user->perusahaan && $user->perusahaan->surat_mou) {
                Storage::disk('public')->delete('mou/' . $user->perusahaan->surat_mou);
            }
            $mouPath = $request->file('surat_mou')->store('mou', 'public');
            $validatedData['surat_mou'] = $mouPath;
        } else {
            $validatedData['surat_mou'] = $user->perusahaan ? $user->perusahaan->surat_mou : null;
        }

        $perusahaan = Perusahaan::updateOrCreate(
            ['user_id' => $user->id],
            $validatedData
        );

        return redirect()->route('profile.perusahaan')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
