<?php

namespace App\Http\Controllers;

use App\Models\Keahlian;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Postingan;
use App\Models\Pendidikan;
use App\Models\Pengalaman;
use App\Models\Pelatihan;
use App\Models\LowonganPekerjaan;
use App\Models\Portofolio;
use Illuminate\Support\Facades\DB;

class NavigationController extends Controller
{
    public function search(Request $request)
    {
        $searchs = DB::table('lulusans as lp')
            ->leftJoin('users as us', 'lp.user_id', '=', 'us.id')
            ->leftJoin('pendidikans as pe', function ($join) {
                $join->on('us.id', '=', 'pe.user_id')
                    ->whereRaw('pe.id = (SELECT MAX(id) FROM pendidikans WHERE user_id = us.id)');
            })
            ->leftJoin('keahlians as ke', 'us.id', '=', 'ke.user_id')
            ->select(
                'us.id',
                'us.name',
                'lp.foto',
                'lp.alamat',
                'pe.nama_institusi',
                DB::raw("GROUP_CONCAT(ke.keahlian SEPARATOR ', ') as keahlians")
            )
            ->when($request->input('nama'), function ($query, $nama) {
                return $query->where('us.name', 'like', '%' . $nama . '%')
                    ->orWhere('ke.keahlian', 'like', '%' . $nama . '%');
            })
            ->groupBy('us.id', 'us.name', 'lp.foto', 'lp.alamat', 'pe.nama_institusi')
            ->paginate(10);

        return view('search-result', compact('searchs'));
    }

    public function recruit(User $user)
    {
        $currentUser = auth()->user();
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melanjutkan.');
        }


        if ($currentUser->hasRole('perusahaan')) {

            $perusahaan = Perusahaan::where('user_id', $currentUser->id)->first();
            if (!$perusahaan) {
                return redirect()->back()->with('error', 'Perusahaan tidak ditemukan.');
            }
            $lokers = DB::table('lokers')
                ->join('perusahaan', 'lokers.perusahaan_id', '=', 'perusahaan.id')
                ->join('users', 'perusahaan.user_id', '=', 'users.id')
                ->select('lokers.*', 'perusahaan.nama_perusahaan', 'users.name')
                ->where('lokers.perusahaan_id', $perusahaan->id)
                ->where('lokers.status', 'dibuka')
                ->get();
            // $keahlians = Keahlian::all();
            $lulusan = DB::table('users')
                ->leftJoin('lulusans', 'users.id', '=', 'lulusans.user_id')
                ->leftJoin('pendidikans', 'users.id', '=', 'pendidikans.user_id')
                ->leftJoin('pengalamans', 'users.id', '=', 'pengalamans.user_id')
                ->leftJoin('pelatihans', 'users.id', '=', 'pelatihans.user_id')
                ->leftJoin('postingans', 'users.id', '=', 'postingans.user_id')
                ->leftJoin('portofolios', 'users.id', '=', 'portofolios.user_id')
                ->leftJoin('keahlians', 'users.id', '=', 'keahlians.user_id')
                ->select([
                    'lulusans.id', 'users.name', 'users.email', 'lulusans.foto', 'users.id as usernomer',
                    'lulusans.alamat', 'lulusans.tgl_lahir', 'lulusans.jenis_kelamin', 'lulusans.no_hp',
                    'lulusans.status', 'lulusans.resume', 'lulusans.ringkasan', 'postingans.media',
                    'postingans.konteks', 'pendidikans.tingkatan', 'pendidikans.jurusan', 'pendidikans.nama_institusi',
                    'pendidikans.tahun_mulai', 'pendidikans.tahun_selesai', 'pengalamans.nama_pengalaman',
                    'pengalamans.nama_instansi', 'pengalamans.tipe', 'pengalamans.tgl_mulai', 'pengalamans.tgl_selesai',
                    'pelatihans.nama_sertifikat', 'pelatihans.deskripsi', 'pelatihans.tgl_dikeluarkan', 'pelatihans.sertifikat',
                    'pelatihans.penerbit', 'portofolios.link_portofolio', 'portofolios.nama_portofolio', 'portofolios.dokumen_portofolio',
                    'portofolios.deskripsi_portofolio', 'keahlians.keahlian'
                ])
                ->where('users.id', '=', $user->id)
                ->first();
        } elseif ($currentUser->hasRole('lulusan')) {
            // $keahlians = Keahlian::all();
            $lulusan = DB::table('users')
                ->leftJoin('lulusans', 'users.id', '=', 'lulusans.user_id')
                ->leftJoin('pendidikans', 'users.id', '=', 'pendidikans.user_id')
                ->leftJoin('pengalamans', 'users.id', '=', 'pengalamans.user_id')
                ->leftJoin('pelatihans', 'users.id', '=', 'pelatihans.user_id')
                ->leftJoin('postingans', 'users.id', '=', 'postingans.user_id')
                ->leftJoin('portofolios', 'users.id', '=', 'portofolios.user_id')
                ->leftJoin('keahlians', 'users.id', '=', 'keahlians.user_id')
                ->select([
                    'lulusans.id', 'users.name', 'users.email', 'lulusans.foto', 'users.id as usernomer',
                    'lulusans.alamat', 'lulusans.tgl_lahir', 'lulusans.jenis_kelamin', 'lulusans.no_hp',
                    'lulusans.status', 'lulusans.resume', 'lulusans.ringkasan', 'postingans.media',
                    'postingans.konteks', 'pendidikans.tingkatan', 'pendidikans.jurusan', 'pendidikans.nama_institusi',
                    'pendidikans.tahun_mulai', 'pendidikans.tahun_selesai', 'pengalamans.nama_pengalaman',
                    'pengalamans.nama_instansi', 'pengalamans.tipe', 'pengalamans.tgl_mulai', 'pengalamans.tgl_selesai',
                    'pelatihans.nama_sertifikat', 'pelatihans.deskripsi', 'pelatihans.tgl_dikeluarkan', 'pelatihans.sertifikat',
                    'pelatihans.penerbit', 'portofolios.link_portofolio', 'portofolios.nama_portofolio', 'portofolios.dokumen_portofolio',
                    'portofolios.deskripsi_portofolio', 'keahlians.keahlian'
                ])
                ->where('users.id', '=', $user->id)
                ->first();
            $lokers = DB::table('lokers')
                ->get();
        } else {

            return redirect()->back()->with('error', 'Role tidak diizinkan.');
        }
        $userPosts = Postingan::where('user_id', $user->id)->paginate(3);
        $pendidikan = Pendidikan::where('user_id', $user->id)->paginate(3);
        $pengalaman = Pengalaman::where('user_id', $user->id)->paginate(3);
        $pelatihan = Pelatihan::where('user_id', $user->id)->paginate(3);
        $portofolios = Portofolio::where('user_id', $user->id)->paginate(3);
        $keahlians = Keahlian::where('user_id', $user->id)->paginate(100);

        return view('detail-search-result', compact('lulusan', 'userPosts', 'pendidikan', 'pengalaman', 'pelatihan', 'lokers', 'portofolios', 'keahlians'));
    }
}
