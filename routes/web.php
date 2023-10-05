<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BungaController;
use App\Http\Controllers\simpananController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin
Route::prefix('admin')->middleware(['role:0'])->group(function(){
    Route::get('/index', [AdminController::class, 'index'])->name('admin_index');
    Route::get('/detailUser{id}', [AdminController::class, 'detailUser'])->name('detailUser');


    Route::post('/createSimpanan', [simpananController::class, 'doCreate'])->name('createSimpanan');
    Route::post('/updateSimpanan', [simpananController::class, 'doUpdate'])->name('updateSimpanan');

    Route::get('/aturan', [simpananController::class, 'aturan'])->name('aturan');

    Route::post('/createAturan', [simpananController::class, 'doCreateAturan'])->name('createAturan');
    Route::post('/updateAturan', [simpananController::class, 'doUpdateAturan'])->name('updateAturan');

    Route::get('/bunga', [BungaController::class, 'index'])->name('bunga');
    Route::post('/createBunga', [BungaController::class, 'doCreateBunga'])->name('createBunga');
    Route::post('/updateBunga', [BungaController::class, 'doUpdateBunga'])->name('updateBunga');
    Route::post('/deleteBunga', [BungaController::class, 'doDeleteBunga'])->name('deleteBunga');
    Route::post('/aktifBunga', [BungaController::class, 'doAktifBunga'])->name('aktifBunga');

});

Route::prefix('user')->middleware(['role:1'])->group(function(){
    Route::get('/index', [UserController::class, 'index'])->name('user_index');

});
