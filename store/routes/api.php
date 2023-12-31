<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [ProductController::class,'index'])->name('home');
Route::post('/store', [ProductController::class,'store'])->name('store');
Route::get('/show/{product}', [ProductController::class,'show'])->name('show');
Route::delete('/destroy/{product}', [ProductController::class,'destroy'])->name('destroy');