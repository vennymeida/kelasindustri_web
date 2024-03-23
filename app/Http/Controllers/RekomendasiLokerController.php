<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiLokerController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel rekomendasis_loker
        $rekomendasiLokers = DB::table('rekomendasis_loker')
        ->paginate(10);

        // Kirim data ke view untuk ditampilkan
        return view('perhitungan.rekomendasi-loker', compact('rekomendasiLokers'));
    }
}
