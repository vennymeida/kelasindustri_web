<?php

namespace App\Http\Controllers;

use App\Models\lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\KategoriPekerjaan;
use App\Models\ProfileUser;
use App\Models\ProfileKeahlian;
use App\Models\User;
use App\Http\Requests\StorelamarRequest;
use App\Http\Requests\UpdatelamarRequest;
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
            ->join('lowongan_pekerjaans as lp', 'l.id_loker', '=', 'lp.id')
            ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
            ->join('profile_users as pu', 'l.id_pencari_kerja', '=', 'pu.id')
            ->join('users as u', 'pu.user_id', '=', 'u.id')
            ->select(
                'l.id',
                'l.id_pencari_kerja',
                'u.name',
                'pu.no_hp',
                'pu.foto',
                'pu.resume',
                'u.email',
                'p.nama',
                'lp.judul',
                'l.status',
                'l.created_at'
            )
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                return $query->where('lp.judul', 'like', '%' . $search . '%')
                    ->orWhere('u.name', 'like', '%' . $search . '%')
                    ->orWhere('p.nama', 'like', '%' . $search . '%');
            })
            ->when($selectedStatus, function ($query, $selectedStatus) {
                return $query->where('l.status', $selectedStatus);
            })
            ->paginate(10);

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
            ->select(
                'l.id',
                'u.name',
                'pu.no_hp',
                'pu.foto',
                'pu.resume',
                'u.email',
                'p.nama',
                'lp.judul',
                'l.status',
                'p.user_id',
                'l.created_at'
            )
            ->where('p.user_id', $loggedInUserId)
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                return $query->where('lp.judul', 'like', '%' . $search . '%')
                    ->orWhere('u.name', 'like', '%' . $search . '%')
                    ->orWhere('p.nama', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        if (Auth::user()->hasRole('Perusahaan')) {
            if ($profileUser == null && $perusahaan == null) {
                return redirect()->route('profile.edit');
            } else {
                return view('lamar.index', ['allResults' => $allResults, 'loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'profilUser' => $profileUser, 'perusahaan' => $perusahaan, 'loker' => $loker]);
            }
        } else {
            return view('lamar.index', ['allResults' => $allResults, 'loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'profilUser' => $profileUser, 'perusahaan' => $perusahaan, 'loker' => $loker]);
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

        $profileUser = $lamar->pencarikerja;
        $profileUser->ringkasan = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', "\n", '', '', ''], $profileUser->ringkasan);
        $tanggalLahir = Carbon::parse($profileUser->tgl_lahir)->format('j F Y');

        // Loading the necessary relationships for display on the details page
        $relasiLamar = $lamar->load([
            'pencarikerja.user', // Existing relation
            'pencarikerja.user.profileKeahlians.keahlian', // Newly added relation to resolve N+1 problem
            'loker.perusahaan' // Existing relation
        ]);

        // If these relations do not exist or are named differently in your models, you'll need to adjust them accordingly

        $tanggal_mulai = optional($relasiLamar->pencarikerja->user->pengalaman)->tanggal_mulai ? Carbon::parse($relasiLamar->pencarikerja->user->pengalaman->tanggal_mulai)->format('j F Y') : '';
        $tanggal_berakhir = optional($relasiLamar->pencarikerja->user->pengalaman)->tanggal_berakhir ? Carbon::parse($relasiLamar->pencarikerja->user->pengalaman->tanggal_berakhir)->format('j F Y') : '';

        // Extracting the necessary information from the relations
        $namaPengguna = $relasiLamar->pencarikerja->user->name;
        $email = $relasiLamar->pencarikerja->user->email;
        $resume = $relasiLamar->pencarikerja->user->resume;
        $pendidikan = $relasiLamar->pencarikerja->user->pendidikan()->orderBy('created_at', 'desc')->get();
        $pengalaman = $relasiLamar->pencarikerja->user->pengalaman()->orderBy('created_at', 'desc')->get();
        $pelatihan = $relasiLamar->pencarikerja->user->pelatihan()->orderBy('created_at', 'desc')->get();
        $keahlian = $profileUser->user->keahlians;
        $keahlian = $relasiLamar->pencarikerja->user->profileKeahlians;
        $judulPekerjaan = $relasiLamar->loker->judul;
        $namaPerusahaan = $relasiLamar->loker->perusahaan->nama;

        return view('lamar.detail', [
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
