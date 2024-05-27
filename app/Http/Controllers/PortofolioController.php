<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Portofolio;
use Illuminate\Support\Facades\DB;

class PortofolioController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $portofolios = Portofolio::where('user_id', $userId)->get();
        return view('profile.portofolio', compact('portofolios'));
    }

    public function create()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        // Validasi input
        $request->validate([
            'nama_portofolio' => 'required|string|max:255',
            'dokumen_portofolio' => 'nullable|mimes:png,jpeg,jpg|max:5000',
            'deskripsi_portofolio' => 'required',
            'link_portofolio' => 'nullable|url|max:255',
        ]);

        $portofolio = new Portofolio([
            'user_id' => $userId,
            'nama_portofolio' => $request->input('nama_portofolio'),
            'dokumen_portofolio' => $request->input('dokumen_portofolio'),
            'deskripsi_portofolio' => $request->input('deskripsi_portofolio'),
            'link_portofolio' => $request->input('link_portofolio'),
        ]);

        // Cek apakah file PDF diunggah
        if ($request->hasFile('dokumen_portofolio')) {
            // Simpan file PDF
            $file = $request->file('dokumen_portofolio');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('portofolio', $fileName, 'public');

            $portofolio->dokumen_portofolio = $filePath;
        }

        $portofolio->save();

        return redirect()
            ->route('profile-lulusan.index')
            ->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        return response()->json($portofolio);
    }

    public function update(Request $request, Portofolio $portofolio)
    {
        $rules = [
            'nama_portofolio' => 'required|string|max:255',
            'dokumen_portofolio' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'deskripsi_portofolio' => 'required',
            'link_portofolio' => 'nullable|url|max:255',
        ];

        $validatedData = $request->validate($rules);

        try {
            if ($request->hasFile('dokumen_portofolio')) {
                // Hapus dokumen lama
                Storage::disk('public')->delete($portofolio->dokumen_portofolio);

                // Simpan dokumen baru
                $file = $request->file('dokumen_portofolio');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('portofolio', $fileName, 'public');

                $validatedData['dokumen_portofolio'] = $filePath;
            }

            $portofolio->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Portofolio berhasil diperbarui.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
    }

    public function destroy(Portofolio $portofolio)
    {
        // Hapus dokumen dari storage
        if ($portofolio->dokumen_portofolio) {
            Storage::disk('public')->delete($portofolio->dokumen_portofolio);
        }

        $portofolio->delete();
        return redirect()
            ->route('profile-lulusan.index')
            ->with('success', 'success-delete');
    }

    public function show($id) {
        $portofolio = Portofolio::findOrFail($id);
        $data = [
            'title' => $portofolio->nama_portofolio,
            'image' => asset('storage/' . $portofolio->dokumen_portofolio),
            'deskripsi' => $portofolio->deskripsi_portofolio,
        ];
        return response()->json($data);
    }
}
