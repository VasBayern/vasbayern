<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Admin\BannerController;
use App\Http\Controllers\Api\Admin\BrandController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\ColorController;
use App\Http\Controllers\Api\Admin\ContentCategoryController;
use App\Http\Controllers\Api\Admin\ContentCommentController;
use App\Http\Controllers\Api\Admin\ContentController;
use App\Http\Controllers\Api\Admin\CouponController;
use App\Http\Controllers\Api\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\PropertyController;
use App\Http\Controllers\Api\Admin\SizeController;
use App\Http\Controllers\Api\Admin\TagController as AdminTagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Frontend\HomeController;
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
Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm']);
    //Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    //Route::middleware(['auth:admin'])->group(function () {
        Route::get('register', [AuthController::class, 'showRegisterForm']);
        //Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('register');
        //Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');
        Route::resource('dashboard', AdminHomeController::class)->names(['index' => 'dashboard']);
        /**
         * Category
         */
        Route::resource('categories', CategoryController::class)->names(['index' => 'categories']);
        /**
         * Brand
         */
        Route::apiResource('brands', BrandController::class)->names(['index' => 'brands']);
        /**
         * Product
         */
        Route::resource('products', ProductController::class)->names(['index' => 'products']);
        /**
         * Product property
         */
        Route::apiResource('properties', PropertyController::class)->except(['index']);
        /**
         * Color
         */
        Route::apiResource('colors', ColorController::class)->names(['index' => 'colors']);
        /**
         * Size
         */
        Route::apiResource('sizes', SizeController::class)->names(['index' => 'sizes']);
        /**
         * Tag
         */
        Route::apiResource('tags', AdminTagController::class)->names(['index' => 'tags']);
        /**
         * Coupon
         */
        Route::apiResource('coupons', CouponController::class)->names(['index' => 'coupons']);
        /**
         * Content Category
         */
        Route::apiResource('content/categories', ContentCategoryController::class)->names(['index' => 'content.categories']);
        /**
         * Content Post
         */
        Route::resource('content/posts', ContentController::class)->names(['index' => 'content.posts']);
        /**
         * Content Comment
         */
        Route::apiResource('content/comments', ContentCommentController::class)->names(['index' => 'content.comments']);
        /**
         * Banner
         */
        Route::apiResource('banners', BannerController::class)->names(['index' => 'banners']);
        /**
         * Order
         */
        Route::apiResource('orders', OrderController::class)->except('store')->names(['index' => 'orders']);
        /**
         * Home
         */
        Route::resource('/dashboard', AdminHomeController::class)->names(['index' => 'dashboard']);
        /**
         * Admin Feature
         */
        Route::get('getSlugs', [AdminController::class, 'getSlug'])->name('getSlugs');
        Route::get('newsletters', [AdminController::class, 'getNewsletter'])->name('newsletters');
        Route::delete('newsletters', [AdminController::class, 'deleteNewsletter']);
        Route::get('contacts', [AdminController::class, 'getContact'])->name('contacts');
        Route::get('feedbacks', [AdminController::class, 'getFeedback'])->name('feedbacks');
        /**
         *  Media
         */
        Route::get('media', function () {
            return view('admin.content.media.index');
        })->name('medias');
    //});
});
