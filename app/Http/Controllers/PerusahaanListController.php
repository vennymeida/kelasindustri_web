<?php

namespace App\Http\Controllers;

use App\Models\Lamar;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Perusahaan;
use App\Models\LowonganPekerjaan;
use App\Models\RekomendasiLowongan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PerusahaanListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:perusahaan.index')->only('index');
        $this->middleware('permission:perusahaan.create')->only('create', 'store');
        $this->middleware('permission:perusahaan.edit')->only('edit', 'update');
        $this->middleware('permission:perusahaan.destroy')->only('destroy');
        $this->middleware('permission:perusahaan.import')->only('import');
        $this->middleware('permission:perusahaan.export')->only('export');
    }

    public function index(Request $request)
    {
        // Mengambil role "Perusahaan"
        $rolePerusahaan = Role::where('name', 'perusahaan')->first();

        // Mengambil data perusahaan dengan role "Perusahaan" dan relasi "profile"
        $query = Perusahaan::query();

        // Lakukan pencarian berdasarkan nama perusahaan jika parameter "name" ada
        if ($request->has('name')) {
            $name = $request->input('name');
            $query->where('name', 'like', "%$name%");
        }

        $query->where('status', 'unbanned');

        // Paginasi hasil query
        $perusahaanData = $query->paginate(10);

        return view('perusahaan.index', compact('perusahaanData'));
    }


    public function edit(User $perusahaan)
    {
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function banned(Perusahaan $perusahaan)
    {
        $perusahaan->update([
            'status' => 'banned',
        ]);

        $idLowongan = DB::table('lokers')
            ->select(
                'lokers.id'
            )
            ->where('lokers.perusahaan_id', $perusahaan->id)
            ->get();

        if ($perusahaan->id != null) {
            foreach ($idLowongan as $lowongan) {
                RekomendasiLowongan::where('loker_id', $lowongan->id)->delete();
            }
            foreach ($idLowongan as $lowongan) {
                Lamar::where('loker_id', $lowongan->id)->delete();
            }
            LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->delete();
        }

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil di banned');
    }


    public function update(Request $request, User $perusahaan)
    {
        $this->validate($request, [
            // Add validation rules for profile data if needed
        ]);

        // Update the user profile data
        $perusahaan->update([
            'alamat' => $request->input('alamat'),
            // Add other profile fields for perusahaan
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Profile updated successfully.');
    }

    public function destroy(User $perusahaan)
    {
        try {
            // Delete the user and related profile data
            $perusahaan->delete();
            $perusahaan->delete();

            return redirect()->route('perusahaan.index')->with('success', 'Profile deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle delete error here

            return redirect()->route('perusahaan.index')->with('error', 'Failed to delete profile.');
        }
    }

    public function show(Perusahaan $perusahaan)
    {
        $lowonganPekerjaan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->pluck('id');

        // Menghilangkan tag <p> dan tag lainnya dari deskripsi
        if ($perusahaan && $perusahaan->deskripsi) {
            $perusahaan->deskripsi = Str::replace(
                ['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'],
                ['', '', '', ", ", '', '', "\n"],
                $perusahaan->deskripsi
            );
            $perusahaan->deskripsi = rtrim($perusahaan->deskripsi, ', ');
        }
        $jumlahPelamar = DB::table('lamars as l')
            ->leftJoin('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->leftJoin('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->leftJoin('lulusans as lu', 'l.user_id', '=', 'lu.id')
            ->leftJoin('users as u', 'lu.user_id', '=', 'u.id')
            ->whereIn('l.loker_id', $lowonganPekerjaan)
            ->count();

        $jumlahDiterima = DB::table('lamars as l')
            ->leftJoin('lokers as lp', 'l.loker_id', '=', 'lp.id')
            ->leftJoin('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->leftJoin('lulusans as lu', 'l.user_id', '=', 'lu.id')
            ->leftJoin('users as u', 'lu.user_id', '=', 'u.id')
            ->whereIn('l.loker_id', $lowonganPekerjaan)
            ->where('l.status', 'diterima')
            ->count();

        $jumlahLowongan = DB::table('lokers')
            ->leftJoin('perusahaan', 'lokers.perusahaan_id', '=', 'perusahaan.id')
            ->count();

        return view('perusahaan.view', compact('perusahaan', 'jumlahPelamar', 'jumlahDiterima', 'jumlahLowongan'));
    }

    public function showLoker(Perusahaan $perusahaan, Request $request)
    {
        // Gunakan perusahaan_id untuk mengambil data
        LowonganPekerjaan::where('perusahaan_id', $perusahaan->id);

        $paginatedLowongan = DB::table('lokers')
            ->leftJoin('perusahaan', 'lokers.perusahaan_id', '=', 'perusahaan.id')
            ->select(
                'perusahaan.nama_perusahaan',
                'lokers.id',
                'lokers.tipe_pekerjaan',
                'lokers.gaji_atas',
                'lokers.gaji_bawah',
                'lokers.status',
            )
            ->paginate(10);

        return view('perusahaan.totalLoker', [
            'lowonganPekerjaan' => $paginatedLowongan,
            'perusahaan' => $perusahaan,
        ]);
    }

    public function showPelamar(Perusahaan $perusahaan)
    {
        // Mengambil lowongan pekerjaan yang terkait dengan perusahaan
        $lowonganPekerjaan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->pluck('id');

        // Mengambil pelamar berdasarkan lowongan yang terkait dengan perusahaan
        $totalPelamar = DB::table('lamars as l')
            ->join('lokers as lp', 'l.loker_id', '=', 'lp.id') // Menghubungkan dengan Lokers
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id') // Menghubungkan dengan Perusahaan
            ->join('lulusans as lu', 'l.user_id', '=', 'lu.id') // Menghubungkan dengan Lulusan
            ->join('users as u', 'lu.user_id', '=', 'u.id') // Menghubungkan dengan Users
            ->select(
                'l.id',
                'u.name',
                'lu.no_hp',
                'lu.foto',
                'lu.resume',
                'u.email',
                'p.nama_perusahaan',
                'lp.nama_loker',
                'l.status',
                'l.created_at'
            )
            ->whereIn('l.loker_id', $lowonganPekerjaan)
            ->paginate(10);

        return view('perusahaan.totalPelamar', [
            'totalPelamar' => $totalPelamar,
            'perusahaan' => $perusahaan,
        ]);
    }

    public function showPelamarDiterima(Perusahaan $perusahaan)
    {
        // Mengambil lowongan pekerjaan yang terkait dengan perusahaan
        $lowonganPekerjaan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->pluck('id');

        // Mengambil pelamar berdasarkan lowongan yang terkait dengan perusahaan
        $totalDiterima = DB::table('lamars as l')
            ->join('lokers as lp', 'l.loker_id', '=', 'lp.id') // Menghubungkan dengan Lokers
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id') // Menghubungkan dengan Perusahaan
            ->join('lulusans as lu', 'l.user_id', '=', 'lu.id') // Menghubungkan dengan Lulusan
            ->join('users as u', 'lu.user_id', '=', 'u.id') // Menghubungkan dengan Users
            ->select(
                'l.id',
                'u.name',
                'lu.no_hp',
                'lu.foto',
                'lu.resume',
                'u.email',
                'p.nama_perusahaan',
                'lp.nama_loker',
                'l.status',
                'l.created_at'
            )
            ->whereIn('l.loker_id', $lowonganPekerjaan)
            ->where('l.status', 'diterima') // Filter berdasarkan loker yang sesuai dengan perusahaan
            ->paginate(10); // Pagination untuk mengelola data besar

        return view('perusahaan.totalPelamarDiterima', [
            'totalDiterima' => $totalDiterima,
            'perusahaan' => $perusahaan,
        ]);
    }
}
