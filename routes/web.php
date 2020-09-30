<?php

use App\Http\Controllers\Admin\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request as HttpRequest;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (HttpRequest $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/**
 * -----------------------------------ADMIN-----------------------------------
 */
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('login', [AuthLoginController::class, 'showLoginForm']);
    Route::post('login', [AuthLoginController::class, 'login'])->name('login');
    
    Route::middleware(['auth:admin'])->group(function(){
        Route::get('register', [AuthRegisterController::class, 'showRegisterForm']);
        Route::post('register', [AuthRegisterController::class, 'create'])->name('register');
        Route::get('/', [HomeController::class, 'index']);
    });
});