<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\ColorController;
use App\Http\Controllers\Api\Admin\CouponController;
use App\Http\Controllers\Api\Admin\SizeController;
use App\Http\Controllers\Api\Admin\TagController as AdminTagController;
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
    /**
     * Category
     */
    Route::resource('categories', CategoryController::class)->except('show')->names(['index' => 'categories']);
    /**
     * Color
     */
    Route::apiResource('colors', ColorController::class)->except('show')->names(['index' => 'colors']);
    /**
     * Size
     */
    Route::apiResource('sizes', SizeController::class)->except('show')->names(['index' => 'sizes']);
    /**
     * Tag
     */
    Route::apiResource('tags', AdminTagController::class)->except('show')->names(['index' => 'tags']);
     /**
     * Coupon
     */
    Route::apiResource('coupons', CouponController::class)->except('show')->names(['index' => 'coupons']);
});
