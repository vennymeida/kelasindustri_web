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

        $dashboard = DB::table('lamars as l')
            ->join('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->join('lulusans as pu', 'l.user_id', '=', 'pu.id')
            ->join('users as u', 'pu.user_id', '=', 'u.id')
            ->select(
                'l.id',
                'l.user_id',
                'u.name',
                'pu.no_hp',
                'pu.foto',
                'pu.resume',
                'u.email',
                'p.nama_perusahaan',
                'lp.nama_loker',
                'l.status',
                'l.created_at'
            )
            ->orderBy('l.created_at', 'desc')
            ->take(5)
            ->get();


        $grafik = DB::table('lamars as l')
            ->join('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->select(
                DB::raw('COUNT(*) as jumlah_lamars'),
                DB::raw('MONTH(l.created_at) as month'),
                DB::raw('COUNT(*) as count'),
                'p.nama_perusahaan'
            )
            ->groupBy(DB::raw('MONTH(l.created_at)'), 'p.nama_perusahaan')
            ->take(5)
            ->get();

        $grafikline = DB::table('lamars as l')
            ->leftJoin('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->leftJoin('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->select(
                DB::raw('COUNT(*) as jumlah_lamars'),
                DB::raw('MONTH(l.created_at) as month'),
                'l.status'
            )
            ->whereYear('l.created_at', $year)
            ->groupBy(DB::raw('MONTH(l.created_at)'), 'l.status')
            ->get();

        return view('home', [
            'dashboard' => $dashboard,
            'grafik' => $grafik,
            'grafikline' => $grafikline,
        ]);
    }
}
