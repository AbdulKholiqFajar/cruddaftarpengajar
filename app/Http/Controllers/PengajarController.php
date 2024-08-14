<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Pengajar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengajar.index', [
            'pengajar' => Pengajar::paginate(10),
        ]);

        $pengajar = Pengajar::with('golongan')->get(); 
        return view('pengajar.index', compact('pengajar')); 

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengajar.create', [
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
            'nip' => ['required', 'numeric', 'unique:pengajar,nip'],
            'nama_pengajar' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'golongan_id' => ['required', 'exists:golongan,id'],
            'honor' => ['required', 'string'],
            'pajak' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        Pengajar::create($validatedData);

        session()->flash('success', 'Data Berhasil Ditambahkan.');

        return redirect()->route('pengajar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengajar = Pengajar::findOrFail($id);
        return view('pengajar.show', compact('pengajar'));
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
        $pengajar = Pengajar::findOrFail($id);
        $golongan = Golongan::all(); // Pastikan untuk mengirimkan data golongan juga
        return view('pengajar.edit', compact('pengajar', 'golongan'));
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
        $pengajar = Pengajar::findOrFail($id);
        $validatedData = $request->validate([
            'nip' => [
                'required',
                Rule::unique('pengajar')->ignore($pengajar->id)
            ],
            'nama_pengajar' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'golongan_id' => ['required', 'exists:golongan,id'],
            'honor' => ['required', 'string'],
            'pajak' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        // $pengajar = pengajar::findOrFail($id);
        $pengajar->update($validatedData);

        session()->flash('success', 'Data Berhasil Diperbarui.');

        return redirect()->route('pengajar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $pengajar = Pengajar::findOrFail($id);
        $pengajar->delete();
        
        return response()->json(['success' => true]);
    }

    public function getGolongan($id)
    {
        $pengajar = Pengajar::find($id);
        if ($pengajar) {
            return response()->json([
                'golongan' => $pengajar->golongan ? $pengajar->golongan->nama : ''
            ]);
        }
        return response()->json(['golongan' => ''], 404);
    }
}