<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelatihan;
use App\Models\SubMataPelatihan;

class SubMataPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_mata_pelatihans = SubMataPelatihan::all();
        return view('SubMataPelatihan.index', compact('sub_mata_pelatihans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mataPelatihan = MataPelatihan::all();
        return view('SubMataPelatihan.create', compact('mataPelatihan'));
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
            'mata_pelatihan_id' => 'required|string|max:10',
            'sub_mata_pelatihan' => 'required|string|max:255',
            'code_sub_mata_pelatihan' => 'required|numeric|min:1',
        ]);
        
        SubMataPelatihan::create([
            'mata_pelatihan_id' => $request->mata_pelatihan_id,
            'sub_mata_pelatihan' => $request->sub_mata_pelatihan,
            'code_sub_mata_pelatihan' => $request->code_sub_mata_pelatihan,
        ]);

        return redirect()->route('sub_mata_pelatihans.index')->with('success', 'Data mata pelatihan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_mata_pelatihans = SubMataPelatihan::findOrFail($id);
        return view('SubMataPelatihan.show', compact('sub_mata_pelatihans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_mata_pelatihan = SubMataPelatihan::findOrFail($id);
        $mataPelatihan = MataPelatihan::all();
        return view('SubMataPelatihan.edit', compact('sub_mata_pelatihan','mataPelatihan'));
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
            'mata_pelatihan_id' => 'required|string|max:10',
            'sub_mata_pelatihan' => 'required|string|max:255',
            'code_sub_mata_pelatihan' => 'required|numeric|min:1',
        ]);

        $sub_mata_pelatihans = SubMataPelatihan::findOrFail($id);
        $sub_mata_pelatihans->update([
            'mata_pelatihan_id' => $request->mata_pelatihan_id,
            'sub_mata_pelatihan' => $request->sub_mata_pelatihan,
            'code_sub_mata_pelatihan' => $request->code_sub_mata_pelatihan,
        ]);

        return redirect()->route('sub_mata_pelatihans.index')->with('success', 'Data mata pelatihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_mata_pelatihans = SubMataPelatihan::findOrFail($id);
        $sub_mata_pelatihans->delete();
        
        return response()->json(['success' => true]);
    }
}