<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use App\Models\MataPelatihan;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pengajarCount = Pengajar::count();
        $mapelCount = MataPelatihan::count();
        $pelatihanCount = Pelatihan::count();

        return view('dashboard', compact('pengajarCount', 'mapelCount', 'pelatihanCount'));
    }
}