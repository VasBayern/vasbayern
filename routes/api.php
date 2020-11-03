<?php

use App\Http\Controllers\Api\Admin\ColorController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::get('getUser', [AuthController::class, 'getUser']);
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('colors', [ColorController::class, 'index'])->name('color');
    Route::post('colors', [ColorController::class, 'store']);
    Route::put('colors/{id}', [ColorController::class, 'update']);
    Route::delete('colors/{id}', [ColorController::class, 'destroy']);
    
});
