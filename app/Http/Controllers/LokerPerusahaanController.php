<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLokerPerusahaanRequest;
use App\Http\Requests\UpdateLokerPerusahaanRequest;
use App\Models\Kecamatan;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\KategoriPekerjaan;
use App\Models\Keahlian;
use App\Models\ProfileUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LokerPerusahaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:loker-perusahaan.index')->only('index');
        $this->middleware('permission:loker-perusahaan.create')->only('create', 'store');
        $this->middleware('permission:loker-perusahaan.edit')->only('edit', 'update');
        $this->middleware('permission:loker-perusahaan.show')->only('show');
    }

    public function getTimeAgo($timestamp)
    {
        $currentTime = Carbon::now();
        $timeDiff = $currentTime->diffInSeconds($timestamp);

        if ($timeDiff < 60) {
            return "Tayang {$timeDiff} detik yang lalu";
        } elseif ($timeDiff < 3600) {
            $minutes = floor($timeDiff / 60);
            return "Tayang {$minutes} menit yang lalu";
        } elseif ($timeDiff < 86400) {
            $hours = floor($timeDiff / 3600);
            return "Tayang {$hours} jam yang lalu";
        } else {
            $days = floor($timeDiff / 86400);
            return "Tayang {$days} hari yang lalu";
        }
    }

    public function index(Request $request)
    {
        $judul = $request->input('judul');
        $loggedInUserId = Auth::id();
        $user = auth()->user();

        $profileUser = ProfileUser::where('user_id', $user->id)->first();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        $loggedInUserResults = DB::table('lowongan_pekerjaans as lp')
            ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
            // ->join('lowongan_kategori as lk', 'lp.id', '=', 'lk.lowongan_id')
            // ->join('kategori_pekerjaans as kp', 'lk.kategori_id', '=', 'kp.id')
            ->join('lowongan_keahlian as ls', 'lp.id', '=', 'ls.lowongan_id')
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
                'lp.min_pengalaman',
                'lp.min_pendidikan',
                'lp.jumlah_pelamar',
                'lp.status',
                'lp.lokasi',
                'lp.tutup',
                'lp.updated_at',
                'p.pemilik',
                // DB::raw("GROUP_CONCAT(kp.kategori SEPARATOR ', ') as kategori"),
                DB::raw("GROUP_CONCAT(k.keahlian SEPARATOR ', ') as keahlian"),
            )
            ->when($judul, function ($allResults, $judul) {
                return $allResults->where('lp.judul', 'like', '%' . $judul . '%');
            })
            ->where('u.id', $loggedInUserId)
            ->groupBy('lp.id', 'lp.user_id', 'lp.id_perusahaan', 'p.nama', 'lp.judul', 'lp.deskripsi', 'lp.requirement', 'lp.gaji_bawah', 'gaji_atas', 'lp.tipe_pekerjaan', 'lp.jumlah_pelamar', 'lp.status', 'lp.tutup', 'lp.lokasi', 'lp.min_pengalaman', 'lp.min_pendidikan', 'lp.updated_at', 'p.pemilik')
            ->paginate(10);

        foreach ($loggedInUserResults as $requirement) {
            $requirement->requirement = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', ", ", '', '', "\n"], $requirement->requirement);
            $requirement->requirement = rtrim($requirement->requirement, ', ');

            $requirement->timeAgo = $this->getTimeAgo($requirement->updated_at);
        }

        if (Auth::user()->hasRole('Perusahaan')) {
            if ($profileUser == null && $perusahaan == null) {
                return redirect()->route('profile.edit')->with('message', 'Lengkapi data profil dan data perusahaan terlebih dahulu untuk menambahkan lowongan kerja.');
            } elseif ($profileUser == null) {
                return redirect()->route('profile.edit')->with('message', 'Lengkapi data profil terlebih dahulu untuk menambahkan lowongan kerja.');
            } elseif ($perusahaan == null) {
                return redirect()->route('profile.edit')->with('message', 'Lengkapi data perusahaan terlebih dahulu untuk menambahkan lowongan kerja.');
            } else {
                return view('loker-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults, 'profilUser' => $profileUser, 'perusahaan' => $perusahaan]);
            }
        } else {
            return view('loker-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults, 'profilUser' => $profileUser, 'perusahaan' => $perusahaan]);
        }
    }

    public function create()
    {
        $kategoris = KategoriPekerjaan::all();
        $keahlians = Keahlian::all();

        $user = auth()->user();
        $profileUser = ProfileUser::where('user_id', $user->id)->first();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker-perusahaan.create', [
            'kategoris' => $kategoris,
            'keahlians' => $keahlians,
            'user' => $user,
            'perusahaan' => $perusahaan,
            'profileUser' => $profileUser,
        ])->with(['kategoris' => $kategoris, 'keahlians' => $keahlians]);
    }

    public function store(StoreLokerPerusahaanRequest $request)
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

        return redirect()->route('loker-perusahaan.index')
            ->with('success', 'success-create');
    }

    public function show(LowonganPekerjaan $loker_perusahaan)
    {
        $perusahaan = Perusahaan::all();

        $kategori = $loker_perusahaan->kategori()->pluck('kategori')->implode(', ');
        $keahlian = $loker_perusahaan->keahlian()->pluck('keahlian');

        $updatedDiff = $loker_perusahaan->updated_at->diffInSeconds(now());

        if ($updatedDiff < 60) {
            $updatedAgo = $updatedDiff . ' detik yang lalu';
        } elseif ($updatedDiff < 3600) {
            $updatedAgo = floor($updatedDiff / 60) . ' menit yang lalu';
        } elseif ($updatedDiff < 86400) {
            $updatedAgo = floor($updatedDiff / 3600) . ' jam yang lalu';
        } else {
            $updatedAgo = $loker_perusahaan->updated_at->diffInDays(now()) . ' hari yang lalu';
        }

        return view('loker-perusahaan.show', ['loker_perusahaan' => $loker_perusahaan, 'perusahaan' => $perusahaan, 'kategori' => $kategori, 'keahlian' => $keahlian, 'updatedAgo' => $updatedAgo]);
    }

    public function edit(LowonganPekerjaan $loker_perusahaan)
    {
        $kategoris = KategoriPekerjaan::all();
        $keahlians = Keahlian::all();
        $user = auth()->user();
        $profileUser = ProfileUser::where('user_id', $user->id)->first();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker-perusahaan.edit', [
            'loker_perusahaan' => $loker_perusahaan,
            'kategoris' => $kategoris,
            'keahlians' => $keahlians,
            'user' => $user,
            'perusahaan' => $perusahaan,
            'profileUser' => $profileUser,
        ])->with(['kategoris' => $kategoris, 'keahlians' => $keahlians]);
    }

    public function update(UpdateLokerPerusahaanRequest $request, LowonganPekerjaan $loker_perusahaan)
    {
        $loker_perusahaan->update($request->all());

        $loker_perusahaan->kategori()->sync($request->id_kategori);
        $loker_perusahaan->keahlian()->sync($request->id_keahlian);

        return redirect()->route('loker-perusahaan.index')
            ->with('success', 'success-edit');
    }

    public function destroy($id)
    {
        //
    }
}
