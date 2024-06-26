<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\aturanController;
use App\Http\Controllers\aturanPinjamanController;
use App\Http\Controllers\BungaController;
use App\Http\Controllers\bungaPinjamanController;
use App\Http\Controllers\cicilanController;
use App\Http\Controllers\iuranController;
use App\Http\Controllers\pinjamanController;
use App\Http\Controllers\SHUController;
use App\Http\Controllers\simpananController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/resetPassword', [SiteController::class, 'resetPassword'])->name('resetPassword');
Route::post('/doResetPassword', [SiteController::class, 'doResetPassword'])->name('doResetPassword');

//admin
Route::prefix('admin')->middleware(['role:0'])->group(function(){
    Route::get('/index', [AdminController::class, 'index'])->name('admin_index');
    Route::get('/detailUser/{id}', [AdminController::class, 'detailUser'])->name('detailUser');
    Route::post('/hitungDanSimpanBunga', [AdminController::class, 'hitungDanSimpanBunga'])->name('hitungDanSimpanBunga');
    
    Route::post('/tambahNasabah', [AdminController::class, 'tambahNasabah'])->name('tambahNasabah');
    Route::post('/ubahNasabah', [AdminController::class, 'ubahNasabah'])->name('ubahNasabah');
    Route::post('/suspendUser/{id}', [AdminController::class, 'suspendUser'])->name('suspendUser');
    Route::post('/aktifUser/{id}', [AdminController::class, 'aktifUser'])->name('unSuspendUser');

    Route::post('/createSimpanan', [simpananController::class, 'doCreate'])->name('createSimpanan');
    Route::post('/updateSimpanan', [simpananController::class, 'doUpdate'])->name('updateSimpanan');
    Route::post('/deleteSimpanan', [simpananController::class, 'doDelete'])->name('deleteSimpanan');

    Route::get('/aturan', [aturanController::class, 'aturan'])->name('aturan');
    Route::post('/createAturan', [aturanController::class, 'doCreateAturan'])->name('createAturan');
    Route::post('/updateAturan', [aturanController::class, 'doUpdateAturan'])->name('updateAturan');
    Route::post('/deleteAturan', [aturanController::class, 'doDeleteAturan'])->name('deletAturan');
    Route::post('/aktifAturan', [aturanController::class, 'doActivateAturan'])->name('AktifAturan');

    Route::get('/bunga', [BungaController::class, 'index'])->name('bunga');
    Route::post('/createBunga', [BungaController::class, 'doCreateBunga'])->name('createBunga');
    Route::post('/updateBunga', [BungaController::class, 'doUpdateBunga'])->name('updateBunga');
    Route::post('/deleteBunga', [BungaController::class, 'doDeleteBunga'])->name('deleteBunga');
    Route::post('/aktifBunga', [BungaController::class, 'doAktifBunga'])->name('aktifBunga');

    Route::get('/bungaPinjaman', [bungaPinjamanController::class, 'index'])->name('bungaPinjaman');
    Route::post('/createBungaPinjaman', [bungaPinjamanController::class, 'doCreateBunga'])->name('createBungaPinjaman');
    Route::post('/updateBungaPinjaman', [bungaPinjamanController::class, 'doUpdateBunga'])->name('updateBungaPinjaman');
    Route::post('/deleteBungaPinjaman', [bungaPinjamanController::class, 'doDeleteBunga'])->name('deleteBungaPinjaman');
    Route::post('/aktifBungaPinjaman', [bungaPinjamanController::class, 'doAktifBunga'])->name('aktifBungaPinjaman');

    Route::get('/cicilan', [cicilanController::class, 'index'])->name('cicilan');
    Route::post('/createCicilan', [cicilanController::class, 'doCreateCicilan'])->name('createCicilan');
    Route::post('/updateCicilan', [cicilanController::class, 'doUpdateCicilan'])->name('updateCicilan');
    Route::post('/deleteCicilan', [cicilanController::class, 'doDeleteCicilan'])->name('deleteCicilan');
    Route::post('/aktifCicilan', [cicilanController::class, 'doAktifCicilan'])->name('aktifCicilan');

    Route::get('/iuran', [iuranController::class, 'index'])->name('iuran');
    Route::post('/createIuran', [iuranController::class, 'doCreateIuran'])->name('createIuran');
    Route::post('/updateIuran', [iuranController::class, 'doUpdateIuran'])->name('updateIuran');
    Route::post('/deleteIuran', [iuranController::class, 'doDeleteIuran'])->name('deleteIuran');
    Route::post('/aktifIuran', [iuranController::class, 'doAktifIuran'])->name('aktifIuran');

    Route::get('/aturanPinjaman', [aturanPinjamanController::class, 'index'])->name('aturanPinjaman');
    Route::post('/createAturanPinjaman', [aturanPinjamanController::class, 'doCreatePinjaman'])->name('createAturanPinjaman');
    Route::post('/updateAturanPinjaman', [aturanPinjamanController::class, 'doUpdatePinjaman'])->name('updateAturanPinjaman');
    Route::post('/deleteAturanPinjaman', [aturanPinjamanController::class, 'doDeletePinjaman'])->name('deleteAturanPinjaman');
    Route::post('/aktifAturanPinjaman', [aturanPinjamanController::class, 'doAktifPinjaman'])->name('aktifAturanPinjaman');

    Route::get('/shu', [SHUController::class, 'index'])->name('shu');
    Route::post('/updateSHU', [SHUController::class, 'doUpdateSHU'])->name('updateSHU');
    Route::post('/deleteSHU', [SHUController::class, 'doDeleteSHU'])->name('deleteSHU');
    Route::post('/aktifSHU', [SHUController::class, 'doAktifSHU'])->name('aktifSHU');

    Route::post('/hitungshu', [SHUController::class, 'hitungshu'])->name('hitungshu');
    Route::get('/listSHU', [SHUController::class, 'listSHU'])->name('listSHU');



    Route::get('/detailUser/pinjaman/{id}', [pinjamanController::class, 'index'])->name('pinjaman');
    Route::post('/createPinjaman', [pinjamanController::class, 'doCreatePinjaman'])->name('createPinjaman');
    Route::post('/updatePinjaman', [pinjamanController::class, 'doUpdatePinjaman'])->name('updatePinjaman');
    Route::post('/hapusPinjaman/{id}', [pinjamanController::class, 'hapusPinjaman'])->name('hapusPinjaman');
    Route::post('/aktifPinjaman', [pinjamanController::class, 'doAktifPinjaman'])->name('aktifPinjaman');

    Route::post('/detailUser/bayarPinjaman/{id}', [pinjamanController::class, 'bayarPinjaman'])->name('bayarPinjaman');
    Route::post('/detailUser/batalkanPembayaran/{id}', [pinjamanController::class, 'batalkanPembayaran'])->name('batalkanPembayaran');

});

Route::prefix('user')->middleware(['role:1'])->group(function(){
    Route::get('/index', [UserController::class, 'index'])->name('user_index');
    Route::get('/pinjaman/{id}', [UserController::class, 'pinjaman'])->name('pinjaman.user');
});
