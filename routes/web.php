<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CpanelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IntrtactionController;

Route::get('/', [ProductController::class,'index'])->name('home');

Route::get('/show/{product}', [ProductController::class,'show'])->name('show');
Route::get('/search', [ProductController::class,'search'])->name('search');
Route::get ('/category/{category_id}', [CategoryController::class,'show'])->name('category');

Route::get('/signup', [AuthController::class,'signup'])->name('signup');
Route::post('/submit_signup', [AuthController::class,'submit_signup'])->name('submit_signup');

Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/submit_login', [AuthController::class,'submit_login'])->name('submit_login');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){
    Route::get('/create', [ProductController::class,'create'])->name('create');
    Route::post('/store', [ProductController::class,'store'])->name('store');
    Route::post('/like/{product}', [IntrtactionController::class,'like'])->name('like');
    Route::post('/comment/{product}', [IntrtactionController::class,'comment'])->name('comment');

    Route::delete('/destroy/{product}', [ProductController::class,'destroy'])->name('destroy')->middleware(['product_owner']);
    Route::get ('/create_category', [CategoryController::class,'create'])->name('create_category');
    Route::post('/store_category', [CategoryController::class,'store'])->name('store_category');
});
Route::middleware(['check_admin'])->group(function(){
    Route::get('/cpanel', [CpanelController::class,'index'])->name('cpanel');
});

/*
نقوم بتغليف الراوت ب ميدلوير معين واحد او اكثر 
ويوجد راوتات غير مغلفة  لم نضع اي شروط عليها 
نقوم بارسال قيم في الراوت بين القوسين من الفرونت 
مثال :عندما يختار المستخدم منتج معين يتم ارسال قيمة هذا المنتج مع الراوت 
لكي نبحث عنها في قاعدة البيانات ونحضر كل معلومات المنتج 
يمكن انشاء ملفات للراوت غير الملفات الاربعة الاساسية 
ولكن يجب تعريفها في الاعدادات لكي تتمكن من الكتابة بها 
نقوم باعطاء اسم للراوت لكي يسهل التعامل معه في الفورم او في مكان اخر 
الميدلوير اما نضعه على راوت واحد مثل راوت الحذف او نضع ضمنه مجموعة راوتات 
الراوتات التي عند طلبها يجب ان يكون المستخدم مسجل دخوله في الموقع 
نضعها في ميدلوير ال auth

ينتقل التنفيذ بعد الراوت الى الكونترولر  اذا لم يكن هناك ميدلوير للراوت 
يتم تحديد الكونترولر والتابع الذي سيتم طلبه منه في الراوت 
عند كتابة الراوت في ال 
api
نضيف على ال رابط api 
https:/example.com/login        <web>
https:/example.com/api/login    <api>



*/