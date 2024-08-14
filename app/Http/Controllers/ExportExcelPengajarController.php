<?php

namespace App\Http\Controllers;

use App\Exports\PengajarExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelPengajarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Excel::download(new PengajarExport, 'pengajar.xlsx');
    }
}
