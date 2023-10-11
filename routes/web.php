<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
Route::middleware('AdminLoginCheck')->get('/admin/auth/{any}', [AdminController::class, 'index'])->where('any', '.*')->name('lvs.auth');
Route::middleware('AdminLoginCheck')->get('/admin', [AdminController::class,'index'])->where('any','.*')->name('lvs.home');
Route::middleware('AdminLoginCheck')->get('/admin/{any}', [AdminController::class,'index'])->where('any','.*')->name('lvs.any');
Route::get('/admin', function (){ return redirect()->route('lvs.home','home'); });
