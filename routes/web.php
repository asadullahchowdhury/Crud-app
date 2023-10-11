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
Route::get('/admin/auth/{any}', [AdminController::class, 'index'])->where('any', '.*')->name('lvs.auth');
Route::get('/admin', [AdminController::class,'index'])->where('any','.*')->name('lvs.home');
Route::get('/admin/{any}', [AdminController::class,'index'])->where('any','.*')->name('lvs.home');
Route::get('/admin', function (){ return redirect()->route('lvs.home','home'); });
