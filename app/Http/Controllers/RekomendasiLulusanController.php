<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiLulusanController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel rekomendasis_lulusan
        $rekomendasiLulusans = DB::table('rekomendasis_lulusan')
        ->paginate(10);

        // Kirim data ke view untuk ditampilkan
        return view('perhitungan.rekomendasi-lulusan', compact('rekomendasiLulusans'));
    }
}
