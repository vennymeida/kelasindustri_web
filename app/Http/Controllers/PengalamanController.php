<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengalaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePengalamanRequest;
use App\Http\Requests\UpdatePengalamanRequest;

class PengalamanController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $pengalaman = Pengalaman::where('user_id', $userId)->get();
        return view('profile.pengalaman', compact('pengalaman'));
    }

    public function create()
    {
        return view('profile.index');
    }

    public function store(StorePengalamanRequest $request)
    {
        $userId = Auth::user()->id;

        $pengalaman = new Pengalaman($request->validated());
        $pengalaman->user_id = $userId;
        $pengalaman->save();

        return redirect()
            ->route('profile.index')
            ->with('success', 'success-create');
    }

    public function edit($id)
    {
        $pengalaman = Pengalaman::findOrFail($id);
        return response()->json($pengalaman);
    }

    public function update(UpdatePengalamanRequest $request, Pengalaman $pengalaman)
    {
        try {
            $pengalaman->update($request->all());
            return response()->json(['success' => true, 'message' => 'Pengalaman berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Pengalaman $pengalaman)
    {
        $pengalaman->delete();
        return redirect()
            ->route('profile.index')
            ->with('success', 'success-delete');
    }
}
