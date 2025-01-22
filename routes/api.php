<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationAPIMiddleware;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/reg',[UserController::class,'UserRegistration'])->name('UserRegistration');
Route::post('/login',[UserController::class,'UserLogIn'])->name('login');
Route::post('/sent-otp',[UserController::class,'SendOtpCode'])->name('sendotp');
Route::post('/verify-otp',[UserController::class,'VerifyOTP'])->name('vrifyotp');
Route::post('/reset-password',[UserController::class,'ResetPassword'])->name('ResetPassword')->middleware([TokenVerificationAPIMiddleware::class]);
Route::get('/userprofile',[UserController::class,'UserProfile'])->name('userprofile')->middleware([TokenVerificationAPIMiddleware::class]);
Route::post('/updateprofile',[UserController::class,'UpdateProfile'])->name('updateprofile')->middleware([TokenVerificationAPIMiddleware::class]);
