<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiRangkingController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel perangkingan
        $perangkingans = DB::table('rekomendasilowongans as rl')
            ->leftJoin('lulusans as ls', 'rl.lulusan_id', '=', 'ls.id')
            ->leftJoin('lokers as lk', 'rl.loker_id', '=', 'lk.id')
            ->leftJoin('keahlians as kh', 'rl.keahlian_id', '=', 'kh.id')
            ->select(
                'rl.score_similarity_lulusan',
                'rl.score_similarity_keahlian',
                'rl.lulusan_id',
                'rl.keahlian_id',
                'rl.loker_id',
                'ls.ringkasan',
                'kh.keahlian',
                'lk.persyaratan',
                'lk.deskripsi',
                'lk.keahlian as syaratkeahlian',
            )
            ->paginate(10);

        // Kirim data ke view untuk ditampilkan
        return view('perhitungan.perangkingan', compact('perangkingans'));
    }
}
