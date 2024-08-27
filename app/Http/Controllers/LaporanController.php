<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatihan; // Ganti dengan model yang sesuai
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil data pelatihan dari basis data
        $pelatihans = Pelatihan::all()->groupBy(function ($item) {
            return Carbon::parse($item->tanggal)->format('Y-m-d');
        });

        $groupPelatihan = [];
        foreach ($pelatihans as $tanggal => $items) {
            $groupPelatihan[$tanggal] = $items;
        }

        return view('laporan', [
            'title' => 'Laporan Pelatihan',
            'groupPelatihan' => $groupPelatihan
        ]);
    }
}