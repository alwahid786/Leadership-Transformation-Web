<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;

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
    Route::get('/slide/{slideNumber}', [ContentController::class, 'showSlide'])->name('slide');
    Route::get('/gratitude/con', [ContentController::class, 'gratitudeFunction'])->name('gratitudeFunction');
    Route::get('/wow/con', [ContentController::class, 'wowFunction'])->name('wowFunction');
    Route::get('/vision/con', [ContentController::class, 'visionFunction'])->name('visionFunction');
    Route::get('/inspiration/con', [ContentController::class, 'inspirationFunction'])->name('inspirationFunction');
    Route::get('/execution/con', [ContentController::class, 'executionFunction'])->name('executionFunction');

    Route::get('/cover/submit', [ContentController::class, 'submitCover'])->name('submitCover');

    Route::get('/gratitude', function () {
        return view('pages.gratitude');
    });
    Route::get('/wow', function () {
        return view('pages.wow');
    });
    Route::get('/vision', function () {
        return view('pages.vision');
    });
    Route::get('/inspiration', function () {
        return view('pages.inspiration');
    });
    Route::get('/execution', function () {
        return view('pages.execution');
    });
});
