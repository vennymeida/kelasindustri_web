<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Kota;
use App\Models\LowonganPekerjaan;
use App\Models\User;
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

        $query = $user->bookmark()->with(['lowonganPekerjaan.perusahaan', 'lowonganPekerjaan.perusahaan.kota']);

        // Apply search filters if provided
        $posisi = $request->input('posisi');
        $lokasi = $request->input('lokasi');

        // Apply search filters if provided
        if ($posisi) {
            $query->whereHas('lowonganPekerjaan', function ($q) use ($posisi) {
                $q->where('judul', 'like', '%' . $posisi . '%');
            });
        }

        if ($lokasi) {
            $query->whereHas('lowonganPekerjaan.perusahaan', function ($q) use ($lokasi) {
                $q->whereHas('kota', function ($q) use ($lokasi) {
                    $q->where('kota', 'like', '%' . $lokasi . '%');
                });
            });
        }

        $bookmarks = $query->orderByDesc('created_at')->paginate(3);

        return view('bookmark.index', [
            'bookmarks' => $bookmarks,
            'selectedLokasi' => $lokasi,
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
}
