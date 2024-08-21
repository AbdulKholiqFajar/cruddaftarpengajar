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
            'mata_pelatihan' => 'required|string|max:255',
            'jml_jp' => 'required|numeric|min:0',
        ]);

        MataPelatihan::create([
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
        return view('MataPelatihan.show', compact('mata_pelatihan'));
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
            'mata_pelatihan' => 'required|string|max:255',
            'jml_jp' => 'required|numeric|min:0',
        ]);

        $mata_pelatihan = MataPelatihan::findOrFail($id);
        $mata_pelatihan->update([
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
        $mata_pelatihans = MataPelatihan::findOrFail($id);
        $mata_pelatihans->delete();
        
        return response()->json(['success' => true]);
    }

    public function getJumlahJP($id)
{
    $mataPelatihan = MataPelatihan::find($id);
    if ($mataPelatihan) {
        return response()->json(['jml_jp' => $mataPelatihan->jml_jp]);
    } else {
        return response()->json(['jml_jp' => 0], 404);
    }
}
}

