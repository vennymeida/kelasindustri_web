<?php

namespace App\Http\Controllers;

use App\Models\Keahlian;
use App\Http\Requests\StoreKeahlianRequest;
use App\Http\Requests\UpdateKeahlianRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeahlianController extends Controller
{
    // Menampilkan semua keahlian
    public function index()
    {
        $keahlians = Keahlian::where('user_id', auth()->id())->get();
        return view('profile.index', compact('keahlians'));
    }

    // Menyimpan keahlian baru
    public function store(Request $request)
    {
        $request->validate([
            'keahlian' => 'required|string|max:255',
        ]);

        Keahlian::create([
            'user_id' => auth()->id(),
            'keahlian' => $request->keahlian,
        ]);

        return redirect()->back()->with('success', 'Keahlian berhasil disimpan.');
    }

    // Menampilkan form edit keahlian
    public function edit($id)
    {
        $keahlian = Keahlian::findOrFail($id);
        return view('keahlians.edit', compact('keahlian'));
    }

    // Memperbarui keahlian
    public function update(Request $request, $id)
    {
        $request->validate([
            'keahlian' => 'required|string|max:255',
        ]);

        $keahlian = Keahlian::findOrFail($id);
        $keahlian->update([
            'keahlian' => $request->keahlian,
        ]);

        return redirect()->back()->with('success', 'Keahlian berhasil diperbarui.');
    }

    // Menghapus keahlian
    public function destroy($id)
    {
        $keahlian = Keahlian::findOrFail($id);
        $keahlian->delete();

        return redirect()->back()->with('success', 'Keahlian berhasil dihapus.');
    }
}
