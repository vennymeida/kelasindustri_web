<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\lamar;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $dashboard = DB::table('lamars as l')
            ->leftJoin('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->leftJoin('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->leftJoin('lulusans as pu', 'l.user_id', '=', 'pu.id')
            ->leftJoin('users as u', 'pu.user_id', '=', 'u.id')
            ->select(
                'l.id',
                'l.id_pencari_kerja',
                'u.name',
                'pu.no_hp',
                'pu.foto',
                'pu.resume',
                'u.email',
                'p.nama as perusahaan',
                'lp.judul',
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
                'p.nama'
            )
            ->groupBy(DB::raw('MONTH(l.created_at)'), 'p.nama')
            ->take(5)
            ->get();


        return view('home')->with([
            'dashboard' => $dashboard,
            'grafik' => $grafik
        ]);
        return view('home');
    }
}
