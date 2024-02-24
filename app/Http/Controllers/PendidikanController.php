<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendidikan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePendidikanRequest;
use App\Http\Requests\UpdatePendidikanRequest;

class PendidikanController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $pendidikan = Pendidikan::where('user_id', $userId)->get();
        return view('profile.pendidikan', compact('pendidikan'));
    }

    public function create()
    {
        return view('profile.index');
    }

    public function store(StorePendidikanRequest $request)
    {
        $userId = Auth::user()->id;

        $pendidikan = new Pendidikan($request->validated());
        $pendidikan->user_id = $userId;
        $pendidikan->save();

        return redirect()
            ->route('profile.index')
            ->with('success', 'success-create');
    }

    public function edit($id)
    {
        $pendidikan = Pendidikan::findOrFail($id);
        return response()->json($pendidikan);
    }

    public function update(UpdatePendidikanRequest $request, Pendidikan $pendidikan)
    {
        try {
            $pendidikan->update($request->all());
            return response()->json(['success' => true, 'message' => 'Pendidikan berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Pendidikan $pendidikan)
    {
        $pendidikan->delete();
        return redirect()
            ->route('profile.index')
            ->with('success', 'success-delete');
    }
}
