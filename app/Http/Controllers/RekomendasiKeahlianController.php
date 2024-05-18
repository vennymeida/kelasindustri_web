<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiKeahlianController extends Controller
{
    public function index()
    {
        $rekomendasiKeahlians = DB::table('rekomendasis_keahlian')
        ->paginate(10);

        // Kirim data ke view untuk ditampilkan
        return view('perhitungan.rekomendasi-keahlian', compact('rekomendasiKeahlians'));
    }
}
