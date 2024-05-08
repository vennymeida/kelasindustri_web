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
            'link_portofolio' => 'nullable|url|max:255',
        ]);

        $portofolio = new Portofolio([
            'user_id' => $userId,
            'nama_portofolio' => $request->input('nama_portofolio'),
            'link_portofolio' => $request->input('link_portofolio'),
        ]);

        $portofolio->save();

        return redirect()
            ->route('profile-lulusan.index')
            ->with('success', 'success-create');
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
            'link_portofolio' => 'nullable|url|max:255',
        ];


        $validatedData = $request->validate($rules);

        try {

            $portofolio->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Portofolio berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    public function destroy(Portofolio $portofolio)
    {
        $portofolio->delete();
        return redirect()
            ->route('profile-lulusan.index')
            ->with('success', 'success-delete');
    }
}
