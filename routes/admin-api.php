<?php

use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminAuthController;

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


Route::group(['middleware' => ['AdminAuth'], 'prefix' => 'auth'], function () {
    Route::post('login', [AdminAuthController::class, 'login'])->name('Auth.login');
});


//Product
Route::prefix('product')->group(function () {
    Route::post('create', [ProductController::class, 'create'])->name('Product.create');
    Route::post('update', [ProductController::class, 'update'])->name('Product.update');
    Route::post('list', [ProductController::class, 'list'])->name('Product.list');
    Route::post('delete', [ProductController::class, 'delete'])->name('Product.delete');
});

//Category
Route::prefix('category')->group(function () {
    Route::post('create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('list', [CategoryController::class, 'list'])->name('category.list');
    Route::post('delete', [CategoryController::class, 'delete'])->name('category.delete');
});

// Media
Route::prefix('media')->group(function () {
    Route::post('upload', [MediaController::class, 'Upload'])->name('API.MEDIA.UPLOAD');
});
