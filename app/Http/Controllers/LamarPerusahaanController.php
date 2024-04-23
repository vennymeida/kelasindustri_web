<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\User;
use App\Models\Lulusan;
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
        $loker = LowonganPekerjaan::where('perusahaan_id', $user->id)->first();

        $loggedInUserResults = DB::table('lamars as l')
            ->join('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->join('lulusans as lu', 'p.user_id', '=', 'lu.id')
            ->join('users as u', 'lu.user_id', '=', 'u.id')
            ->select(
                'l.id',
                'u.name',
                'l.user_id',
                'p.user_id',
                'u.name',
                'lu.no_hp',
                'lu.tgl_lahir',
                'lu.alamat',
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
                return redirect()->route('profile-perusahaan.edit')->with('message-data', 'Lengkapi data profil dan data perusahaan terlebih dahulu sebelum menambahkan lowongan kerja dan mendapat pelamar kerja.');
            } elseif ($perusahaan == null) {
                return redirect()->route('profile-perusahaan.edit')->with('message-data', 'Lengkapi data perusahaan terlebih dahulu sebelum menambahkan lowongan kerja dan mendapat pelamar kerja.');
            } else {
                return view('lamar-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'perusahaan' => $perusahaan, 'loker' => $loker]);
            }
        } else {
            return view('lamar-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'perusahaan' => $perusahaan, 'loker' => $loker]);
        }
    }

   
    public function show($id)
    {
        $lamar = Lamar::findOrFail($id);
        $lamaran = $lamar->lulusan;

        $lamar->load(['lulusan.user', 'loker.perusahaan']);

        $lamaran->ringkasan = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', "\n", '', '', ''], $lamaran->ringkasan);
        $tglLahir = Carbon::parse($lamaran->tgl_lahir)->format('j F Y');

        $relasiLamar = $lamar->load(['lulusan.user', 'loker.perusahaan']);

        $namaPengguna = $relasiLamar->lulusan->user->name;
        $email = $relasiLamar->lulusan->user->email;
        $resume = $relasiLamar->lulusan->resume;
        $pendidikan = $relasiLamar->lulusan->user->pendidikan()->orderBy('created_at', 'desc')->get();
        $pengalaman = $relasiLamar->lulusan->user->pengalaman()->orderBy('created_at', 'desc')->get();
        $tgl_mulai = optional($relasiLamar->lulusan->user->pengalaman)->tgl_mulai ? Carbon::parse($lamar->lulusan->user->pengalaman->tgl_mulai)->format('j F Y') : '';
        $tgl_selesai = optional($relasiLamar->lulusan->user->pengalaman)->tgl_selesai ? Carbon::parse($lamar->lulusan->user->pengalaman->tgl_selesai)->format('j F Y') : '';

        $pelatihan = $relasiLamar->lulusan->user->pelatihan()->orderBy('created_at', 'desc')->get();
        $judulPekerjaan = $relasiLamar->loker->nama_loker;
        $namaPerusahaan = $relasiLamar->loker->perusahaan->nama_perusahaan;

        return view('lamar-perusahaan.detail', [
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'namaPengguna' => $namaPengguna,
            'email' => $email,
            'resume' => $resume,
            'judulPekerjaan' => $judulPekerjaan,
            'namaPerusahaan' => $namaPerusahaan,
            'lamar' => $lamar,
            'pendidikan' => $pendidikan,
            'pengalaman' => $pengalaman,
            'pelatihan' => $pelatihan,
            'tglLahir' => $tglLahir,
        ]);
    }

    public function edit($id)
    {
        $lamar = Lamar::findOrFail($id);
        return view('lamar.detail', compact('lamar'));
    }

    public function store(Request $request, Lamar $lamar)
    {
        // // Validasi permintaan
        // $request->validate([
        //     'lamar_id' => 'required|exists:lamars,id', // Pastikan lamar_id tersedia dalam tabel lamars
        //     'subject' => 'nullable|string',
        //     'tempat_interview' => 'nullable|string',
        //     'alamat' => 'nullable|string',
        //     'tanggal_interview' => 'nullable|date',
        //     'catatan' => 'nullable|string',
        // ]);

        // // Ambil data Lamar berdasarkan lamar_id
        // $lamar = Lamar::findOrFail($request->input('lamar_id'));

        // // Buat entri baru di Lamar
        // $lamarPerusahaan = new Lamar();
        // $lamarPerusahaan->lamar_id = $lamar->id; // Set lamar_id
        // $lamarPerusahaan->subject = $request->input('subject');
        // $lamarPerusahaan->tempat_interview = $request->input('tempat_interview');
        // $lamarPerusahaan->alamat = $request->input('alamat');
        // $lamarPerusahaan->tanggal_interview = $request->input('tanggal_interview');
        // $lamarPerusahaan->catatan = $request->input('catatan');
        // // Simpan entri LamarPerusahaan
        // $lamarPerusahaan->save();

        // Validasi request
        // $request->validate([
        //     'subject' => 'nullable|string',
        //     'tempat_interview' => 'nullable|string',
        //     'tanggal_interview' => 'nullable|date',
        //     'catatan' => 'nullable|string',
        // ]);

        // // Cari data Lamar berdasarkan ID
        // $lamar = Lamar::findOrFail($id);

        // // Simpan data yang diterima dari request ke dalam model Lamar
        // $lamar->update($request->only(['subject', 'tempat_interview', 'tanggal_interview', 'catatan']));



        // Redirect atau tampilkan respons sesuai kebutuhan

        $lamarId = Lamar::where('id', $lamar->id)->first();

        $lamarId->update([
            'subject' => $request->subject,
            'tempat_interview' => $request->tempat_interview,
            'tanggal_interview' => $request->tanggal_interview,
            'catatan' => $request->catatan,
        ]);
        return redirect()->route('lamarperusahaan.index')->with('success', 'Interview berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $lamar = Lamar::findOrFail($id);

        $status = $request->input('status');

        $lamar->status = $status;
        $lamar->save();

        // // Data untuk penjadwalan wawancara
        // $subject = $request->input('subject');
        // $tempatInterview = $request->input('tempat_interview');
        // $tanggalInterview = $request->input('tgl_interview');
        // $catatan = $request->input('catatan');

        // // Simpan data penjadwalan wawancara ke dalam database
        // $jadwalInterview = new Lamar();
        // $jadwalInterview->lamar_id = $id;
        // $jadwalInterview->subject = $subject;
        // $jadwalInterview->tempat_interview = $tempatInterview;
        // $jadwalInterview->tanggal_interview = $tanggalInterview;
        // $jadwalInterview->catatan = $catatan;
        // $jadwalInterview->save();

        $getPerusahaanId = LowonganPekerjaan::select(
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
