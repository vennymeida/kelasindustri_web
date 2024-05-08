<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Postingan;
use App\Models\Pendidikan;
use App\Models\Pengalaman;
use App\Models\Pelatihan;
use App\Models\LowonganPekerjaan;
use Illuminate\Support\Facades\DB;

class NavigationController extends Controller
{
    public function search(Request $request)
    {
        $searchs = DB::table('lulusans as lp')
            ->leftJoin('users as us', 'lp.user_id', '=', 'us.id')
            ->leftJoin('pendidikans as pe', 'us.id', '=', 'pe.user_id')
            ->select(
                'us.id',
                'us.name',
                'lp.foto',
                'lp.alamat',
                'pe.nama_institusi')
             ->when($request->input('nama'), function ($query, $nama) {
                return $query->where('us.name', 'like', '%' . $nama . '%');
            })
            ->paginate(10);
            return view('search-result', compact('searchs'));
    }

    public function recruit(User $user)
    {
        $idPerusahaan = auth()->user();
        $perusahaan = Perusahaan::where('user_id', $idPerusahaan->id)->first();
        $lowonganPekerjaans = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
        ->where('status', 'dibuka')
        ->get();
        // dd($lowonganPekerjaans);
        $lulusan = DB::table('users')
            ->leftJoin('lulusans', 'users.id', '=', 'lulusans.user_id')
            ->leftJoin('pendidikans', 'users.id', '=', 'pendidikans.user_id')
            ->leftJoin('pengalamans', 'users.id', '=', 'pengalamans.user_id')
            ->leftJoin('pelatihans', 'users.id', '=', 'pelatihans.user_id')
            ->leftJoin('postingans', 'users.id', '=', 'postingans.user_id')
            ->select(
                'lulusans.id',
                'users.name',
                'users.id as usernomer',
                'users.email',
                'lulusans.foto',
                'lulusans.alamat',
                'lulusans.tgl_lahir',
                'lulusans.jenis_kelamin',
                'lulusans.no_hp',
                'lulusans.status',
                'lulusans.resume',
                'lulusans.ringkasan',
                'postingans.media',
                'postingans.konteks',
                'pendidikans.tingkatan',
                'pendidikans.jurusan',
                'pendidikans.nama_institusi',
                'pendidikans.tahun_mulai',
                'pendidikans.tahun_selesai',
                'pengalamans.nama_pengalaman',
                'pengalamans.nama_instansi',
                // 'pengalamans.alamat',
                'pengalamans.tipe',
                'pengalamans.tgl_mulai',
                'pengalamans.tgl_selesai',
                'pelatihans.nama_sertifikat',
                'pelatihans.deskripsi',
                'pelatihans.tgl_dikeluarkan',
                'pelatihans.sertifikat',
                'pelatihans.penerbit',
            )
            ->where('users.id', '=', $user->id)
            ->first();

        // Mengambil semua postingan pengguna dengan ID yang sesuai
        $userPosts = Postingan::where('user_id', $user->id)->paginate(3);

        // Mengambil data pendidikan pengguna
        $pendidikan = Pendidikan::where('user_id', $user->id)->paginate(3);

        // Mengambil data pengalaman pengguna
        $pengalaman = Pengalaman::where('user_id', $user->id)->paginate(3);

        // Mengambil data pelatihan pengguna
        $pelatihan = Pelatihan::where('user_id', $user->id)->paginate(3);

        return view('detail-search-result', compact('lulusan', 'userPosts', 'pendidikan', 'pengalaman', 'pelatihan', 'lowonganPekerjaans'));
    }
}
