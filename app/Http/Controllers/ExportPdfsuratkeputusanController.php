<?php

namespace App\Http\Controllers;

use App\Models\suratkeputusan;
use Illuminate\Http\Request;
use PDF;

class ExportPdfsuratkeputusanController extends Controller
{

    public function __invoke(Request $request)
    {
        // return view('pegawai.exportpdf', [
        //     'pegawai' => Pegawai::all(),
        // ]);
        // $pdf = PDF::loadview('index')->setPaper('A4','potrait');
        // return $pdf->stream();
        $pdf = PDF::loadview('suratkeputusan.exportpdf', [
            'suratkeputusan' => suratkeputusan::all(),
        ])->setPaper('F4', 'landscape');
        return $pdf->stream();
    }
}
