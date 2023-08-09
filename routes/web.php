<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('auth.login');
});
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

Route::post('/register', [AuthController::class, 'signupFunction'])->name('signupFunction');
Route::post('/signin', [AuthController::class, 'signinFunction'])->name('signinFunction');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/otp-verification', [AuthController::class, 'verifyOtp'])->name('verifyOtp');
Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('resetPassword');

Route::middleware('auth')->group(function () {
    Route::get('/cover', function () {
        return view('pages.cover');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/slide/1', function () {
        return view('pages.slide1');
    });
    Route::get('/slide/2', function () {
        return view('pages.slide2');
    });
    Route::get('/slide/3', function () {
        return view('pages.slide3');
    });
    Route::get('/slide/4', function () {
        return view('pages.slide4');
    });
    Route::get('/slide/5', function () {
        return view('pages.slide5');
    });
    Route::get('/slide/6', function () {
        return view('pages.slide6');
    });
});
