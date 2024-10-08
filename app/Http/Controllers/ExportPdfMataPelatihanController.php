<?php

namespace App\Http\Controllers;

use App\Models\MataPelatihan;
use Illuminate\Http\Request;
use PDF;

class ExportPdfMataPelatihanController extends Controller
{

    public function __invoke(Request $request)
    {
    
        $pdf = PDF::loadview('MataPelatihan.exportpdf', [
            'mata_pelatihans' => MataPelatihan::all(),
        ])->setPaper('F4', 'landscape');
        return $pdf->stream();
    }
}
