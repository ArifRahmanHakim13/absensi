<?php

use App\Http\Controllers\AbsensiAdminController;
use App\Http\Controllers\AbsensiStafController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KapusController;
use App\Http\Controllers\LiburController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TapelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return (Auth::check())
        ? redirect(route('dashboard.index'))->withInfo('Anda masih dalam sesi')
        : redirect(route('login'));
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'cekLogin'])->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {

    Route::post('/logout', LogoutController::class)->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/staf', StafController::class);

    Route::middleware('can:admin')->group(function () {

        Route::resource('/admin', AdminController::class);

        // ✔ FIX: Paksa Laravel memakai {kapus}, bukan {kapu}
        Route::resource('/kapus', KapusController::class)
            ->parameters(['kapus' => 'kapus']);

        Route::resource('/tapel', TapelController::class);
        Route::resource('/libur', LiburController::class);

        Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
        Route::put('/sekolah/updatedata', [SekolahController::class, 'updateData'])->name('sekolah.updatedata');
        Route::put('/sekolah/updatelogo', [SekolahController::class, 'updateLogo'])->name('sekolah.updatelogo');

        Route::get('/absensi/admin', [AbsensiAdminController::class, 'index'])->name('absensi.admin.index');
        Route::get('/absensi/admin/{yearmonth}', [AbsensiAdminController::class, 'show'])->name('absensi.admin.show');
        Route::get('/absensi/admin/{type}/{date}', [AbsensiAdminController::class, 'create'])->name('absensi.admin.create');
        Route::post('/absensi/admin/{type}/{date}', [AbsensiAdminController::class, 'store'])->name('absensi.admin.store');
    });

    Route::middleware('can:staf')->group(function () {
        Route::get('/absensi/staf', [AbsensiStafController::class, 'index'])->name('absensi.staf.index');
        Route::get('/absensi/staf/{type}', [AbsensiStafController::class, 'create'])->name('absensi.staf.create');
        Route::post('/absensi/staf/{tanggal}/{type}', [AbsensiStafController::class, 'store'])->name('absensi.staf.store');
    });

    Route::middleware('can:admindankapus')->group(function () {
        Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi.index');
        Route::get('/rekapitulasi/print', [RekapitulasiController::class, 'print'])->name('rekapitulasi.print');
    });

    Route::prefix('/profil')->group(function () {
        Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
        Route::get('/edit-foto', [ProfilController::class, 'editFoto'])->name('profil.editfoto');
        Route::get('/edit-akun', [ProfilController::class, 'editAkun'])->name('profil.editakun');
        Route::put('/updateprofil/{id}', [ProfilController::class, 'update'])->name('profil.update');
        Route::put('/updatefoto/{id}', [ProfilController::class, 'updatePhoto'])->name('foto.update');
        Route::put('/updateakun/{id}', [ProfilController::class, 'updateAkun'])->name('akunsaya.update');
    });

});
