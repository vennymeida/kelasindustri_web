<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lamar;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $dashboards = DB::table('lamars as l')
            ->leftJoin('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->leftJoin('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->leftJoin('lulusans as pu', 'l.user_id', '=', 'pu.id')
            ->leftJoin('users as u', 'pu.user_id', '=', 'u.id')
            ->select(
                'l.id',
                'u.name',
                'pu.no_hp',
                'pu.foto',
                'pu.resume',
                'u.email',
                'lp.nama_loker',
                'p.nama_pemilik as perusahaan',
                'p.nama_perusahaan',
                'l.status',
                'l.created_at'
            )
            ->orderBy('l.created_at', 'desc')
            ->take(5)
            ->get();


        $grafik = DB::table('lamars as l')
            ->leftJoin('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->leftJoin('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->select(
                DB::raw('COUNT(*) as jumlah_lamars'),
                DB::raw('MONTH(l.created_at) as month'),
                DB::raw('COUNT(*) as count'),
                'p.nama_pemilik'
            )
            ->groupBy(DB::raw('MONTH(l.created_at)'), 'p.nama_pemilik')
            ->take(5)
            ->get();

        $grafikline = DB::table('lamars as l')
            ->leftJoin('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->leftJoin('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->select(
                DB::raw('COUNT(*) as jumlah_lamars'),
                DB::raw('MONTH(l.updated_at) as month'),
                'l.status'
            )
            ->whereYear('l.updated_at', $year) // Filter berdasarkan tahun
            ->groupBy(DB::raw('MONTH(l.updated_at)'), 'l.status')
            ->get();

        // dd($dashboards);

        // dd( $year);
        return view('home', [
            'dashboards' => $dashboards,
            'grafik' => $grafik,
            'grafikline' => $grafikline,
            'selectedYear' => $year
        ]);
    }
}
