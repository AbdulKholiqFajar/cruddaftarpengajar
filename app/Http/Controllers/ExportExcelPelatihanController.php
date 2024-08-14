<?php

namespace App\Http\Controllers;

use App\Exports\PelatihanExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelPelatihanController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();
        return Excel::download(new PelatihanExport($data), 'pelatihan.xlsx');
    }
}
