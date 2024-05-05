<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Lamar;
use Illuminate\Database\Eloquent\Builder;

class StatusLamarController extends Controller
{
    // Pastikan pengguna sudah masuk sebelum mengakses metode di controller ini
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:status-lamaran.index')->only('index');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        // Cek apakah user memiliki profil lulusan
        if (!$user->lulusan) {
            return redirect()->route('profile-lulusan.edit')->with('error', 'Silahkan lengkapi profil Anda terlebih dahulu.');
        }

        $query = Lamar::with('loker.perusahaan')
            ->where('user_id', $user->lulusan->id);

        // Filter by posisi
        if ($request->has('posisi') && $request->posisi != '') {
            $query->whereHas('loker', function (Builder $q) use ($request) {
                $q->where('nama_loker', 'like', '%' . $request->posisi . '%');
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by kota
        if ($request->has('kota') && $request->kota != '') {
            $query->whereHas('loker.perusahaan.kota', function (Builder $q) use ($request) {
                $q->where('kota_id', $request->kota); // Referensi yang benar
            });
        }


        $lokasikota = DB::table('kotas')->select('id', 'kota')->get();

        // Fetch all kota for the select box
        $lamaran = $query->orderByDesc('created_at')->paginate(3);

        if ($lamaran->isEmpty()) {
            return view('melamar.status', ['lamaran' => $lamaran, 'lokasikota' => $lokasikota, 'message' => 'Belum ada loker tersedia.']);
        }

        return view('melamar.status', ['lamaran' => $lamaran, 'lokasikota' => $lokasikota]);
    }
}
