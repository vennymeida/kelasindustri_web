<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Keahlian;
use App\Models\Pendidikan;
use App\Models\Pengalaman;
use App\Models\Perusahaan;
use App\Models\ProfileKeahlian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileKeahlianController extends Controller
{
    public function edit()
    {
        $keahlians = Keahlian::all();
        $userId = Auth::id();
        $perusahaans = Perusahaan::where('user_id', $userId)->first();

        $selectedKeahlians = auth()
            ->user()
            ->keahlians->pluck('id')
            ->toArray();
        $pendidikans = Pendidikan::select('pendidikan.*')
            ->where('user_id', $userId)
            ->get();
        $pengalamans = Pengalaman::select('pengalaman.*')
            ->where('user_id', $userId)
            ->get();

        return view('profile.edit')->with([
            'keahlians' => $keahlians,
            'selectedKeahlians' => $selectedKeahlians,
            'pendidikans' => $pendidikans,
            'pengalamans' => $pengalamans,
            'perusahaans' => $perusahaans,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'keahlian_ids' => 'required|array',
            'keahlian_ids.*' => 'exists:keahlians,id',
        ]);

        auth()
            ->user()
            ->keahlians()
            ->sync($request->keahlian_ids);

        return redirect()
            ->route('profile.keahlian.edit')
            ->with('success', 'Keahlian berhasil disimpan.');
    }

    public function deleteKeahlian(Request $request)
    {
        $request->validate([
            'keahlian_id' => 'required|exists:keahlians,id',
        ]);

        auth()
            ->user()
            ->keahlians()
            ->detach($request->keahlian_id);

        return redirect()
            ->route('profile.keahlian.edit')
            ->with('success', 'Keahlian berhasil dihapus.');
    }
}
