<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiRangkingController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel perangkingan
        $perangkingans = DB::table('rekomendasilowongans')
        ->paginate(10);

        // Kirim data ke view untuk ditampilkan
        return view('perhitungan.perangkingan', compact('perangkingans'));
    }
}
