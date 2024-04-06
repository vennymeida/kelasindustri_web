<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
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

class LamarPerusahaanController extends Controller
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

        $perusahaan = Perusahaan::where('user_id', $user->id)->first();
        $loker = LowonganPekerjaan::where('user_id', $user->id)->first();

        $loggedInUserResults = DB::table('lamars as l')
            ->join('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->join('lulusans as lu', 'p.user_id', '=', 'lu.id')
            ->join('users as u', 'lu.user_id', '=', 'u.id')
            ->select(
                'l.id',
                'l.user_id',
                'p.user_id',
                'u.name',
                'lu.no_hp',
                'lu.foto',
                'l.resume',
                'u.email',
                'p.nama_perusahaan',
                'lp.nama_loker',
                'l.status',
                'l.created_at'
            )
            ->where('p.user_id', $loggedInUserId)
            ->when($request->has('posisi'), function ($query) use ($request) {
                $search = $request->input('posisi');
                return $query->where('lp.nama_loker', 'like', '%' . $search . '%');
            })
            ->when($selectedStatus, function ($query, $selectedStatus) {
                return $query->where('l.status', $selectedStatus);
            })
            ->orderBy('l.created_at', 'desc')
            ->paginate(4);

        if (Auth::user()->hasRole('perusahaan')) {
            if ($perusahaan == null) {
                return redirect()->route('profile.edit')->with('message-data', 'Lengkapi data profil dan data perusahaan terlebih dahulu sebelum menambahkan lowongan kerja dan mendapat pelamar kerja.');
            } elseif ($perusahaan == null) {
                return redirect()->route('profile.edit')->with('message-data', 'Lengkapi data perusahaan terlebih dahulu sebelum menambahkan lowongan kerja dan mendapat pelamar kerja.');
            } else {
                return view('lamar-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus,'perusahaan' => $perusahaan, 'loker' => $loker]);
            }
        } else {
            return view('lamar-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus,'perusahaan' => $perusahaan, 'loker' => $loker]);
        }
    }

    public function show($id)
    {
        $lamar = Lamar::findOrFail($id);

        $lamar->load(['lulusan.user', 'loker.perusahaan']);
        $lulusan = Lulusan::all();

        $lulusan->ringkasan = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', "\n", '', '', ''], $lulusan->ringkasan);
        $tanggalLahir = Carbon::parse($lulusan->tgl_lahir)->format('j F Y');

        $relasiLamar = $lamar->load(['lulusan.user', 'lulusan.user.profileKeahlians.keahlian', 'loker.perusahaan']);

        $namaPengguna = $relasiLamar->lulusan->user->name;
        $email = $relasiLamar->lulusan->user->email;
        $resume = $relasiLamar->lulusan->resume;
        $pendidikan = $relasiLamar->lulusan->user->pendidikan()->orderBy('created_at', 'desc')->get();
        $pengalaman = $relasiLamar->lulusan->user->pengalaman()->orderBy('created_at', 'desc')->get();
        $tanggal_mulai = optional($relasiLamar->lulusan->user->pengalaman)->tanggal_mulai ? Carbon::parse($relasiLamar->lulusan->user->pengalaman->tanggal_mulai)->format('j F Y') : '';
        $tanggal_berakhir = optional($relasiLamar->lulusan->user->pengalaman)->tanggal_berakhir ? Carbon::parse($relasiLamar->lulusan->user->pengalaman->tanggal_berakhir)->format('j F Y') : '';

        $pelatihan = $relasiLamar->lulusan->user->pelatihan()->orderBy('created_at', 'desc')->get();
        $judulPekerjaan = $relasiLamar->loker->nama_loker;
        $namaPerusahaan = $relasiLamar->loker->perusahaan->nama_perusahaan;

        return view('lamar-perusahaan.detail', [
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_berakhir' => $tanggal_berakhir,
            'namaPengguna' => $namaPengguna,
            'email' => $email,
            'resume' => $resume,
            'judulPekerjaan' => $judulPekerjaan,
            'namaPerusahaan' => $namaPerusahaan,
            'lamar' => $lamar,
            'pendidikan' => $pendidikan,
            'pengalaman' => $pengalaman,
            'pelatihan' => $pelatihan,
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
            'lokers.user_id',
            'lokers.perusahaan_id',
            'lokers.nama_loker'
        )
            ->where('id', $lamar->loker_id)
            ->first();
        // dd($getPerusahaanId);
        $userIdFromProfile = Lulusan::select('lulusans.user_id')->where('id', $lamar->user_id)->first();
        $getUserId = User::select('users.name', 'users.email')->where('id', $userIdFromProfile->user_id)->first();
        $getPerusahaan = Perusahaan::select('perusahaan.nama_perusahaan')
            ->where('id', $getPerusahaanId->perusahaan_id)
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
