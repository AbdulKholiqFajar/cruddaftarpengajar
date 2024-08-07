<?php

namespace App\Http\Controllers;

use App\Exports\SuratKeputusanExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelSuratKeputusanController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();
        return Excel::download(new SuratKeputusanExport($data), 'surat_keputusan.xlsx');
    }
}
