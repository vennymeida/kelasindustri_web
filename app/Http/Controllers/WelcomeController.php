<?php

namespace App\Http\Controllers;

use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $currentDate = Carbon::now();
        $allResults = DB::table('lokers as lp')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->select(
                'lp.id',
                'lp.perusahaan_id',
                'lp.nama_loker',
                'lp.deskripsi',
                'lp.persyaratan',
                'lp.gaji_bawah',
                'lp.gaji_atas',
                'lp.lokasi',
                'lp.tgl_tutup',
                'p.nama_perusahaan',
                'p.alamat_perusahaan',
                'p.logo_perusahaan',
            )
            ->where('lp.status', 'dibuka')
            ->where('lp.tgl_tutup', '>=', $currentDate)
            ->orderBy('lp.created_at', 'desc')
            ->paginate(4);

        return view('welcome', ['allResults' => $allResults]);
    }
}
