<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DetailPerusahaan extends Controller
{
    public function index(Request $request)
    {
        $allResults = DB::table('lokers as lp')
            ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
            ->select(
                'p.id',
                'lp.perusahaan_id',
                'lp.nama_loker',
                'lp.deskripsi',
                'lp.persyaratan',
                'lp.gaji_bawah',
                'lp.gaji_atas',
                'lp.tipe_pekerjaan',
                'lp.kuota',
                'lp.status',
                'lp.lokasi',
                'lp.tgl_tutup',
                'lp.keahlian',
                'p.nama_pemilik',
                'p.nama_perusahaan',
                'p.logo_perusahaan',
            )
            ->where('lp.status', 'dibuka')
            ->orderBy('lp.created_at', 'desc')
            ->groupBy('p.id','lp.perusahaan_id', 'p.nama_perusahaan', 'p.nama_pemilik', 'lp.nama_loker', 'lp.deskripsi', 'lp.persyaratan', 'lp.gaji_bawah', 'gaji_atas', 'lp.tipe_pekerjaan', 'lp.kuota', 'lp.status', 'lp.keahlian', 'lp.tgl_tutup', 'lp.lokasi','p.nama_pemilik', 'p.logo_perusahaan')
            ->paginate(10);

        return view('detailPerusahaan', ['allResults' => $allResults]);
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

    public function show(Perusahaan $detail)
    {
        $lowonganPekerjaan = DB::table('lokers as lp')
            ->select('lp.perusahaan_id', 'lp.nama_loker', 'lp.deskripsi','lp.gaji_atas', 'lp.gaji_bawah', 'lp.lokasi','lp.tipe_pekerjaan','lp.keahlian', 'lp.status', 'lp.updated_at',)
            ->where('lp.perusahaan_id', $detail->id)
            ->where('lp.status', 'dibuka')
            ->groupBy('lp.id', 'lp.nama_loker', 'lp.deskripsi','lp.gaji_atas', 'lp.gaji_bawah', 'lp.lokasi','lp.tipe_pekerjaan','lp.keahlian', 'lp.status', 'lp.updated_at')
            ->paginate(4);

        $lokers = DB::table('lokers as lp')
            ->select('lp.perusahaan_id', 'lp.nama_loker', 'lp.deskripsi','lp.gaji_atas', 'lp.gaji_bawah', 'lp.lokasi','lp.tipe_pekerjaan', 'lp.status', 'lp.keahlian', 'lp.updated_at',)
            ->where('lp.perusahaan_id', $detail->id)
            ->where('lp.status', 'dibuka')
            ->groupBy('lp.perusahaan_id', 'lp.nama_loker', 'lp.deskripsi','lp.gaji_atas', 'lp.gaji_bawah', 'lp.lokasi','lp.tipe_pekerjaan', 'lp.status','lp.keahlian', 'lp.updated_at')
            ->paginate(6);



        foreach ($lowonganPekerjaan as $time) {
            $time->timeAgo = $this->getTimeAgo($time->updated_at);
        }

        return view('detailPerusahaan', [
            'detail' => $detail,
            'lowonganPekerjaan' => $lowonganPekerjaan,
            'lokers' => $lokers,

        ]);
    }
}
