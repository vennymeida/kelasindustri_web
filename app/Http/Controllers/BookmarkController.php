<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Kota;
use App\Models\LowonganPekerjaan;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:bookmark.index')->only('index');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        // $query = $user->bookmark()->with(['lowonganPekerjaan.perusahaan', 'lowonganPekerjaan.perusahaan.kota']);
        $querys = DB::table('bookmarks as bk')
            ->leftJoin('lokers as lk', 'bk.loker_id', '=', 'lk.id')
            ->leftJoin('users as usr', 'bk.user_id', '=', 'usr.id')
            ->leftJoin('perusahaan as ps', 'lk.perusahaan_id', '=', 'ps.id')
            ->select(
                'usr.id',
                'lk.id as loker_id',
                'lk.nama_loker',
                'lk.persyaratan',
                'lk.deskripsi',
                'lk.gaji_atas',
                'lk.gaji_bawah',
                'lk.keahlian',
                'lk.tipe_pekerjaan',
                'lk.tgl_tutup',
                'lk.lokasi',
                'lk.status',
                'ps.nama_pemilik',
                'ps.nama_perusahaan',
                'ps.logo_perusahaan',
                'ps.email_perusahaan',
                'ps.alamat_perusahaan',
                'ps.deskripsi',
            )
            ->where('bk.user_id', '=', $user->id)
            ->orderByDesc('bk.created_at')
            ->paginate(4);

        // dd($querys);

        return view('bookmark.index', [
            'querys' => $querys,

        ]);
    }

    public function toggleBookmark(Request $request)
    {
        $lokerId = $request->input('loker_id');
        $user = Auth::user();

        $bookmarked = false;

        // Check if the user has already bookmarked the job
        if ($user->bookmarks()->where('loker_id', $lokerId)->exists()) {
            // Remove the bookmark
            $user->bookmarks()->where('loker_id', $lokerId)->delete();
        } else {
            // Add the bookmark
            $user->bookmarks()->create(['loker_id' => $lokerId]);
            $bookmarked = true;
        }

        return response()->json(['bookmarked' => $bookmarked]);
    }

    public function addBookmark(Request $request)
    {
        $userId = auth()->id();
        $lokerId = $request->loker_id;
        $bookmark = Bookmark::where('user_id', $userId)->where('loker_id', $lokerId)->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['bookmarked' => false]);
        } else {
            Bookmark::create([
                'user_id' => $userId,
                'loker_id' => $lokerId
            ]);
            return response()->json(['bookmarked' => true]);
        }
    }
}
