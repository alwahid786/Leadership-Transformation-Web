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

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/signup', function () {
    return view('auth.signup');
});
Route::get('/forget-password', function () {
    return view('auth.forget-password');
});
Route::get('/otp-code', function () {
    return view('auth.otp-code');
});
Route::get('/reset-password', function () {
    return view('auth.reset-password');
});
Route::get('/cover', function () {
    return view('pages.cover');
});
