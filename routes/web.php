<?php

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

