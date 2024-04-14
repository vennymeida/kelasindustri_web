<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;
use Auth;
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

        // Cek apakah user memiliki profile
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

        // Filter by lokasi
        if ($request->has('lokasi') && $request->lokasi != '') {
            $query->whereHas('loker.perusahaan.kota', function (Builder $q) use ($request) {
                $q->where('kota', 'like', '%' . $request->lokasi . '%');
            });
        }

        // Fetch all kota for the select box


        $lamaran = $query->orderByDesc('created_at')->paginate(3);

        if ($lamaran->isEmpty()) {
            return view('melamar.status', ['lamaran' => $lamaran, 'message' => 'Belum ada loker tersedia.']);
        }

        return view('melamar.status', ['lamaran' => $lamaran]);
    }
}
