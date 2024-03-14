<?php

namespace App\Http\Controllers;

use App\Models\Keahlian;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\KategoriPekerjaan;
use App\Models\ProfileUser;
use App\Models\User;
use App\Http\Requests\StoreLowonganPekerjaanRequest;
use App\Http\Requests\UpdateLowonganPekerjaanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LowonganPekerjaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:loker.index')->only('index');
        $this->middleware('permission:loker.create')->only('create', 'store');
        $this->middleware('permission:loker.edit')->only('edit', 'update');
        $this->middleware('permission:loker.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $statuses = ['pending', 'dibuka', 'ditutup'];
        $selectedStatus = $request->input('status');

        $allResults = DB::table('lokers as lp')
            ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
            ->join('lowongan_kategori as lk', 'lp.id', '=', 'lk.lowongan_id')
            ->join('kategori_pekerjaans as kp', 'lk.kategori_id', '=', 'kp.id')
            ->join('profile_users as pu', 'lp.user_id', '=', 'pu.id')
            ->join('users as u', 'pu.user_id', '=', 'u.id')
            ->select(
                'lp.id',
                'lp.user_id',
                'lp.id_perusahaan',
                'p.nama',
                'lp.judul',
                'lp.deskripsi',
                'lp.requirement',
                'lp.gaji_bawah',
                'lp.gaji_atas',
                'lp.tipe_pekerjaan',
                'lp.jumlah_pelamar',
                'lp.status',
                'lp.lokasi',
                'lp.tutup',
                'p.pemilik',
                DB::raw("GROUP_CONCAT(kp.kategori SEPARATOR ', ') as kategori"),
            )
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                return $query->where('p.nama', 'like', '%' . $search . '%')
                    ->orWhere('kp.kategori', 'like', '%' . $search . '%')
                    ->orWhere('lp.tipe_pekerjaan', 'like', '%' . $search . '%');
            })
            ->when($selectedStatus, function ($query, $selectedStatus) {
                return $query->where('lp.status', $selectedStatus);
            })
            ->groupBy('lp.id', 'lp.user_id', 'lp.id_perusahaan', 'p.nama', 'lp.judul', 'lp.deskripsi', 'lp.requirement', 'lp.gaji_bawah', 'gaji_atas', 'lp.tipe_pekerjaan', 'lp.jumlah_pelamar', 'lp.status', 'lp.tutup', 'lp.lokasi', 'p.pemilik')
            ->paginate(10);

        foreach ($allResults as $requirement) {
            $requirement->requirement = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', "\n", '', '', "\n"], $requirement->requirement);
        }

        $loggedInUserId = Auth::id();
        $user = auth()->user();

        $profileUser = ProfileUser::where('user_id', $user->id)->first();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();


        $loggedInUserResults = DB::table('lowongan_pekerjaans as lp')
            ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
            ->join('lowongan_kategori as lk', 'lp.id', '=', 'lk.lowongan_id')
            ->join('lowongan_keahlian as ls', 'lp.id', '=', 'ls.lowongan_id')
            ->join('kategori_pekerjaans as kp', 'lk.kategori_id', '=', 'kp.id')
            ->join('keahlians as k', 'ls.keahlian_id', '=', 'k.id')
            ->join('profile_users as pu', 'lp.user_id', '=', 'pu.id')
            ->join('users as u', 'pu.user_id', '=', 'u.id')
            ->select(
                'lp.id',
                'lp.user_id',
                'lp.id_perusahaan',
                'p.nama',
                'lp.judul',
                'lp.deskripsi',
                'lp.requirement',
                'lp.gaji_bawah',
                'lp.gaji_atas',
                'lp.tipe_pekerjaan',
                'lp.jumlah_pelamar',
                'lp.status',
                'lp.lokasi',
                'lp.tutup',
                'p.pemilik',
                DB::raw("GROUP_CONCAT(kp.kategori SEPARATOR ', ') as kategori"),
                DB::raw("GROUP_CONCAT(k.keahlian SEPARATOR ', ') as keahlian"),
            )
            ->where('u.id', $loggedInUserId)
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                return $query->where('lp.judul', 'like', '%' . $search . '%')
                    ->orWhere('lp.deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('lp.requirement', 'like', '%' . $search . '%')
                    ->orWhere('lp.status', 'like', '%' . $search . '%');
            })
            ->groupBy('lp.id', 'lp.user_id', 'lp.id_perusahaan', 'p.nama', 'lp.judul', 'lp.deskripsi', 'lp.requirement', 'lp.gaji_bawah', 'gaji_atas', 'lp.tipe_pekerjaan', 'lp.jumlah_pelamar', 'lp.status', 'lp.tutup', 'lp.lokasi', 'p.pemilik')
            ->paginate(10);

        foreach ($loggedInUserResults as $requirement) {
            $requirement->requirement = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', ", ", '', '', "\n"], $requirement->requirement);
            $requirement->requirement = rtrim($requirement->requirement, ', ');
        }

        if (Auth::user()->hasRole('Perusahaan')) {
            if ($profileUser == null && $perusahaan == null) {
                return redirect()->route('profile.edit')->with('message', 'Lengkapi data profil dan data perusahaan terlebih dahulu untuk menambahkan lowongan kerja.');
            } elseif ($profileUser == null) {
                return redirect()->route('profile.edit')->with('message', 'Lengkapi data profil terlebih dahulu untuk menambahkan lowongan kerja.');
            } elseif ($perusahaan == null) {
                return redirect()->route('profile.edit')->with('message', 'Lengkapi data perusahaan terlebih dahulu untuk menambahkan lowongan kerja.');
            } else {
                return view('loker.index', ['allResults' => $allResults, 'loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'profilUser' => $profileUser, 'perusahaan' => $perusahaan]);
            }
        } else {
            return view('loker.index', ['allResults' => $allResults, 'loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'profilUser' => $profileUser, 'perusahaan' => $perusahaan]);
        }
    }


    public function create()
    {
        $kategoris = KategoriPekerjaan::all();
        $keahlians = Keahlian::all();

        $user = auth()->user();
        $profileUser = ProfileUser::where('user_id', $user->id)->first();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker.create', [
            'kategoris' => $kategoris,
            'keahlians' => $keahlians,
            'user' => $user,
            'perusahaan' => $perusahaan,
            'profileUser' => $profileUser,
        ])->with(['kategoris' => $kategoris, 'keahlians' => $keahlians]);
    }

    public function store(StoreLowonganPekerjaanRequest $request)
    {
        $lowongan = LowonganPekerjaan::create([
            'user_id' => $request->user_id,
            'id_perusahaan' => $request->id_perusahaan,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'requirement' => $request->requirement,
            'tipe_pekerjaan' => $request->tipe_pekerjaan,
            'min_pendidikan' => $request->min_pendidikan,
            'min_pengalaman' => $request->min_pengalaman,
            'gaji_bawah' => $request->gaji_bawah,
            'gaji_atas' => $request->gaji_atas,
            'jumlah_pelamar' => $request->jumlah_pelamar,
            'tutup' => $request->tutup,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
        ]);

        $lowongan->kategori()->attach($request->id_kategori);
        $lowongan->keahlian()->attach($request->id_keahlian);

        return redirect()->route('loker.index')
            ->with('success', 'Lowongan Pekerjaan berhasil ditambahkan');
    }

    public function show(LowonganPekerjaan $lowonganPekerjaan)
    {
    }

    public function edit(LowonganPekerjaan $loker)
    {
        $kategoris = KategoriPekerjaan::all();
        $keahlians = Keahlian::all();
        $user = auth()->user();
        $profileUser = ProfileUser::where('user_id', $user->id)->first();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker.edit', [
            'loker' => $loker,
            'kategoris' => $kategoris,
            'keahlians' => $keahlians,
            'user' => $user,
            'perusahaan' => $perusahaan,
            'profileUser' => $profileUser,
        ])->with(['kategoris' => $kategoris, 'keahlians' => $keahlians]);
    }

    public function update(UpdateLowonganPekerjaanRequest $request, LowonganPekerjaan $loker)
    {
        $loker->update($request->all());

        $loker->kategori()->sync($request->id_kategori);
        $loker->keahlian()->sync($request->id_keahlian);

        return redirect()->route('loker.index')
            ->with('success', 'Data lowongan pekerjaan berhasil diperbarui.');
    }


    public function destroy(LowonganPekerjaan $loker)
    {
        try {
            $loker->delete();
            return redirect()->route('loker.index')->with('success', 'Data Lowongan Berhasil Di Hapus');
        } catch (\Exception $e) {
            return redirect()->route('loker.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function allJobs()
    {
        return view('loker.all-jobs');
    }
}
