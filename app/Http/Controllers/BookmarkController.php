<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\KategoriPekerjaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\LowonganPekerjaan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:bookmarks.index')->only('index');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $query = $user->bookmarks()->with(['lowonganPekerjaan.perusahaan', 'lowonganPekerjaan.kategori', 'lowonganPekerjaan.perusahaan.kecamatan', 'lowonganPekerjaan.perusahaan.kelurahan']);

        $kategoris = KategoriPekerjaan::all();


        // Apply search filters if provided
        $posisi = $request->input('posisi');
        $lokasi = $request->input('lokasi');
        $kategori = $request->input('kategori', []);

        // Apply search filters if provided
        if ($posisi) {
            $query->whereHas('lowonganPekerjaan', function ($q) use ($posisi) {
                $q->where('judul', 'like', '%' . $posisi . '%');
            });
        }

        if ($lokasi) {
            $query->whereHas('lowonganPekerjaan.perusahaan', function ($q) use ($lokasi) {
                $q->whereHas('kecamatan', function ($q) use ($lokasi) {
                    $q->where('kecamatan', 'like', '%' . $lokasi . '%');
                });
            });
        }

        if (!empty($kategori)) {
            $query->whereHas('lowonganPekerjaan.kategori', function ($q) use ($kategori) {
                $q->whereIn('kategori', $kategori);
            });
        }

        $bookmarks = $query->orderByDesc('created_at')->paginate(3);

        return view('bookmark.index', [
            'bookmarks' => $bookmarks,

            'kategoris' => $kategoris,
            'selectedLokasi' => $lokasi,
            'selectedKategori' => $kategori,
        ]);
    }

    public function toggleBookmark(Request $request)
    {
        $lokerId = $request->input('loker_id');
        $user = Auth::user();

        $bookmarked = false;

        // Check if the user has already bookmarked the job
        if ($user->bookmarks()->where('lowongan_pekerjaan_id', $lokerId)->exists()) {
            // Remove the bookmark
            $user->bookmarks()->where('lowongan_pekerjaan_id', $lokerId)->delete();
        } else {
            // Add the bookmark
            $user->bookmarks()->create(['lowongan_pekerjaan_id' => $lokerId]);
            $bookmarked = true;
        }

        return response()->json(['bookmarked' => $bookmarked]);
    }
}
