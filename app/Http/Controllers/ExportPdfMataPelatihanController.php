<?php

namespace App\Http\Controllers;

use App\Models\MataPelatihan;
use Illuminate\Http\Request;
use PDF;

class ExportPdfMataPelatihanController extends Controller
{

    public function __invoke(Request $request)
    {
        // return view('pegawai.exportpdf', [
        //     'pegawai' => Pegawai::all(),
        // ]);
        // $pdf = PDF::loadview('index')->setPaper('A4','potrait');
        // return $pdf->stream();
        $pdf = PDF::loadview('MataPelatihan.exportpdf', [
            'mata_pelatihans' => MataPelatihan::all(),
        ])->setPaper('F4', 'landscape');
        return $pdf->stream();
    }
}
