<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pegawai.index', [
            'pegawai' => Pegawai::paginate(10),
        ]);

        $pegawai = Pegawai::with('golongan')->get(); // Ambil semua pegawai dengan relasi golongan
        return view('pegawai.index', compact('pegawai')); // Kirim ke view

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create', [
            'golongan' => Golongan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => ['required', 'numeric', 'unique:pegawai,nip'],
            'nama_pengajar' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'golongan_id' => ['required', 'exists:golongan,id'],
            'jp' => ['required', 'integer', 'in:300000,1000000'],
            'pajak' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        Pegawai::create($validatedData);

        session()->flash('success', 'Data Berhasil Ditambahkan.');

        return redirect()->route('pegawai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pegawai.edit', [
            'golongan' => Golongan::all(),
            'pegawai' => Pegawai::find($id)
        ]);
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
        $validatedData = $request->validate([
            'nip' => ['required', 'numeric', 'unique:pegawai,nip'],
            'nama_pengajar' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'golongan_id' => ['required', 'exists:golongan,id'],
            'jp' => ['required', 'integer', 'in:300000,1000000'],
            'pajak' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        $pegawai = Pegawai::find($id);
        $pegawai->update($validatedData);

        session()->flash('success', 'Data Berhasil Diperbarui.');

        return redirect()->route('pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        session()->flash('success', 'Data Berhasil Dihapus.');

        return redirect()->route('pegawai.index');
    }
}