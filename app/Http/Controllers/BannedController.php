<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Perusahaan;


class BannedController extends Controller
{
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

        $query->where('status', 'banned');

        // Paginasi hasil query
        $perusahaanData = $query->paginate(10);

        return view('perusahaan.banned', compact('perusahaanData'));
    }

    public function unbanned(Perusahaan $perusahaan){
        $perusahaan->update([
            'status' => 'unbanned',
        ]);

        return redirect()->route('perusahaan.unbanned')->with('success', 'Akun perusahaan berhasil dipulihkan');
    }
}
