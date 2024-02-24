<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelatihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePelatihanRequest;
use App\Http\Requests\UpdatePelatihanRequest;

class PelatihanController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $pelatihan = Pelatihan::where('user_id', $userId)->get();
        return view('profile.pelatihan', compact('pelatihan'));
    }

    public function create()
    {
        return view('profile.index');
    }

    public function store(StorePelatihanRequest $request)
    {
        $userId = Auth::user()->id;

        $pelatihan = new Pelatihan($request->validated());
        $pelatihan->user_id = $userId;

        if ($request->hasFile('sertifikat')) {
            $sertifikat = $request->file('sertifikat');
            $filename = time() . '_' . $sertifikat->getClientOriginalName();
            $path = $sertifikat->storeAs('sertifikat', $filename, 'public');
            $pelatihan->sertifikat = $path;
        }

        $pelatihan->save();

        return redirect()
            ->route('profile.index')
            ->with('success', 'success-create');
    }

    public function edit($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        return response()->json($pelatihan);
    }

    public function update(UpdatePelatihanRequest $request, Pelatihan $pelatihan)
    {
        try {
            // Simpan path sertifikat lama sebelum menggantinya
            $oldSertifikatPath = $pelatihan->sertifikat;

            $pelatihan->update($request->all());

            if ($request->hasFile('sertifikat')) {
                $sertifikat = $request->file('sertifikat');
                $filename = time() . '_' . $sertifikat->getClientOriginalName();
                $path = $sertifikat->storeAs('sertifikat', $filename, 'public');

                // Hapus sertifikat lama dari storage
                if ($oldSertifikatPath) {
                    Storage::disk('public')->delete($oldSertifikatPath);
                }

                $pelatihan->sertifikat = $path;
                $pelatihan->save();
            }

            return response()->json(['success' => true, 'message' => 'Pelatihan berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Pelatihan $pelatihan)
    {
        // Hapus sertifikat dari storage sebelum menghapus data pelatihan
        if ($pelatihan->sertifikat) {
            Storage::disk('public')->delete($pelatihan->sertifikat);
        }

        $pelatihan->delete();

        return redirect()
            ->route('profile.index')
            ->with('success', 'success-delete');
    }
}
