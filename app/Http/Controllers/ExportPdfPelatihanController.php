<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as pdf;

class ExportPdfPelatihanController extends Controller
{

    public function __invoke(Request $request)
    {
        \Log::info('ExportPdfPelatihanController invoked with request:', $request->all());
        
        $query = Pelatihan::with(['golongan','mata_pelatihan','pengajar']);
        
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }
        
        $pelatihan = $query->get();
        \Log::info('Fetched pelatihan:', $pelatihan->toArray());

        $pdf = pdf::loadview('pelatihan.exportpdf', [
            'pelatihan' => $pelatihan,
        ])->setPaper('F4', 'landscape');
        return $pdf->stream();
    }
}