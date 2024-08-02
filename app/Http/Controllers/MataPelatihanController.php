<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelatihan;

class MataPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mata_pelatihans = MataPelatihan::all();
        return view('MataPelatihan.index', compact('mata_pelatihans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('MataPelatihan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => 'required|string|max:10|unique:mata_pelatihans',
            'mata_pelatihan' => 'required|string|max:255',
            'jml_jp' => 'required|numeric|min:1',
        ]);

        MataPelatihan::create([
            'kode_mapel' => $request->kode_mapel,
            'mata_pelatihan' => $request->mata_pelatihan,
            'jml_jp' => $request->jml_jp,
        ]);

        return redirect()->route('mata_pelatihans.index')->with('success', 'Data mata pelatihan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mata_pelatihan = MataPelatihan::findOrFail($id);
        return view('mata_pelatihans.show', compact('mata_pelatihan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mata_pelatihan = MataPelatihan::findOrFail($id);
        return view('MataPelatihan.edit', compact('mata_pelatihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_mapel' => 'required|string|max:10|unique:mata_pelatihans,kode_mapel,' . $id,
            'mata_pelatihan' => 'required|string|max:255',
            'jml_jp' => 'required|numeric|min:1',
        ]);

        $mata_pelatihan = MataPelatihan::findOrFail($id);
        $mata_pelatihan->update([
            'kode_mapel' => $request->kode_mapel,
            'mata_pelatihan' => $request->mata_pelatihan,
            'jml_jp' => $request->jml_jp,
        ]);

        return redirect()->route('mata_pelatihans.index')->with('success', 'Data mata pelatihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mata_pelatihan = MataPelatihan::findOrFail($id);
        $mata_pelatihan->delete();

        return redirect()->route('mata_pelatihans.index')->with('success', 'Data mata pelatihan berhasil dihapus.');
    }
}