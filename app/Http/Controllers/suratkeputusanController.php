<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\suratkeputusan;
use App\Models\Golongan;
use App\Models\Pegawai;
use App\Models\MataPelatihan;

class suratkeputusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratkeputusan = suratkeputusan::with(['golongan','mata_pelatihan','pegawai'])->get();
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
        $pegawai = Pegawai::all();
        $mataPelatihan = MataPelatihan::all();
        return view('suratkeputusan.create', compact('golongan','pegawai','mataPelatihan'));
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
            'start_time' => 'required',
            'end_time' => 'required',
            'nama_pengajar' => 'required',
            'mapel' => 'required',
            'golongan_id' => 'required|exists:golongan,id',
            'jml_jp' => 'required',
            'tarif_jp' => 'required',
            'jumlah_bruto' => 'required',
        ]);

        $data = [
            'tanggal' => $request->tanggal,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'pegawai_id' => $request->nama_pengajar,
            'mata_pelatihan_id' => $request->mapel,
            'golongan_id' => $request->golongan_id,
            'jml_jp' => str_replace(',', '', $request->jml_jp),
            'tarif_jp' =>  $request->tarif_jp,
            'jumlah_bruto' =>  str_replace(',', '',$request->jumlah_bruto),
        ];
        suratkeputusan::create($data);

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
        $pegawai = Pegawai::all();
        $mataPelatihan = MataPelatihan::all();
        return view('suratkeputusan.edit', compact('suratkeputusan', 'golongan','pegawai','mataPelatihan'));
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
            'start_time' => 'required',
            'end_time' => 'required',
            'nama_pengajar' => 'required',
            'mapel' => 'required',
            'golongan_id' => 'required|exists:golongan,id',
            'jml_jp' => 'required',
            'tarif_jp' => 'required',
            'jumlah_bruto' => 'required',
        ]);
        $data = [
            'tanggal' => $request->tanggal,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'pegawai_id' => $request->nama_pengajar,
            'mata_pelatihan_id' => $request->mapel,
            'golongan_id' => $request->golongan_id,
            'jml_jp' => str_replace(',', '', $request->jml_jp),
            'tarif_jp' =>  $request->tarif_jp,
            'jumlah_bruto' =>  str_replace(',', '',$request->jumlah_bruto),
        ];
        $suratkeputusan = suratkeputusan::findOrFail($id);
        $suratkeputusan->update($data);

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
