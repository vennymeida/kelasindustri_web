<?php

namespace App\Http\Controllers;

use App\Models\lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\User;

class MelamarController extends Controller
{
    public function store(Request $request)
    {

        // Validasi jika tidak ada resume di profil dan juga tidak di-upload
        if (!auth()->user()->profile->resume && !$request->hasFile('resume')) {
            return back()->with('error', 'Anda harus mengunggah resume sebelum melamar.');
        }

        $request->validate([
            'resume' => 'mimes:pdf|max:2048' // mimes untuk format dan max untuk ukuran (dalam KB)
        ]);

        $data = $request->all();

        // Proses file resume jika ada yang di-upload
        if ($request->hasFile('resume')) {
            $resumeFile = $request->file('resume');
            $resumePath = $resumeFile->store('resumes', 'public');
            $data['resume'] = $resumePath;
        } else {
            // Jika tidak ada file yang di-upload, kita tetap menyertakan resume saat ini
            // dari profile_user ke tabel lamars tanpa mengubahnya di profile_user
            $data['resume'] = auth()->user()->profile->resume;
        }

        // Menyertakan id_loker dan id_pencari_kerja
        $data['id_loker'] = $request->input('loker_id');
        $data['id_pencari_kerja'] = auth()->user()->profile->id; // mengambil ID dari profile user
        // Simpan ke database
        $lamar = Lamar::create($data);
        $authId = auth()->user()->profile->id;
        $lamarId = $lamar->id;
        $getProfileUserId = ProfileUser::select('profile_users.user_id')
            ->where('id', $authId)
            ->first();
        $getUserId = User::select('users.name')
            ->where('id', $getProfileUserId->user_id)
            ->first();
        $getLowonganPekerjaan = LowonganPekerjaan::select(
            'lowongan_pekerjaans.id_perusahaan',
            'lowongan_pekerjaans.judul'
        )
            ->where('id', $data['id_loker'])
            ->first();
        $getPerusahaan = Perusahaan::select('perusahaan.email', 'perusahaan.nama')
            ->where('id', $getLowonganPekerjaan->id_perusahaan)
            ->first();
        $view = view('email', ['getPerusahaan' => $getPerusahaan, 'getLowonganPekerjaan' => $getLowonganPekerjaan, 'getUserId' => $getUserId, 'lamarId' => $lamarId])->render();
        $dataOke = [
            'name' => 'Lamaran',
            'body' => $view
        ];

        Mail::to($getPerusahaan->email)->send(new SendEmail($dataOke));

        return back()->with('success', 'Pekerjaan berhasil dilamar.');
    }
}
