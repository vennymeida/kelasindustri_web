<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportKotaRequest;
use App\Http\Requests\StoreKotaRequest;
use App\Http\Requests\UpdateKotaRequest;
use App\Imports\KotasImport;
use App\Models\Kota;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kota.index')->only('index');
        $this->middleware('permission:kota.create')->only('create', 'store');
        $this->middleware('permission:kota.edit')->only('edit', 'update');
        $this->middleware('permission:kota.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $kotas = DB::table('kotas')
            ->when($request->input('kota'), function ($query, $kota) {
                return $query->where('kota', 'like', '%' . $kota . '%');
            })
            ->paginate(10);
        return view('kota.index', compact('kotas'));
    }

    public function create()
    {
        return view('kota.create');
    }

    public function store(StoreKotaRequest $request)
    {
        Kota::create([
            'kota' => $request->kota,
        ]);
        return redirect()->route('kota.index')->with('success', 'Data kota berhasil ditambahkan.');
    }

    public function show(Kota $kota)
    {
        //
    }

    public function edit(Kota $kotum)
    {
        return view('kota.edit', compact('kotum'));
    }

    public function update(UpdateKotaRequest $request, Kota $kotum)
    {
        $request->validate([
            'kota' => 'required|unique:kotas,kota,' . $kotum->id,
        ]);

        $kotum->update($request->all());

        return redirect()->route('kota.index')
            ->with('success', 'Data kota berhasil diperbarui.');
    }

    public function destroy(Kota $kotum)
    {
        try {
            $kotum->delete();
            return redirect()->route('kota.index')->with('success', 'Data kota berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('kota.index')
                    ->with('error', 'Data kota sedang digunakan ditabel lain.');
            } else {
                return redirect()->route('kota.index')->with('success', 'Data kota berhasil dihapus.');
            }
        }
    }

    public function import(ImportKotaRequest $request)
    {
        try {
            $file = $request->file('import-file');
            Excel::import(new KotasImport, $file);
            return redirect()->route('kota.index')->with('success', 'File data kota berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
