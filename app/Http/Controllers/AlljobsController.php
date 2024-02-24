<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\lamar;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlljobsController extends Controller
{
    public function index(Request $request)
    {
        $posisiKerja = $request->input('posisi');
        $lokasi = $request->input('lokasi');
        $kategori = $request->input('kategori', []);
        $gaji = $request->input('gaji', []);


        $kategoris = KategoriPekerjaan::all();

        $allResults = DB::table('lowongan_pekerjaans as lp')
            ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
            ->join('kecamatans as k', 'p.kecamatan_id', '=', 'k.id')
            ->join('kelurahans as kl', 'p.kelurahan_id', '=', 'kl.id')
            ->join('lowongan_kategori as lk', 'lp.id', '=', 'lk.lowongan_id')
            ->join('kategori_pekerjaans as kp', 'lk.kategori_id', '=', 'kp.id')
            ->join('profile_users as pu', 'lp.user_id', '=', 'pu.id')
            ->join('users as u', 'pu.user_id', '=', 'u.id')
            ->select(
                'lp.id',
                'lp.user_id',
                'lp.id_perusahaan',
                'lp.judul',
                'lp.deskripsi',
                'lp.requirement',
                'lp.gaji_bawah',
                'lp.gaji_atas',
                'lp.tipe_pekerjaan',
                'lp.jumlah_pelamar',
                'lp.min_pengalaman',
                'lp.min_pendidikan',
                'lp.status',
                'lp.lokasi',
                'lp.tutup',
                'p.nama',
                'p.pemilik',
                'p.logo',
                'p.alamat_perusahaan',
                'k.kecamatan',
                'kl.kelurahan',
                DB::raw("GROUP_CONCAT(kp.kategori SEPARATOR ', ') as kategori"),
            )
            ->when($posisiKerja, function ($allResults, $posisi) {
                return $allResults->where('lp.judul', 'like', '%' . $posisi . '%');
            })
            ->when($lokasi, function ($allResults, $lokasi) {
                return $allResults->where('k.kecamatan', 'like', '%' . $lokasi . '%');
            })
            ->when(count($kategori) > 0, function ($allResults) use ($kategori) {
                return $allResults->whereIn('kp.kategori', $kategori);
            })
            ->when(is_array($gaji) && count($gaji) > 0, function ($allResults) use ($gaji) {
                return $allResults->where(function ($query) use ($gaji) {
                    foreach ($gaji as $selectedGaji) {
                        switch ($selectedGaji) {
                            case 'less-1jt':
                                $query->orWhereRaw('CAST(REPLACE(lp.gaji_bawah, ".", "") AS DECIMAL(10, 0)) < 1000000');
                                break;
                            case '1jt-5jt':
                                $query->orWhereRaw('CAST(REPLACE(lp.gaji_bawah, ".", "") AS DECIMAL(10, 0)) BETWEEN 1000000 AND 5000000');
                                break;
                            case '5jt-10jt':
                                $query->orWhereRaw('CAST(REPLACE(lp.gaji_bawah, ".", "") AS DECIMAL(10, 0)) BETWEEN 5000000 AND 10000000');
                                break;
                            case 'more-10jt':
                                $query->orWhereRaw('CAST(REPLACE(lp.gaji_bawah, ".", "") AS DECIMAL(10, 0)) > 10000000');
                                break;
                            default:
                                break;
                        }
                    }
                });
            })
            ->where('lp.status', 'dibuka')
            ->orderBy('lp.created_at', 'desc')
            ->groupBy('lp.id', 'lp.user_id', 'lp.id_perusahaan', 'p.nama', 'lp.judul', 'lp.deskripsi', 'lp.requirement', 'lp.gaji_bawah', 'gaji_atas', 'lp.tipe_pekerjaan', 'lp.jumlah_pelamar', 'lp.status', 'lp.tutup', 'lp.lokasi', 'lp.min_pengalaman', 'lp.min_pendidikan', 'p.pemilik', 'p.logo', 'p.alamat_perusahaan', 'k.kecamatan', 'kl.kelurahan')
            ->paginate(6);

        return view('all-jobs', ['allResults' => $allResults, 'lokasi' => $lokasi, 'kategoris' => $kategoris, 'kategori' => $kategori]);
    }


    public function show(LowonganPekerjaan $loker)
    {
        $perusahaan = Perusahaan::all();

        $kategori = $loker->kategori()->pluck('kategori')->implode(', ');
        $keahlian = $loker->keahlian()->pluck('keahlian');
        $getLamarPending = lamar::select(
            'lamars.id_loker',
            'lamars.status'
        )
            ->where('id_loker', $loker->id)
            ->where('status', 'Pending')
            ->count();
        $getLamarDiterima = lamar::select(
            'lamars.id_loker',
            'lamars.status'
        )
            ->where('id_loker', $loker->id)
            ->where('status', 'Diterima')
            ->count();
        // dd($getLamarDiterima);

        $updatedDiff = $loker->updated_at->diffInSeconds(now());

        if ($updatedDiff < 60) {
            $updatedAgo = $updatedDiff . ' detik yang lalu';
        } elseif ($updatedDiff < 3600) {
            $updatedAgo = floor($updatedDiff / 60) . ' menit yang lalu';
        } elseif ($updatedDiff < 86400) {
            $updatedAgo = floor($updatedDiff / 3600) . ' jam yang lalu';
        } else {
            $updatedAgo = $loker->updated_at->diffInDays(now()) . ' hari yang lalu';
        }

        $hasApplied = $loker->hasApplied;
        // Mengecek apakah user sudah melamar untuk loker ini
        $lamaran = null;

        if (Auth::check()) {
            // Check if user has a profile before attempting to access the profile's id.
            if (Auth::user()->profile) {
                $lamaran = Lamar::where('id_loker', $loker->id)
                    ->where('id_pencari_kerja', Auth::user()->profile->id)
                    ->first();
            }
            // If the user doesn't have a profile or isn't authenticated, $lamaran will remain null.
        }

        $lamaranStatus = $lamaran ? $lamaran->status : null;

        if (Auth::check()) {
            return view('showAllJobs', [
                'loker' => $loker,
                'perusahaan' => $perusahaan,
                'kategori' => $kategori,
                'keahlian' => $keahlian,
                'hasApplied' => $hasApplied,
                'lamaranStatus' => $lamaranStatus,
                'updatedAgo' => $updatedAgo,

                'getLamarPending' => $getLamarPending,
                'getLamarDiterima' => $getLamarDiterima,
            ]);
        } else {
            return view('auth.login');
        }
    }
}
