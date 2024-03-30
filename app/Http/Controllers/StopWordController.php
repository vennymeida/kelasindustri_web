<?php

namespace App\Http\Controllers;

use App\Models\StopWord;
use App\Http\Requests\StoreStopWordRequest;
use App\Http\Requests\UpdateStopWordRequest;
use Illuminate\Support\Facades\DB;

class StopWordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:stop-word.index')->only('index');
        $this->middleware('permission:stop-word.create')->only('create', 'store');
        $this->middleware('permission:stop-word.edit')->only('edit', 'update');
        $this->middleware('permission:stop-word.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stopWord = DB::table('stop_word')->paginate(20);

        return view('perhitungan.stop-word.index')->with([
            'stopWord' =>  $stopWord
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perhitungan.stop-word.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStopWordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStopWordRequest $request)
    {
        StopWord::create([
            'text' => $request->text,
        ]);
        return redirect()->route('stop-word.index')->with('success', 'Data Stop Word berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StopWord  $stopWord
     * @return \Illuminate\Http\Response
     */
    public function show(StopWord $stopWord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StopWord  $stopWord
     * @return \Illuminate\Http\Response
     */
    public function edit(StopWord $stopWord)
    {
        return view('perhitungan.stop-word.edit')->with([
            'stopWord' => $stopWord
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStopWordRequest  $request
     * @param  \App\Models\StopWord  $stopWord
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStopWordRequest $request, StopWord $stopWord)
    {
        $validatedDate = $request->validated();
        $stopWord->update($validatedDate);

        return redirect()->route('stop-word.index')
            ->with('success', 'Data Stop Word berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StopWord  $stopWord
     * @return \Illuminate\Http\Response
     */
    public function destroy(StopWord $stopWord)
    {
        try {
            $stopWord->delete();
            return redirect()->route('stop-word.index')
                ->with('success', 'Hapus Data Stop Word Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('stop-word.index')
                    ->with('error', 'Tidak Dapat Menghapus Stop Word Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('stop-word.index')
                    ->with('success', 'Hapus Stop Word Sukses');
            }
        }
    }
}
