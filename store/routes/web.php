<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CpanelController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class,'index'])->name('home');

Route::get('/show/{product}', [ProductController::class,'show'])->name('show');

Route::get ('/category/{category_id}', [CategoryController::class,'show'])->name('category');

Route::get('/signup', [AuthController::class,'signup'])->name('signup');
Route::post('/submit_signup', [AuthController::class,'submit_signup'])->name('submit_signup');

Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/submit_login', [AuthController::class,'submit_login'])->name('submit_login');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){
    Route::get('/create', [ProductController::class,'create'])->name('create');
    Route::post('/store', [ProductController::class,'store'])->name('store');
    Route::delete('/destroy/{product}', [ProductController::class,'destroy'])->name('destroy');
    Route::get ('/create_category', [CategoryController::class,'create'])->name('create_category');
    Route::post('/store_category', [CategoryController::class,'store'])->name('store_category');
});
Route::middleware(['check_admin'])->group(function(){
    Route::get('/cpanel', [CpanelController::class,'index'])->name('cpanel');
});