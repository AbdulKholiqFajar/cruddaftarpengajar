<?php

namespace App\Http\Controllers;

use App\Models\Sk;
use Illuminate\Http\Request;

class SkController extends Controller
{
    // Menampilkan daftar SK
    public function index()
    {
        $skList = Sk::all();
        return view('suratkeputusan.index', compact('skList'));
    }

    // Menampilkan formulir pembuatan SK baru
    public function create()
    {
        return view('suratkeputusan.create');
    }

    // Menyimpan data SK baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_sk' => 'required|string|max:255|unique:sk',
            'tanggal_sk' => 'required|date',
            'tahun' => 'required|integer',
            'tentang' => 'required',
            'menimbang' => 'required',
            'mengingat' => 'required',
            'menetapkan' => 'required',
            'tembusan' => 'required',
            'isi' => 'required',
        ]);

        Sk::create($request->all());

        return redirect()->route('suratkeputusan.index')->with('success', 'SK berhasil dibuat.');
    }

    // Menampilkan detail SK
    public function show($id)
    {
        $sk = Sk::findOrFail($id);
        return view('sk.show', compact('sk'));
    }

    // Menampilkan formulir edit SK
    public function edit($id)
    {
        $sk = Sk::findOrFail($id);
        return view('sk.edit', compact('sk'));
    }

    // Memperbarui data SK
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_sk' => 'required|string|max:255|unique:sk,nomor_sk,' . $id,
            'tanggal_sk' => 'required|date',
            'tahun' => 'required|integer',
            'tentang' => 'required',
            'menimbang' => 'required',
            'mengingat' => 'required',
            'menetapkan' => 'required',
            'tembusan' => 'required',
            'isi' => 'required',
        ]);

        $sk = Sk::findOrFail($id);
        $sk->update($request->all());

        return redirect()->route('suratkeputusan.index')->with('success', 'SK berhasil diperbarui.');
    }

    // Menghapus data SK
    public function destroy($id)
    {
        $sk = Sk::findOrFail($id);
        $sk->delete();

        return redirect()->route('suratkeputusan.index')->with('success', 'SK berhasil dihapus.');
    }
}
