<?php

use App\Http\Controllers\Admin\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ShopBrandController;
use App\Http\Controllers\Admin\ShopCategoryController;
use App\Http\Controllers\Admin\ShopCouponController;
use App\Http\Controllers\Admin\ShopFeedbackController;
use App\Http\Controllers\Admin\ShopProductController;
use App\Http\Controllers\Admin\ShopSizeController;
use App\Models\ShopCategoryModel;
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
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthLoginController::class, 'showLoginForm']);
    Route::post('login', [AuthLoginController::class, 'login'])->name('login');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('register', [AuthRegisterController::class, 'showRegisterForm']);
        Route::post('register', [AuthRegisterController::class, 'register'])->name('register');
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::post('logout', [AuthLoginController::class, 'logout'])->name('logout');

        // Route::get('/email/verify', function () {
        //     return view('admin.auth.verify-email');
        // })->middleware(['auth:admin'])->name('verification.notice');

        // Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        //     $request->fulfill();

        //     return redirect('/');
        // })->middleware(['auth:admin', 'signed'])->name('verification.verify');

        // Route::post('/email/verification-notification', function (HttpRequest $request) {
        //     $request->user()->sendEmailVerificationNotification();

        //     return back()->with('status', 'verification-link-sent');
        // })->middleware(['auth:admin', 'throttle:6,1'])->name('verification.send');

        /**
         * Shop category
         */
        Route::get('category', [ShopCategoryController::class, 'index'])->name('category');
        Route::get('category/create', [ShopCategoryController::class, 'create']);
        Route::get('category/{id}/edit', [ShopCategoryController::class, 'edit']);
        Route::get('category/checkSlug', [ShopCategoryController::class, 'checkSlug'])->name('category.checkSlug');

        Route::post('category', [ShopCategoryController::class, 'store']);
        Route::post('category/{id}', [ShopCategoryController::class, 'update']);
        Route::delete('category/{id}/delete', [ShopCategoryController::class, 'destroy']);

        /**
         * Shop Brand
         */
        Route::get('brand', [ShopBrandController::class, 'index'])->name('brand');
        Route::get('brand/create', [ShopBrandController::class, 'create']);
        Route::get('brand/{id}/edit', [ShopBrandController::class, 'edit']);

        Route::post('brand', [ShopBrandController::class, 'store']);
        Route::post('brand/{id}', [ShopBrandController::class, 'update']);
        Route::delete('brand/{id}/delete', [ShopBrandController::class, 'destroy']);

        /**
         * Size
         */
        Route::get('size', [ShopSizeController::class, 'index'])->name('size');
        Route::get('size/create', [ShopSizeController::class, 'create']);
        Route::get('size/{id}/edit', [ShopSizeController::class, 'edit']);

        Route::post('size', [ShopSizeController::class, 'store']);
        Route::post('size/{id}', [ShopSizeController::class, 'update']);
        Route::delete('size/{id}/delete', [ShopSizeController::class, 'destroy']);

        /**
         * Shop Product
         */
        Route::get('product', [ShopProductController::class, 'index'])->name('product');
        Route::get('product/create', [ShopProductController::class, 'create']);
        Route::get('product/{id}/edit', [ShopProductController::class, 'edit']);

        Route::post('product', [ShopProductController::class, 'store']);
        Route::post('product/{id}', [ShopProductController::class, 'update']);
        Route::delete('product/{id}/delete', [ShopProductController::class, 'destroy']);

        Route::post('product/{id}/edit/properties',  [ShopProductController::class, 'storeProperties']);
        Route::post('product/{id}/edit/properties/{size}', [ShopProductController::class, 'editProperties']);
        Route::delete('product/{id}/edit/properties/{size}/delete',  [ShopProductController::class, 'destroyProperties']);

        //Route::view('/product/{id}/properties', 'admin.content.shop.product.edit');
        /**
         * Shop Coupon
         */
        Route::get('coupon',  [ShopCouponController::class, 'index'])->name('coupon');
        Route::get('coupon/create',  [ShopCouponController::class, 'create']);
        Route::get('coupon/{id}/edit',  [ShopCouponController::class, 'edit']);

        Route::post('coupon',  [ShopCouponController::class, 'store']);
        Route::post('coupon/{id}',  [ShopCouponController::class, 'update']);
        Route::delete('coupon/{id}/delete',  [ShopCouponController::class, 'destroy']);

        /**
         * Feedback
         */
        Route::get('feedback', [ShopFeedbackController::class, 'index']);

        /**
         *  Media
         */
        Route::get('media', function () {
            return view('admin.content.media.index');
        });
        
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () { 
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show'); 
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload'); 
});
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });