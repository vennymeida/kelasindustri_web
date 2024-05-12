<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\Lulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\User;

class MelamarController extends Controller
{
    public function store(Request $request)
    {

        // Validasi jika tidak ada resume di profil dan juga tidak di-upload
        if (!auth()->user()->lulusan->resume && !$request->hasFile('resume')) {
            return back()->with('error', 'Anda harus mengunggah resume sebelum melamar.');
        }

        $request->validate([
            'resume' => 'mimes:pdf|max:2048' // mimes untuk format dan max untuk ukuran (dalam KB)
        ]);

        $data = $request->all();

        // Proses file resume jika ada yang di-upload
        if ($request->hasFile('resume')) {
            $resumeFile = $request->file('resume');
            $resumePath = $resumeFile->store('resume', 'public');
            $data['resume'] = $resumePath;
        } else {
            // Jika tidak ada file yang di-upload, kita tetap menyertakan resume saat ini
            $data['resume'] = auth()->user()->lulusan->resume;
        }

        // Menyertakan id_loker dan id_lulusan
        $data['id_loker'] = $request->input('loker_id');
        $data['user_id'] = auth()->user()->lulusan->id; // mengambil ID dari lulusan
        // Simpan ke database
        $lamar = Lamar::create($data);
        $authId = auth()->user()->lulusan->id;
        $lamarId = $lamar->id;
        $getLulusanId = Lulusan::select('lulusans.user_id')
            ->where('id', $authId)
            ->first();
        $getUserId = User::select('users.name')
            ->where('id', $getLulusanId->user_id)
            ->first();
        $getLowonganPekerjaan = LowonganPekerjaan::select(
            'lokers.perusahaan_id',
            'lokers.nama_loker'
        )
            ->where('id', $data['loker_id'])
            ->first();
        $getPerusahaan = Perusahaan::select('perusahaan.email_perusahaan', 'perusahaan.nama_perusahaan')
            ->where('id', $getLowonganPekerjaan->perusahaan_id)
            ->first();
        $view = view('email', ['getPerusahaan' => $getPerusahaan, 'getLowonganPekerjaan' => $getLowonganPekerjaan, 'getUserId' => $getUserId, 'lamarId' => $lamarId])->render();
        $dataOke = [
            'name' => 'Lamaran',
            'body' => $view
        ];

        Mail::to($getPerusahaan->email_perusahaan)->send(new SendEmail($dataOke));

        return back()->with('success', 'Pekerjaan berhasil dilamar.');
    }
}
