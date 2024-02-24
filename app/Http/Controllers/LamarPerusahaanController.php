<?php

namespace App\Http\Controllers;

use App\Models\lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\KategoriPekerjaan;
use App\Models\ProfileUser;
use App\Models\User;
use App\Http\Requests\StorelamarRequest;
use App\Http\Requests\UpdatelamarRequest;
use App\Mail\SendEmailPelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class LamarPerusahaan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:lamarperusahaan.index')->only('index');
        $this->middleware('permission:lamarperusahaan.edit')->only('edit', 'update');
        $this->middleware('permission:lamarperusahaan.show')->only('show');
    }

    public function index(Request $request)
    {
        $statuses = ['Pending', 'Diterima', 'Ditolak'];
        $selectedStatus = $request->input('status');

        $loggedInUserId = Auth::id();
        $user = auth()->user();

        $profileUser = ProfileUser::where('user_id', $user->id)->first();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();
        $loker = LowonganPekerjaan::where('user_id', $user->id)->first();

        $loggedInUserResults = DB::table('lamars as l')
            ->join('lowongan_pekerjaans as lp', 'l.id_loker', '=', 'lp.id')
            ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
            ->join('profile_users as pu', 'l.id_pencari_kerja', '=', 'pu.id')
            ->join('users as u', 'pu.user_id', '=', 'u.id')
            ->select('l.id', 'u.name', 'u.id as user_id', 'pu.no_hp', 'pu.foto', 'pu.resume', 'pu.alamat', 'pu.harapan_gaji', 'u.email', 'p.nama', 'lp.judul', 'l.status', 'l.created_at', 'pu.tgl_lahir')
            ->where('p.user_id', $loggedInUserId)
            ->when($request->has('posisi'), function ($query) use ($request) {
                $search = $request->input('posisi');
                return $query->where('lp.judul', 'like', '%' . $search . '%');
            })
            ->when($selectedStatus, function ($query, $selectedStatus) {
                return $query->where('l.status', $selectedStatus);
            })
            ->orderBy('l.created_at', 'desc')
            ->paginate(4);

        if (Auth::user()->hasRole('Perusahaan')) {
            if ($profileUser == null && $perusahaan == null) {
                return redirect()->route('profile.edit')->with('message-data', 'Lengkapi data profil dan data perusahaan terlebih dahulu sebelum menambahkan lowongan kerja dan mendapat pelamar kerja.');
            } elseif ($profileUser == null) {
                return redirect()->route('profile.edit')->with('message-data', 'Lengkapi data profil terlebih dahulu sebelum menambahkan lowongan kerja dan mendapat pelamar kerja.');
            } elseif ($perusahaan == null) {
                return redirect()->route('profile.edit')->with('message-data', 'Lengkapi data perusahaan terlebih dahulu sebelum menambahkan lowongan kerja dan mendapat pelamar kerja.');
            } else {
                return view('lamar-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'profilUser' => $profileUser, 'perusahaan' => $perusahaan, 'loker' => $loker]);
            }
        } else {
            return view('lamar-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'profilUser' => $profileUser, 'perusahaan' => $perusahaan, 'loker' => $loker]);
        }
    }

    public function show($id)
    {
        $lamar = Lamar::findOrFail($id);
        $profileUser = $lamar->pencarikerja;

        $lamar->load(['pencarikerja.user', 'loker.perusahaan']);

        $profileUser->ringkasan = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', "\n", '', '', ''], $profileUser->ringkasan);
        $tanggalLahir = Carbon::parse($profileUser->tgl_lahir)->format('j F Y');

        $relasiLamar = $lamar->load(['pencarikerja.user', 'pencarikerja.user.profileKeahlians.keahlian', 'loker.perusahaan']);

        $namaPengguna = $relasiLamar->pencarikerja->user->name;
        $email = $relasiLamar->pencarikerja->user->email;
        $resume = $relasiLamar->pencarikerja->user->resume;
        $pendidikan = $relasiLamar->pencarikerja->user->pendidikan()->orderBy('created_at', 'desc')->get();
        $pengalaman = $relasiLamar->pencarikerja->user->pengalaman()->orderBy('created_at', 'desc')->get();
        $tanggal_mulai = optional($relasiLamar->pencarikerja->user->pengalaman)->tanggal_mulai ? Carbon::parse($relasiLamar->pencarikerja->user->pengalaman->tanggal_mulai)->format('j F Y') : '';
        $tanggal_berakhir = optional($relasiLamar->pencarikerja->user->pengalaman)->tanggal_berakhir ? Carbon::parse($relasiLamar->pencarikerja->user->pengalaman->tanggal_berakhir)->format('j F Y') : '';

        $pelatihan = $relasiLamar->pencarikerja->user->pelatihan()->orderBy('created_at', 'desc')->get();
        $keahlian = $profileUser->user->keahlians;
        $judulPekerjaan = $relasiLamar->loker->judul;
        $namaPerusahaan = $relasiLamar->loker->perusahaan->nama;

        return view('lamar-perusahaan.detail', [
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_berakhir' => $tanggal_berakhir,
            'namaPengguna' => $namaPengguna,
            'email' => $email,
            'resume' => $resume,
            'judulPekerjaan' => $judulPekerjaan,
            'namaPerusahaan' => $namaPerusahaan,
            'lamar' => $lamar,
            'profileUser' => $profileUser,
            'pendidikan' => $pendidikan,
            'pengalaman' => $pengalaman,
            'pelatihan' => $pelatihan,
            'keahlian' => $keahlian,
            'tglLahir' => $tanggalLahir,
        ]);
    }

    public function edit($id)
    {
        $lamar = Lamar::findOrFail($id);
        return view('lamar.detail', compact('lamar'));
    }

    public function update(Request $request, $id)
    {
        $lamar = Lamar::findOrFail($id);

        $status = $request->input('status');

        $lamar->status = $status;
        $lamar->save();

        // $authId = auth()->user()->profile->id;
        // $lamarId = $lamar->id;

        $getPerusahaanId = LowonganPekerjaan::select(
            'lowongan_pekerjaans.user_id',
            'lowongan_pekerjaans.id_perusahaan',
            'lowongan_pekerjaans.judul'
        )
            ->where('id', $lamar->id_loker)
            ->first();
        // dd($getPerusahaanId);
        $userIdFromProfile = ProfileUser::select('profile_users.user_id')->where('id', $lamar->id_pencari_kerja)->first();
        $getUserId = User::select('users.name', 'users.email')->where('id', $userIdFromProfile->user_id)->first();
        $getPerusahaan = Perusahaan::select('perusahaan.nama')
            ->where('id', $getPerusahaanId->id_perusahaan)
            ->first();
        $view = view('email-pelamar', ['getPerusahaan' => $getPerusahaan, 'getPerusahaanId' => $getPerusahaanId, 'getUserId' => $getUserId, 'lamar' => $lamar])->render();
        $dataOkeOke = [
            'name' => 'Jawaban Lamaran',
            'body' => $view
        ];

        Mail::to($getUserId->email)->send(new SendEmailPelamar($dataOkeOke));

        return redirect()
            ->route('lamarperusahaan.index')
            ->with('success', 'success-status');
    }
}
