<?php

namespace App\Http\Controllers;

use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\User;
use App\Http\Requests\StoreLowonganPekerjaanRequest;
use App\Http\Requests\UpdateLowonganPekerjaanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LowonganPekerjaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:loker.index')->only('index');
        $this->middleware('permission:loker.create')->only('create', 'store');
        $this->middleware('permission:loker.edit')->only('edit', 'update');
        $this->middleware('permission:loker.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $statuses = ['pending', 'dibuka', 'ditutup'];
        $selectedStatus = $request->input('status');

        $allResults = DB::table('lokers as lp')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->select(
                'lp.id',
                'lp.perusahaan_id',
                'p.nama_perusahaan',
                'lp.nama_loker',
                'lp.deskripsi',
                'lp.persyaratan',
                'lp.gaji_bawah',
                'lp.gaji_atas',
                'lp.tipe_pekerjaan',
                'lp.keahlian',
                'lp.kuota',
                'lp.status',
                'lp.lokasi',
                'lp.tgl_tutup',
                'p.nama_pemilik'
            )
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                return $query->where('p.nama_perusahaan', 'like', '%' . $search . '%')
                    ->orWhere('lp.tipe_pekerjaan', 'like', '%' . $search . '%');
            })
            ->when($selectedStatus, function ($query, $selectedStatus) {
                return $query->where('lp.status', $selectedStatus);
            })
            ->groupBy('lp.id','lp.perusahaan_id', 'p.nama_perusahaan', 'lp.nama_loker', 'lp.deskripsi', 'lp.persyaratan', 'lp.gaji_bawah', 'gaji_atas', 'lp.tipe_pekerjaan', 'lp.kuota', 'lp.status', 'lp.tgl_tutup', 'lp.lokasi', 'p.nama_pemilik', 'lp.keahlian')
            ->paginate(10);

        foreach ($allResults as $persyaratan) {
            $persyaratan->persyaratan = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', "\n", '', '', "\n"], $persyaratan->persyaratan);
        }

        $loggedInUserId = Auth::id();
        $user = auth()->user();

        $perusahaan = Perusahaan::where('user_id', $user->id)->first();


        $loggedInUserResults = DB::table('lokers as lp')
            ->join('perusahaan as p', 'lp.perusahaan_id', '=', 'p.id')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->select(
                'lp.id',
                'lp.perusahaan_id',
                'p.nama_perusahaan',
                'lp.nama_loker',
                'lp.deskripsi',
                'lp.persyaratan',
                'lp.gaji_bawah',
                'lp.gaji_atas',
                'lp.tipe_pekerjaan',
                'lp.kuota',
                'lp.status',
                'lp.lokasi',
                'lp.tgl_tutup',
                'p.nama_pemilik',
            )
            ->where('u.id', $loggedInUserId)
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                return $query->where('lp.nama_loker', 'like', '%' . $search . '%')
                    ->orWhere('lp.deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('lp.persyaratan', 'like', '%' . $search . '%')
                    ->orWhere('lp.status', 'like', '%' . $search . '%');
            })
            ->groupBy('lp.id','lp.perusahaan_id', 'p.nama_perusahaan', 'lp.nama_loker', 'lp.deskripsi', 'lp.persyaratan', 'lp.gaji_bawah', 'gaji_atas', 'lp.tipe_pekerjaan', 'lp.kuota', 'lp.status', 'lp.tgl_tutup', 'lp.lokasi', 'p.nama_pemilik')
            ->paginate(10);

        foreach ($loggedInUserResults as $persyaratan) {
            $persyaratan->persyaratan = Str::replace(['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'], ['', '', '', ", ", '', '', "\n"], $persyaratan->persyaratan);
            $persyaratan->persyaratan = rtrim($persyaratan->persyaratan, ', ');
        }

        if (Auth::user()->hasRole('perusahaan')) {
            if ($user == null && $perusahaan == null) {
                return redirect()->route('profile-perusahaan.edit')->with('message', 'Lengkapi data profil dan data perusahaan terlebih dahulu untuk menambahkan lowongan kerja.');
            } elseif ($user == null) {
                return redirect()->route('profile-perusahaan.edit')->with('message', 'Lengkapi data profil terlebih dahulu untuk menambahkan lowongan kerja.');
            } elseif ($perusahaan == null) {
                return redirect()->route('profile-perusahaan.edit')->with('message', 'Lengkapi data perusahaan terlebih dahulu untuk menambahkan lowongan kerja.');
            } else {
                return view('loker.index', ['allResults' => $allResults, 'loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'perusahaan' => $perusahaan]);
            }
        } else {
            return view('loker.index', ['allResults' => $allResults, 'loggedInUserResults' => $loggedInUserResults, 'statuses' => $statuses, 'selectedStatus' => $selectedStatus, 'perusahaan' => $perusahaan]);
        }
    }


    public function create()
    {
        $user = auth()->user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker.create', [
            'user' => $user,
            'perusahaan' => $perusahaan,
        ]);
    }

    public function store(StoreLowonganPekerjaanRequest $request)
    {
        $lowongan = LowonganPekerjaan::create([
            'user_id' => $request->user_id,
            'perusahaan_id' => $request->perusahaan_id,
            'nama_loker' => $request->nama_loker,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'tipe_pekerjaan' => $request->tipe_pekerjaan,
            'gaji_bawah' => $request->gaji_bawah,
            'gaji_atas' => $request->gaji_atas,
            'kuota' => $request->kuota,
            'tgl_tutup' => $request->tgl_tutup,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
        ]);

        return redirect()->route('loker.index')
            ->with('success', 'Lowongan Pekerjaan berhasil ditambahkan');
    }

    public function show(LowonganPekerjaan $lowonganPekerjaan)
    {
    }

    public function edit(LowonganPekerjaan $loker)
    {
        $user = auth()->user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker.edit', [
            'loker' => $loker,
            'user' => $user,
            'perusahaan' => $perusahaan,
        ]);
    }

    public function update(UpdateLowonganPekerjaanRequest $request, LowonganPekerjaan $loker)
    {
        $loker->update($request->all());

        return redirect()->route('loker.index')
            ->with('success', 'Data lowongan pekerjaan berhasil diperbarui.');
    }


    public function destroy(LowonganPekerjaan $loker)
    {
        try {
            $loker->delete();
            return redirect()->route('loker.index')->with('success', 'Data Lowongan Berhasil Di Hapus');
        } catch (\Exception $e) {
            return redirect()->route('loker.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function allJobs()
    {
        return view('loker.all-jobs');
    }
}
