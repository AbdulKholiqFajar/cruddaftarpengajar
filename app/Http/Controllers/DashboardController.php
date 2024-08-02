<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\suratkeputusan;
use App\Models\MataPelatihan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pegawaiCount = Pegawai::get()->count();
        $mapelCount = MataPelatihan::get()->count();
        $suratCount = suratkeputusan::get()->count();
        return view('dashboard', compact('pegawaiCount','mapelCount','suratCount'));
    }
}
