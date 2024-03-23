<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\User;
use App\Http\Requests\StorelamarRequest;
use App\Http\Requests\UpdatelamarRequest;
use App\Models\Lulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LamarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:pelamarkerja.index')->only('index');
        $this->middleware('permission:pelamarkerja.create')->only('create', 'store');
        $this->middleware('permission:pelamarkerja.edit')->only('edit', 'update');
        $this->middleware('permission:pelamarkerja.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $statuses = ['pending', 'diterima', 'ditolak'];
        $selectedStatus = $request->input('status');

        $allResults = DB::table('lamars as l')
            ->join('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->join('lulusans as lu', 'l.user_id', '=', 'lu.id')
            ->join('users as u', 'lu.user_id', '=', 'u.id')
            ->select(
                'l.id',
                'l.user_id',
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
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                return $query->where('lp.nama_loker', 'like', '%' . $search . '%')
                    ->orWhere('u.name', 'like', '%' . $search . '%')
                    ->orWhere('p.nama_perusahaan', 'like', '%' . $search . '%');
            })
            ->when($selectedStatus, function ($query, $selectedStatus) {
                return $query->where('l.status', $selectedStatus);
            })
            ->paginate(10);

        $loggedInUserId = Auth::id();
        $user = auth()->user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();
        $loker = LowonganPekerjaan::where('perusahaan_id', $user->id)->first();

        $loggedInUserResults = DB::table('lamars as l')
            ->join('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->join('lulusans as lu', 'l.user_id', '=', 'lu.id')
            ->join('users as u', 'lu.user_id', '=', 'u.id')
            ->select(
                'l.id',
                'u.name',
                'lu.no_hp',
                'lu.foto',
                'lu.resume',
                'u.email',
                'p.nama_perusahaan',
                'lp.nama_loker',
                'l.status',
                'p.user_id',
                'l.created_at'
            )
            ->where('p.user_id', $loggedInUserId)
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                return $query->where('lp.nama_loker', 'like', '%' . $search . '%')
                    ->orWhere('u.name', 'like', '%' . $search . '%')
                    ->orWhere('p.nama_perusahaan', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        if (Auth::user()->hasRole('perusahaan')) {
            if ($user == null && $perusahaan == null) {
                return redirect()->route('profile.edit');
            } else {
                return view('lamar.index', ['allResults' => $allResults, 'loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'perusahaan' => $perusahaan, 'loker' => $loker]);
            }
        } else {
            return view('lamar.index', ['allResults' => $allResults, 'loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus,'perusahaan' => $perusahaan, 'loker' => $loker]);
        }
    }

    public function create()
    {
        //
    }


    public function store(StorelamarRequest $request)
    {
        //
    }

    public function show($id)
    {
        $lamar = Lamar::findOrFail($id); // Finding Lamar data by ID

        $lulusan = $lamar->lulusan;
        $lulusan->ringkasan = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', "\n", '', '', ''], $lulusan->ringkasan);
        $tanggalLahir = Carbon::parse($lulusan->tgl_lahir)->format('j F Y');

        // Loading the necessary relationships for display on the details page
        $relasiLamar = $lamar->load([
            'lulusan.user',
            'loker.perusahaan'
        ]);

        // If these relations do not exist or are named differently in your models, you'll need to adjust them accordingly

        $tanggal_mulai = optional($relasiLamar->lulusan->user->pengalaman)->tanggal_mulai ? Carbon::parse($relasiLamar->lulusan->user->pengalaman->tanggal_mulai)->format('j F Y') : '';
        $tanggal_berakhir = optional($relasiLamar->lulusan->user->pengalaman)->tanggal_berakhir ? Carbon::parse($relasiLamar->lulusan->user->pengalaman->tanggal_berakhir)->format('j F Y') : '';

        // Extracting the necessary information from the relations
        $namaPengguna = $relasiLamar->lulusan->user->name;
        $email = $relasiLamar->lulusan->user->email;
        $resume = $relasiLamar->lulusan->user->resume;
        $pendidikan = $relasiLamar->lulusan->user->pendidikan()->orderBy('created_at', 'desc')->get();
        $pengalaman = $relasiLamar->lulusan->user->pengalaman()->orderBy('created_at', 'desc')->get();
        $pelatihan = $relasiLamar->lulusan->user->pelatihan()->orderBy('created_at', 'desc')->get();
        $judulPekerjaan = $relasiLamar->loker->judul;
        $namaPerusahaan = $relasiLamar->loker->perusahaan->nama_perusahaan;

        return view('lamar.detail', [
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_berakhir' => $tanggal_berakhir,
            'namaPengguna' => $namaPengguna,
            'email' => $email,
            'resume' => $resume,
            'judulPekerjaan' => $judulPekerjaan,
            'namaPerusahaan' => $namaPerusahaan,
            'lamar' => $lamar,
            'lulusan' => $lulusan,
            'pendidikan' => $pendidikan,
            'pengalaman' => $pengalaman,
            'pelatihan' => $pelatihan,
            'tglLahir' => $tanggalLahir,
        ]);
    }



    public function edit($id)
    {
        $lamar = Lamar::findOrFail($id); // Mencari data Lamar berdasarkan ID
        return view('lamar.detail', compact('lamar'));
    }

    public function update(Request $request, $id)
    {
        $lamar = Lamar::findOrFail($id);

        $status = $request->input('status');

        $lamar->status = $status;
        $lamar->save();

        return redirect()->route('pelamarkerja.index')->with('success', 'Status berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $lamar = Lamar::findOrFail($id);

        $lamar->delete();

        return redirect()
            ->route('pelamarkerja.index')
            ->with('success', 'Data Pelamar Berhasil Di Hapus');
    }
}
