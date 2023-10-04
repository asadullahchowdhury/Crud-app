<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('product')->group(function (){
    Route::post('create',[ProductController::class,'create'])->name('Product.create');
    Route::post('update',[ProductController::class,'update'])->name('Product.update');
    Route::post('list',[ProductController::class,'list'])->name('Product.list');
    Route::post('delete',[ProductController::class,'delete'])->name('Product.delete');
});
