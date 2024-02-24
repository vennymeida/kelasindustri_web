<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan;
use App\Http\Requests\Storekategori_pekerjaanRequest;
use App\Http\Requests\Updatekategori_pekerjaanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriPekerjaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kategori.index')->only('index');
        $this->middleware('permission:kategori.create')->only('create', 'store');
        $this->middleware('permission:kategori.edit')->only('edit', 'update');
        $this->middleware('permission:kategori.destroy')->only('destroy');
    }
    public function index(Request $request)
    {
        $kategoris = DB::table('kategori_pekerjaans')
            ->when($request->input('kategori'), function ($query, $kategori) {
                return $query->where('kategori', 'like', '%' . $kategori . '%');
            })
            ->select('id', 'kategori', DB::raw("DATE_FORMAT(created_at, '%d %M %Y') as created_at"))
            ->paginate(10);

        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Storekategori_pekerjaanRequest $request)
    {
        //simpan data
        KategoriPekerjaan::create([
            'kategori' => $request['kategori'],
        ]);
        return redirect(route('kategori.index'))->with('success', 'Data Berhasil Ditambahkan');;
    }


    public function edit(KategoriPekerjaan $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Updatekategori_pekerjaanRequest $request, KategoriPekerjaan $kategori)
    {
        $request->validate([
            'kategori' => 'required|unique:kategori_pekerjaans,kategori,' . $kategori->id,
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori Pekerjaan berhasil diperbarui.');
    }

    public function destroy(KategoriPekerjaan $kategori)
    {
        //delete data
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Data Kategori Berhasil Di Hapus');
    }
}
