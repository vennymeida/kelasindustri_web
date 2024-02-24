<?php

namespace App\Http\Controllers;

use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\KategoriPekerjaan;
use App\Models\ProfileUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // $allResults = DB::table('lokers as lp')
        //     ->join('perusahaans as p', 'lp.id_perusahaan', '=', 'p.id')
        //     // ->join('kecamatans as k', 'p.kecamatan_id', '=', 'k.id')
        //     // ->join('kelurahans as kl', 'p.kelurahan_id', '=', 'kl.id')
        //     // ->join('lowongan_kategori as lk', 'lp.id', '=', 'lk.lowongan_id')
        //     // ->join('kategori_pekerjaans as kp', 'lk.kategori_id', '=', 'kp.id')
        //     ->join('profile_users as pu', 'lp.user_id', '=', 'pu.id')
        //     ->join('users as u', 'pu.user_id', '=', 'u.id')
        //     ->select(
        //         'lp.id',
        //         'lp.user_id',
        //         'lp.id_perusahaan',
        //         'lp.judul',
        //         'lp.deskripsi',
        //         'lp.requirement',
        //         'lp.gaji_bawah',
        //         'lp.gaji_atas',
        //         'lp.tipe_pekerjaan',
        //         'lp.jumlah_pelamar',
        //         'lp.min_pengalaman',
        //         'lp.min_pendidikan',
        //         'lp.status',
        //         'lp.lokasi',
        //         'lp.tutup',
        //         'p.nama',
        //         'p.pemilik',
        //         'p.logo',
        //         'p.alamat_perusahaan',
        //         // 'k.kecamatan',
        //         // 'kl.kelurahan',
        //         DB::raw("GROUP_CONCAT(kp.kategori SEPARATOR ', ') as kategori"),
        //     )
        //     ->where('lp.status', 'dibuka')
        //     ->orderBy('lp.created_at', 'desc')
        //     ->groupBy('lp.id', 'lp.user_id', 'lp.id_perusahaan', 'p.nama', 'lp.judul', 'lp.deskripsi', 'lp.requirement', 'lp.gaji_bawah', 'gaji_atas', 'lp.tipe_pekerjaan', 'lp.jumlah_pelamar', 'lp.status', 'lp.tutup', 'lp.lokasi', 'lp.min_pengalaman', 'lp.min_pendidikan', 'p.pemilik', 'p.logo', 'p.alamat_perusahaan')
        //     ->paginate(5);

        // $user = auth()->id();
        // $keahlianUser = DB::table('profile_keahlians')->where('user_id', $user)->pluck('keahlian_id')->toArray();

        // $allRekomendasi = DB::table('lowongan_pekerjaans as lp')
        //     ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
        //     ->join('kecamatans as k', 'p.kecamatan_id', '=', 'k.id')
        //     ->join('kelurahans as kl', 'p.kelurahan_id', '=', 'kl.id')
        //     ->join('lowongan_kategori as lk', 'lp.id', '=', 'lk.lowongan_id')
        //     ->join('kategori_pekerjaans as kp', 'lk.kategori_id', '=', 'kp.id')
        //     ->join('lowongan_keahlian as lh', 'lp.id', '=', 'lh.lowongan_id')
        //     ->join('keahlians as kh', 'lh.keahlian_id', '=', 'kh.id')
        //     ->join('profile_users as pu', 'lp.user_id', '=', 'pu.id')
        //     ->join('users as u', 'pu.user_id', '=', 'u.id')
        //     ->select(
        //         'lp.id',
        //         'lp.id_perusahaan',
        //         'lp.judul',
        //         'lp.deskripsi',
        //         'lp.requirement',
        //         'lp.gaji_bawah',
        //         'lp.gaji_atas',
        //         'lp.min_pengalaman',
        //         'lp.min_pendidikan',
        //         'lp.lokasi',
        //         'p.nama',
        //         'p.alamat_perusahaan',
        //         'p.logo',
        //         'k.kecamatan',
        //         'kl.kelurahan',
        //         DB::raw("GROUP_CONCAT(DISTINCT kp.kategori SEPARATOR ', ') as kategori"),
        //     )
        //     ->whereIn('lh.keahlian_id', $keahlianUser)
        //     ->where('lp.status', 'dibuka')
        //     ->groupBy(
        //         'lp.id',
        //         'lp.id_perusahaan',
        //         'lp.judul',
        //         'lp.deskripsi',
        //         'lp.requirement',
        //         'lp.gaji_bawah',
        //         'lp.gaji_atas',
        //         'lp.min_pengalaman',
        //         'lp.min_pendidikan',
        //         'lp.lokasi',
        //         'k.kecamatan',
        //         'kl.kelurahan',
        //         'p.nama',
        //         'p.alamat_perusahaan',
        //         'p.logo',
        //         'k.kecamatan',
        //         'kl.kelurahan',
        //     )
        //     ->orderByRaw('COUNT(lh.keahlian_id) DESC')
        //     ->paginate(4);

        // return view('welcome', ['allResults' => $allResults, 'allRekomendasi' => $allRekomendasi]);
        return view('welcome');
    }
}
