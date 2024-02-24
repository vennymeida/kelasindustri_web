<?php

namespace App\Http\Controllers;

use App\Models\Keahlian;
use App\Http\Requests\StoreKeahlianRequest;
use App\Http\Requests\UpdateKeahlianRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeahlianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:keahlian.index')->only('index');
        $this->middleware('permission:keahlian.create')->only('create', 'store');
        $this->middleware('permission:keahlian.edit')->only('edit', 'update');
        $this->middleware('permission:keahlian.destroy')->only('destroy');
    }
    public function index(Request $request)
    {
        $keahlians = DB::table('keahlians')
            ->when($request->input('keahlian'), function ($query, $keahlian) {
                return $query->where('keahlian', 'like', '%' . $keahlian . '%');
            })
            ->select('id', 'keahlian')
            ->paginate(10);

        return view('keahlian.index', compact('keahlians'));
    }

    public function create()
    {
        return view('keahlian.create');
    }

    public function store(StoreKeahlianRequest $request)
    {
        Keahlian::create([
            'keahlian' => $request['keahlian'],
        ]);
        return redirect(route('keahlian.index'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(Keahlian $keahlian)
    {
        //
    }

    public function edit(Keahlian $keahlian)
    {
        return view('keahlian.edit', compact('keahlian'));
    }

    public function update(UpdateKeahlianRequest $request, Keahlian $keahlian)
    {
        $request->validate([
            'keahlian' => 'required|unique:keahlians,keahlian,' . $keahlian->id,
        ]);

        $keahlian->update($request->all());

        return redirect()->route('keahlian.index')
            ->with('success', 'Data Keahlian berhasil diperbarui.');
    }

    public function destroy(Keahlian $keahlian)
    {
        $keahlian->delete();
        return redirect()->route('keahlian.index')->with('success', 'Data Berhasil Di Hapus');
    }
}
