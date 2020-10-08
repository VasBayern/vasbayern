<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ShopBrandController;
use App\Http\Controllers\Admin\ShopCategoryController;
use App\Http\Controllers\Admin\ShopCouponController;
use App\Http\Controllers\Admin\ShopFeedbackController;
use App\Http\Controllers\Admin\ShopProductController;
use App\Http\Controllers\Admin\ShopSizeController;
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
        Route::get('category/list', [ShopCategoryController::class, 'index'])->name('category');
        Route::get('category', [ShopCategoryController::class, 'create']);
        Route::get('category/{slug}', [ShopCategoryController::class, 'edit']);
        Route::post('category', [ShopCategoryController::class, 'store']);
        Route::put('category/{slug}', [ShopCategoryController::class, 'update']);
        Route::delete('category/{slug}', [ShopCategoryController::class, 'destroy']);

        /**
         * Shop Brand
         */
        Route::get('brand/list', [ShopBrandController::class, 'index'])->name('brand');
        Route::get('brand', [ShopBrandController::class, 'create']);
        Route::get('brand/{slug}', [ShopBrandController::class, 'edit']);
        Route::post('brand', [ShopBrandController::class, 'store']);
        Route::put('brand/{slug}', [ShopBrandController::class, 'update']);
        Route::delete('brand/{slug}', [ShopBrandController::class, 'destroy']);

        /**
         * Size
         */
        Route::get('size', [ShopSizeController::class, 'index'])->name('size');
        Route::post('size', [ShopSizeController::class, 'store']);
        Route::put('size/{id}', [ShopSizeController::class, 'update']);
        Route::delete('size/{id}', [ShopSizeController::class, 'destroy']);

        /**
         * Shop Product
         */
        Route::get('product/list', [ShopProductController::class, 'index'])->name('product');
        Route::get('product', [ShopProductController::class, 'create']);
        Route::get('product/{slug}', [ShopProductController::class, 'edit']);
        Route::post('product', [ShopProductController::class, 'store']);
        Route::put('product/{slug}', [ShopProductController::class, 'update']);
        Route::delete('product/{id}', [ShopProductController::class, 'destroy']);

        Route::post('product/{slug}/properties',  [ShopProductController::class, 'storeProperties']);
        Route::put('product/{slug}/properties/{id}', [ShopProductController::class, 'updateProperties']);
        Route::delete('product/{slug}/properties/{id}',  [ShopProductController::class, 'destroyProperties']);

        //Route::view('/product/{id}/properties', 'admin.content.shop.product.edit');
        /**
         * Shop Coupon
         */
        Route::get('coupon',  [ShopCouponController::class, 'index'])->name('coupon');
        Route::post('coupon',  [ShopCouponController::class, 'store']);
        Route::put('coupon/{id}',  [ShopCouponController::class, 'update']);
        Route::delete('coupon/{id}',  [ShopCouponController::class, 'destroy']);

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
        
        Route::get('getSlug', [AdminController::class, 'getSlug'])->name('getSlug');
        
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () { 
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show'); 
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload'); 
});
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });