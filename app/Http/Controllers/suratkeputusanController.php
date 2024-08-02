<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\suratkeputusan;
use App\Models\Golongan;

class suratkeputusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratkeputusan = suratkeputusan::with('golongan')->get();
        return view('suratkeputusan.index', compact('suratkeputusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $golongan = Golongan::all();
        return view('suratkeputusan.create', compact('golongan'));
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
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'nama_pengajar' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
            'golongan_id' => 'required|exists:golongan,id',
            'jml_jp' => 'required|numeric',
            'tarif_jp' => 'required|numeric',
            'jumlah_bruto' => 'required|numeric',
        ]);

        suratkeputusan::create($request->all());

        return redirect()->route('suratkeputusan.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suratkeputusan = suratkeputusan::findOrFail($id);
        return view('suratkeputusan.show', compact('suratkeputusan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratkeputusan = suratkeputusan::findOrFail($id);
        $golongan = Golongan::all();
        return view('suratkeputusan.edit', compact('suratkeputusan', 'golongan'));
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
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'nama_pengajar' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
            'golongan_id' => 'required|exists:golongan,id',
            'jml_jp' => 'required|numeric',
            'tarif_jp' => 'required|numeric',
            'jumlah_bruto' => 'required|numeric',
        ]);

        $suratkeputusan = suratkeputusan::findOrFail($id);
        $suratkeputusan->update($request->all());

        return redirect()->route('suratkeputusan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suratkeputusan = suratkeputusan::findOrFail($id);
        $suratkeputusan->delete();

        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
