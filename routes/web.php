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
    // Functional Routes 
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/cover', [ContentController::class, 'coverPage'])->name('coverPage');
    Route::get('/gratitude', [ContentController::class, 'gratitudePage'])->name('gratitudePage');
    Route::get('/wow', [ContentController::class, 'wowPage'])->name('wowPage');
    Route::get('/vision', [ContentController::class, 'visionPage'])->name('visionPage');
    Route::get('/inspiration', [ContentController::class, 'inspirationPage'])->name('inspirationPage');
    Route::get('/execution', [ContentController::class, 'executionPage'])->name('executionPage');
    Route::get('/conclusion', [ContentController::class, 'conclusionPage'])->name('conclusionPage');
    Route::get('/slide/{slideNumber}', [ContentController::class, 'showSlide'])->name('slide');
    Route::get('/gratitude/con', [ContentController::class, 'gratitudeFunction'])->name('gratitudeFunction');
    Route::get('/wow/con', [ContentController::class, 'wowFunction'])->name('wowFunction');
    Route::get('/vision/con', [ContentController::class, 'visionFunction'])->name('visionFunction');
    Route::get('/inspiration/con', [ContentController::class, 'inspirationFunction'])->name('inspirationFunction');
    Route::get('/execution/con', [ContentController::class, 'executionFunction'])->name('executionFunction');
    Route::get('/conclusion/con', [ContentController::class, 'conclusionFunction'])->name('conclusionFunction');
    Route::get('/create-pdf', [ContentController::class, 'createPdf'])->name('createPdf');

    // Submit Forms 
    Route::post('/cover/submit', [ContentController::class, 'submitCover'])->name('submitCover');
    Route::post('/gratitude/submit', [ContentController::class, 'submitGratitude'])->name('submitGratitude');
    Route::post('/wow/submit', [ContentController::class, 'submitWow'])->name('submitWow');
    Route::post('/vision/submit', [ContentController::class, 'submitVision'])->name('submitVision');
    Route::post('/inspiration/submit', [ContentController::class, 'submitInspiration'])->name('submitInspiration');
    Route::post('/execution/submit', [ContentController::class, 'submitExecution'])->name('submitExecution');

    Route::get('/pdf', function () {
        return view('pages.pdf');
    });
});
