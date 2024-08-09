<?php

namespace App\Http\Controllers;

use App\Models\suratkeputusan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as pdf;

class ExportPdfsuratkeputusanController extends Controller
{

    public function __invoke(Request $request)
    {
        \Log::info('ExportPdfsuratkeputusanController invoked with request:', $request->all());
        
        $query = suratkeputusan::with(['golongan','mata_pelatihan','pegawai']);
        
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }
        
        $suratkeputusan = $query->get();
        \Log::info('Fetched suratkeputusan:', $suratkeputusan->toArray());

        $pdf = pdf::loadview('suratkeputusan.exportpdf', [
            'suratkeputusan' => $suratkeputusan,
        ])->setPaper('F4', 'landscape');
        return $pdf->stream();
    }
}