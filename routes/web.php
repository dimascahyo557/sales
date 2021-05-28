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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Category
Route::resource('category', App\Http\Controllers\CategoryController::class, ['except' => ['show']]);

// Product
Route::resource('product', App\Http\Controllers\ProductController::class);
Route::delete('product/{product}/force-delete', [App\Http\Controllers\ProductController::class, 'forceDelete'])->name('product.force-delete');
