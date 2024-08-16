<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement\PermissionController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::group(['prefix'=>'user_management',], function(){
        Route::resource('user', UserController::class)->except(['create','edit']);
        Route::resource('role', RoleController::class)->except(['create','edit']);
        Route::resource('permission', PermissionController::class)->except(['create','edit']);
    });

    Route::resource('pengajar', \App\Http\Controllers\PengajarController::class);
    Route::resource('mata_pelatihans', \App\Http\Controllers\MataPelatihanController::class);
    Route::resource('pelatihan', \App\Http\Controllers\PelatihanController::class);
    Route::resource('sk', \App\Http\Controllers\SkController::class);

    Route::get('/export-excel-pengajar', \App\Http\Controllers\ExportExcelPengajarController::class)->name('export.excel');
    Route::get('/export-pdf-pengajar', \App\Http\Controllers\ExportPdfPengajarController::class)->name('export.pdf.pengajar');
    Route::get('/export-pdf-mata_pelatihans', \App\Http\Controllers\ExportPdfMataPelatihanController::class)->name('export.pdf.mata_pelatihans');
    Route::get('/export-pdf-pelatihan', \App\Http\Controllers\ExportPdfPelatihanController::class)->name('export.pdf');
    Route::get('/export-pdf-detail-pelatihan', [\App\Http\Controllers\PelatihanController::class, 'exportPdf'])->name('export.surat.pdf');
    Route::get('/export-excel-pelatihan', \App\Http\Controllers\ExportExcelPelatihanController::class)->name('export.excel');
    Route::get('/pengajar/{id}/golongan', [\App\Http\Controllers\PengajarController::class, 'getGolongan'])->name('pengajar.golongan');
    Route::get('/mata_pelatihan/{id}', [\App\Http\Controllers\MataPelatihanController::class, 'getJumlahJP']);
    
    Route::put('/pelatihan/{id}/status', [\App\Http\Controllers\PelatihanController::class, 'updateStatus'])->name('pelatihan.updateStatus');
});


require __DIR__ . '/auth.php';
