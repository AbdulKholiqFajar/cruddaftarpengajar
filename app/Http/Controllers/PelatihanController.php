<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Pelatihan;
use App\Models\Golongan;
use App\Models\Pengajar;
use App\Models\MataPelatihan;
use Barryvdh\DomPDF\Facade as pdf;

class PelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Pelatihan::with(['golongan','mata_pelatihan','pengajar']);
        $masterPelatihan = $query->get()->groupBy('title')->keys()->toArray();
        $data = $request->all();
        if ($request->start_date && $request->end_date) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }
        $pelatihan = null;
        $pelatihanArr = collect();
        $grouppelatihan =collect();
        $where =[];
        if($request->title){
            $where['title'] = $request->title;
            $pelatihan = $query->where($where)->first();
            $pelatihanArr = Pelatihan::where('title', $pelatihan?->title)->get();
            $grouppelatihan = $pelatihanArr->groupBy('title');
        }
        // dd($pelatihan);
        return view('pelatihan.index', compact('pelatihan','masterPelatihan','data','grouppelatihan','pelatihanArr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $golongan = Golongan::all();
        $pengajar = Pengajar::all();
        $mataPelatihan = MataPelatihan::all();
        $masterPelatihan = Pelatihan::get()->groupBy('title')->keys()->toArray();
        return view('pelatihan.create', compact('golongan','pengajar','mataPelatihan','masterPelatihan'));
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
            'golongan_id' => 'required|integer|exists:golongan,nama',
            'jml_jp' => 'required',
            'tarif_jp' => 'nullable',
            'jumlah_bruto' => 'nullable',
        ]);
        $title = $request->is_new ? $request->title_input : $request->title_select;
        $data = [
            'title' => $title,
            'tanggal' => $request->tanggal,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'pengajar_id' => $request->nama_pengajar,
            'mata_pelatihan_id' => $request->mapel,
            'golongan_id' => (int) $request->golongan_id,
            'jml_jp' => str_replace(',', '', $request->jml_jp),
            'tarif_jp' => $request->tarif_jp ? str_replace(',', '', $request->tarif_jp): 0,
            'jumlah_bruto' => $request->jumlah_bruto ? str_replace(',', '', $request->jumlah_bruto) : 0,
        ];
        pelatihan::create($data);

        return redirect()->route('pelatihan.index', ['title' => $title])->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihanArr = Pelatihan::where('title', $pelatihan->title)->get();
        $grouppelatihan = $pelatihanArr->groupBy('title');
    
        return view('pelatihan.show', compact('pelatihan','grouppelatihan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $golongan = Golongan::all();
        $pengajar = Pengajar::all();
        $mataPelatihan = MataPelatihan::all();
        $isPetugas = Auth::user()->hasRole('petugas_satker');
        $masterPelatihan = Pelatihan::get()->groupBy('title')->keys()->toArray();
        return view('pelatihan.edit', compact('pelatihan', 'golongan','pengajar','mataPelatihan','isPetugas','masterPelatihan'));
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
            'title' => 'required',
            'tanggal' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'nama_pengajar' => 'required',
            'mapel' => 'required',
            'golongan_id' => 'required|integer|exists:golongan,nama',
            'jml_jp' => 'required',
            'tarif_jp' => 'nullable',
            'jumlah_bruto' => 'nullable',
        ]);

        $data = [
            'title' => $request->title,
            'tanggal' => $request->tanggal,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'pengajar_id' => $request->nama_pengajar,
            'mata_pelatihan_id' => $request->mapel,
            'golongan_id' => (int) $request->golongan_id,
            'jml_jp' => str_replace(',', '', $request->jml_jp),
            'tarif_jp' => $request->tarif_jp ? str_replace(',', '', $request->tarif_jp): 0,
            'jumlah_bruto' => $request->jumlah_bruto ? str_replace(',', '', $request->jumlah_bruto) : 0,
        ];
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->update($data);

        return redirect()->route('pelatihan.index', ['title' => $pelatihan->title])->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->delete();

        return response()->json(['success' => 'Data berhasil dihapus.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $status = $request->input('status');
        $statusCode = $status == 'approved' ? 2 : ($status == 'rejected' ? 3 : 0);

        $updated = Pelatihan::where('id', $id)->update([
            'approve' => $statusCode
        ]);

        if ($updated) {
            return response()->json(['success' => true, 'message' => 'Status data telah diubah.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal mengubah status data.']);
        }
    }

    public function exportPdf(Request $request){
        $pelatihanArr = Pelatihan::where('title', $request->title)->get();
        $groupPelatihan = $pelatihanArr->groupBy('title');
        $pdf = pdf::loadview('pelatihan.exportDetailPdf', [
            'groupPelatihan' => $groupPelatihan,
            'title' =>  $request->title,
        ])->setPaper('F4', 'landscape');
        return $pdf->stream();
    }
}