<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use App\Models\Pelatihan;
use App\Models\MataPelatihan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pengajarCount = Pengajar::get()->count();
        $mapelCount = MataPelatihan::get()->count();
        $pelatihanCount = Pelatihan::get()->count();
        return view('dashboard', compact('pengajarCount','mapelCount','pelatihanCount'));
    }
}
