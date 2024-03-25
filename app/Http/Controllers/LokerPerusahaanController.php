<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLokerPerusahaanRequest;
use App\Http\Requests\UpdateLokerPerusahaanRequest;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
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
        $nama_loker = $request->input('nama_loker');
        $loggedInUserId = Auth::id();
        $user = auth()->user();

        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        $loggedInUserResults = DB::table('lokers as lp')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->select(
                'lp.id',
                'lp.perusahaan_id',
                'p.nama_perusahaan',
                'lp.nama_loker',
                'lp.deskripsi',
                'lp.persyaratan',
                'lp.gaji_bawah',
                'lp.gaji_atas',
                'lp.tipe_pekerjaan',
                'lp.kuota',
                'lp.keahlian',
                'lp.status',
                'lp.lokasi',
                'lp.tgl_tutup',
                'lp.updated_at',
                'p.nama_pemilik',
            )
            ->when($nama_loker, function ($allResults, $nama_loker) {
                return $allResults->where('lp.nama_loker', 'like', '%' . $nama_loker . '%');
            })
            ->where('u.id', $loggedInUserId)
            ->groupBy('lp.id','lp.perusahaan_id', 'p.nama_perusahaan', 'lp.nama_loker', 'lp.deskripsi', 'lp.persyaratan', 'lp.gaji_bawah', 'gaji_atas', 'lp.tipe_pekerjaan', 'lp.kuota', 'lp.keahlian', 'lp.status', 'lp.tgl_tutup', 'lp.lokasi','lp.updated_at', 'p.nama_pemilik')
            ->paginate(10);

        foreach ($loggedInUserResults as $persyaratan) {
            $persyaratan->persyaratan = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', ", ", '', '', "\n"], $persyaratan->persyaratan);
            $persyaratan->persyaratan = rtrim($persyaratan->persyaratan, ', ');

            $persyaratan->timeAgo = $this->getTimeAgo($persyaratan->updated_at);
        }

        if (Auth::user()->hasRole('perusahaan')) {
            if ($perusahaan == null) {
                return redirect()->route('profile.edit')->with('message', 'Lengkapi data profil dan data perusahaan terlebih dahulu untuk menambahkan lowongan kerja.');
            } elseif ($perusahaan == null) {
                return redirect()->route('profile.edit')->with('message', 'Lengkapi data perusahaan terlebih dahulu untuk menambahkan lowongan kerja.');
            } else {
                return view('loker-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults,'perusahaan' => $perusahaan]);
            }
        } else {
            return view('loker-perusahaan.index', ['loggedInUserResults' => $loggedInUserResults,'perusahaan' => $perusahaan]);
        }
    }

    public function create()
    {
        $user = auth()->user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker-perusahaan.create', [
            'user' => $user,
            'perusahaan' => $perusahaan,
        ]);
    }

    public function store(StoreLokerPerusahaanRequest $request)
    {
        // Ambil pengguna yang sedang login
    $user = auth()->user();

    // Dapatkan perusahaan yang terkait dengan pengguna yang sedang login
    $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        $lowongan = LowonganPekerjaan::create([
            'perusahaan_id' => $perusahaan->id,
            'nama_loker' => $request->nama_loker,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'tipe_pekerjaan' => $request->tipe_pekerjaan,
            'gaji_bawah' => $request->gaji_bawah,
            'gaji_atas' => $request->gaji_atas,
            'kuota' => $request->kuota,
            'keahlian' => $request->keahlian,
            'tgl_tutup' => $request->tgl_tutup,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
        ]);

        return redirect()->route('loker-perusahaan.index')
            ->with('success', 'success-create');
    }

    public function show(LowonganPekerjaan $loker_perusahaan)
    {
        $perusahaan = Perusahaan::all();
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

        return view('loker-perusahaan.show', ['loker_perusahaan' => $loker_perusahaan, 'perusahaan' => $perusahaan,'updatedAgo' => $updatedAgo]);
    }

    public function edit(LowonganPekerjaan $loker_perusahaan)
    {
        $user = auth()->user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker-perusahaan.edit', [
            'loker_perusahaan' => $loker_perusahaan,
            'user' => $user,
            'perusahaan' => $perusahaan,
        ]);
    }

    public function update(UpdateLokerPerusahaanRequest $request, LowonganPekerjaan $loker_perusahaan)
    {
        // Ambil perusahaan yang terkait dengan lowongan pekerjaan
        $perusahaan = Perusahaan::where('user_id', auth()->id())->first();
        // Pastikan perusahaan_id tidak berubah
        $request->merge(['perusahaan_id' => $perusahaan->id]);
        $loker_perusahaan->update($request->all());

        return redirect()->route('loker-perusahaan.index')
            ->with('success', 'success-edit');
    }

    public function destroy($id)
    {
        //
    }
}
