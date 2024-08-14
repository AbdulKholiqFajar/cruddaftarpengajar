<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Http\Request;
use PDF;

class ExportPdfPengajarController extends Controller
{

    public function __invoke(Request $request)
    {
        $pdf = PDF::loadview('pengajar.exportpdf', [
            'pengajar' => Pengajar::all(),
        ])->setPaper('F4', 'landscape');
        return $pdf->stream();
    }
}
