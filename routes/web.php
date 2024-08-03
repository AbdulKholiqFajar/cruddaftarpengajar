<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.admin');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pegawai', \App\Http\Controllers\PegawaiController::class);
    Route::resource('mata_pelatihans', \App\Http\Controllers\MataPelatihanController::class);
    Route::resource('suratkeputusan', \App\Http\Controllers\suratkeputusanController::class);
    Route::resource('sub_mata_pelatihans', \App\Http\Controllers\SubMataPelatihanController::class);

    Route::get('/export-excel-pegawai', \App\Http\Controllers\ExportExcelPegawaiController::class)->name('export.excel');
    Route::get('/export-pdf-pegawai', \App\Http\Controllers\ExportPdfPegawaiController::class)->name('export.pdf.pegawai');
    Route::get('/export-pdf-mata_pelatihans', \App\Http\Controllers\ExportPdfMataPelatihanController::class)->name('export.pdf.mata_pelatihans');
    Route::get('/export-pdf-suratkeputusan', \App\Http\Controllers\ExportPdfsuratkeputusanController::class)->name('export.pdf');
});
// Route::resource('pegawai', \App\Http\Controllers\PegawaiController::class);

require __DIR__ . '/auth.php';

// Route::get('/export-excel-pegawai', ExportExcelPegawaiController::class)->name('export.excel');
// Route::get('/export-pdf-pegawai', ExportPdfPegawaiController::class)->name('export.pdf');
