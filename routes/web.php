<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceProductController;
use App\Http\Middleware\TokenVerificationMiddleware;

//Vue
Route::get('/',[HomeController::class,'HomePage'])->name('HomePage');
Route::get('/LoginPage',[UserController::class,'LoginPage'])->name('LoginPage');
Route::get('/RegistrationPage',[UserController::class,'RegistrationPage'])->name('RegistrationPage');
Route::get('/ResetPasswordPage',[UserController::class,'ResetPasswordPage'])->name('ResetPasswordPage');
Route::get('/SendOtpPage',[UserController::class,'SendOtpPage'])->name('SendOtpPage');
Route::get('/VerifyOtpPage',[UserController::class,'VerifyOtpPage'])->name('VerifyOtpPage');

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

//cus
Route::post('/create-customer',[CustomerController::class,'CustomerCreate'])->name('CustomerCreate')->middleware([TokenVerificationMiddleware::class]);
Route::get('/list-customer',[CustomerController::class,'CustomerList'])->name('CustomerList')->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-customer',[CustomerController::class,'CustomerDelete'])->name('CustomerDelete')->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-customer',[CustomerController::class,'CustomerUpdate'])->name('CustomerUpdate')->middleware([TokenVerificationMiddleware::class]);
Route::get('/customer-by-id',[CustomerController::class,'CustomerById'])->name('CustomerById')->middleware([TokenVerificationMiddleware::class]);


//product
Route::post('/create-product',[ProductController::class,'CreateProduct'])->name('CreateProduct')->middleware([TokenVerificationMiddleware::class]);
Route::get('/delete-product',[ProductController::class,'DeleteProduct'])->name('DeleteProduct')->middleware([TokenVerificationMiddleware::class]);
Route::post('/list-product',[ProductController::class,'ProductList'])->name('ProductList')->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-product',[ProductController::class,'UpdateProduct'])->name('UpdateProduct')->middleware([TokenVerificationMiddleware::class]);
Route::get('/product-by-id',[ProductController::class,'ProductById'])->name('ProductById')->middleware([TokenVerificationMiddleware::class]);

//Invoice

Route::post('/InvoiceCreate',[InvoiceController::class, 'InvoiceCreate'] )->name('InvoiceCreate')->middleware([TokenVerificationMiddleware::class]);  
Route::get('/InvoiceSelect', [InvoiceController::class,'InvoiceSelect'])->name('InvoiceSelect')->middleware([TokenVerificationMiddleware::class]);  
Route::post('/InvoiceDetail', [InvoiceController::class,'InvoiceDetail'])->name('InvoiceDetail')->middleware([TokenVerificationMiddleware::class]);  
Route::post('/InvoiceDelete', [InvoiceController::class,'InvoiceDelete'])->name('InvoiceDelete')->middleware([TokenVerificationMiddleware::class]);  

//Summery

Route::get('/summery',[DashboardController::class,'summery'])->name('DashboardController')->middleware([TokenVerificationMiddleware::class]);

