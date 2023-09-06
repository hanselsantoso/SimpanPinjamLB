<?php

use App\Http\Controllers\AdminController;
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
    Route::post('/detailUser', [AdminController::class, 'detailUser'])->name('detailUser');


    Route::post('/createSimpanan', [simpananController::class, 'doCreate'])->name('createSimpanan');

});

Route::prefix('user')->middleware(['role:1'])->group(function(){
    Route::get('/index', [UserController::class, 'index'])->name('user_index');

});
