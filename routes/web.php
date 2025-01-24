<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/reg',[UserController::class,'UserRegistration'])->name('UserRegistration');
Route::post('/login',[UserController::class,'UserLogIn'])->name('login');
Route::get('/logout',[UserController::class,'LogOut'])->name('logout');
Route::post('/sent-otp',[UserController::class,'SendOtpCode'])->name('sendotp');
Route::post('/verify-otp',[UserController::class,'VerifyOTP'])->name('vrifyotp');
Route::post('/reset-password',[UserController::class,'ResetPassword'])->name('ResetPassword')->middleware([TokenVerificationMiddleware::class]);
Route::get('/userprofile',[UserController::class,'UserProfile'])->name('userprofile')->middleware([TokenVerificationMiddleware::class]);
Route::post('/updateprofile',[UserController::class,'UpdateProfile'])->name('updateprofile')->middleware([TokenVerificationMiddleware::class]);

//Cat
Route::post('/create-category',[CategoryController::class,'CategoryCreate'])->name('CategoryCreate')->middleware([TokenVerificationMiddleware::class]);
Route::get('/list-category',[CategoryController::class,'CategoryList'])->name('CategoryList')->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-category',[CategoryController::class,'CategoryDelete'])->name('CategoryDelete')->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-category',[CategoryController::class,'CategoryUpdate'])->name('CategoryUpdate')->middleware([TokenVerificationMiddleware::class]);
Route::get('/category-by-id',[CategoryController::class,'CategoryById'])->name('CategoryById')->middleware([TokenVerificationMiddleware::class]);

//1:18 pause time