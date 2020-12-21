<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ShopBannerController;
use App\Http\Controllers\Admin\ShopBrandController;
use App\Http\Controllers\Admin\ShopCategoryController;
use App\Http\Controllers\Admin\ShopColorController;
use App\Http\Controllers\Admin\ShopCouponController;
use App\Http\Controllers\Admin\ShopOrderController;
use App\Http\Controllers\Admin\ShopProductController;
use App\Http\Controllers\Admin\ShopSizeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TagProductController;
use App\Http\Controllers\Auth\LoginAssociationController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ShopCartController;
use App\Http\Controllers\Frontend\ShopCategoryController as FrontendShopCategoryController;
use App\Http\Controllers\Frontend\ShopPaymentController;
use App\Http\Controllers\Frontend\ShopProductController as FrontendShopProductController;
use App\Http\Controllers\Frontend\WishListController;
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

// Route::get('/', function () {
//     return view('frontend.dashboard');
// });
Route::get('/', [FrontendHomeController::class, 'index'])->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('frontend.dashboard');
// })->name('dashboard');

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware(['auth'])->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/dashboard');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (HttpRequest $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('status', 'verification-link-sent');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
/**
 * Category
 */
Route::get('categories/{slug}', [FrontendShopCategoryController::class, 'index']);
Route::get('categories?tag={slug}', [FrontendShopCategoryController::class, 'index']);
Route::get('categories', [FrontendShopCategoryController::class, 'filter']);

/**
 *  Product
 */
Route::get('products/{slug}', [FrontendShopProductController::class, 'index']);
Route::post('products/{slug}/comment', [FrontendShopProductController::class, 'comment']);

/**
 *  Cart
 */
Route::get('cart', [ShopCartController::class, 'index'])->name('cart');
Route::post('cart', [ShopCartController::class, 'add']);
Route::put('cart', [ShopCartController::class, 'update']);
Route::delete('cart', [ShopCartController::class, 'remove']);
Route::delete('cart/clear', [ShopCartController::class, 'clear']);
Route::post('cart/coupon', [ShopCartController::class, 'addCoupon']);
Route::delete('cart/coupon', [ShopCartController::class, 'removeCoupon']);
/**
 *  Payment
 */
Route::get('payment', [ShopPaymentController::class, 'index'])->name('payment');
Route::post('payment', [ShopPaymentController::class, 'order']);
Route::post('payment/ship', [ShopPaymentController::class, 'chooseShip']);
/**
 *  Blog
 */
Route::get('blogs', [BlogController::class, 'index'])->name('blog');
Route::post('blogs', [BlogController::class, 'filter']);
Route::get('blogs/post/{slug}', [BlogController::class, 'getBlogPost']);
Route::post('blogs/comment', [BlogController::class, 'commentBlog']);
Route::post('blogs/searchAuto', [BlogController::class, 'searchByName']);
Route::post('blogs/search', [BlogController::class, 'search']);

/**
 *  User
 */
Route::get('user/profile', [CustomerController::class, 'index'])->name('user.profile');
Route::post('user/profile', [CustomerController::class, 'updateProfile']);
Route::get('user/address', [CustomerController::class, 'editAddress'])->name('user.address');
Route::post('user/address', [CustomerController::class, 'storeAddress']);
Route::put('user/address/{id}', [CustomerController::class, 'updateAddress']);
Route::delete('user/address/{id}', [CustomerController::class, 'deleteAddress']);
Route::get('user/order', [CustomerController::class, 'getOrderDetail'])->name('user.order');


/**
 *  WishList
 */
Route::get('wishlists', [WishListController::class, 'index'])->name('wishlist');
Route::post('wishlists/{id}', [WishListController::class, 'add']);
Route::delete('wishlists/{id}', [WishListController::class, 'destroy']);

/**
 *  Page
 */
Route::get('tag/{slug}', [PageController::class, 'getTag'])->name('tag');
Route::get('faq', [PageController::class, 'getFaq'])->name('faq');
Route::get('contact', [PageController::class, 'getContact'])->name('contact');
Route::post('comment', [PageController::class, 'comment'])->name('comment');
Route::post('followBlog', [PageController::class, 'followBlog'])->name('followBlog');
Route::post('searchAuto', [PageController::class, 'searchAuto'])->name('searchProduct');
Route::post('search', [PageController::class, 'searchProduct']);
Route::post('addToCart', [PageController::class, 'addToCart']);

/**
 * Associate
 */
// Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->where('provider','twitter|facebook|linkedin|google|github');;
// Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->where('provider','twitter|facebook|linkedin|google|github');;
//Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')->name('login.provider')->where('driver', implode('|', config('auth.socialite.drivers')));
Route::get('/redirect', [LoginAssociationController::class, 'redirectToProvider']);
Route::get('/callback', [LoginAssociationController::class, 'handleProviderCallback']);

