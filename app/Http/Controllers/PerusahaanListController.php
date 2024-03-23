<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Perusahaan;
use App\Models\LowonganPekerjaan;
use Illuminate\Support\Str;

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

        // Paginasi hasil query
        $perusahaanData = $query->paginate(10);

        return view('perusahaan.index', compact('perusahaanData'));
    }


    public function edit(User $perusahaan)
    {
        return view('perusahaan.edit', compact('perusahaan'));
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
        // Menghilangkan tag <p> dan tag lainnya dari deskripsi
        if ($perusahaan && $perusahaan->deskripsi) {
            $perusahaan->deskripsi = Str::replace(
                ['<ol>', '</ol>', '<li>', '</li>', '<br>', '<p>', '</p>'],
                ['', '', '', ", ", '', '', "\n"],
                $perusahaan->deskripsi
            );
            $perusahaan->deskripsi = rtrim($perusahaan->deskripsi, ', ');
        }

        return view('perusahaan.view', compact('perusahaan'));
    }

    public function showTotalLowonganPekerjaan()
    {
        $userId = Auth::id();
        $totalLowongan = LowonganPekerjaan::where('user_id', $userId)->where('status', 'dibuka')->count();

        return view('perusahaan.view', ['totalLowongan' => $totalLowongan]);
    }
}
