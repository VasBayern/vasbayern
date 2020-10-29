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
Route::get('/', [FrontendHomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('frontend.dashboard');
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
 * Category
 */
Route::get('categories/{slug}', [FrontendShopCategoryController::class, 'index'] );
Route::get('categories?tag={slug}', [FrontendShopCategoryController::class, 'index'] );
Route::post('categories', [FrontendShopCategoryController::class, 'filter'] );

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
Route::get('blogs/category/{slug}', [BlogController::class, 'getBlogCategory']);
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

/**
 * -----------------------------------ADMIN-----------------------------------
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthLoginController::class, 'showLoginForm']);
    Route::post('login', [AuthLoginController::class, 'login'])->name('login');

    Route::middleware(['auth:admin', ])->group(function () {
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
         * Color
         */
        Route::get('colors', [ShopColorController::class, 'index'])->name('color');
        Route::post('colors', [ShopColorController::class, 'store']);
        Route::put('colors/{id}', [ShopColorController::class, 'update']);
        Route::delete('colors/{id}', [ShopColorController::class, 'destroy']);
        
        /**
         * Shop Product
         */
        Route::get('products/list', [ShopProductController::class, 'index'])->name('product');
        Route::get('products', [ShopProductController::class, 'create']);
        Route::get('products/{slug}', [ShopProductController::class, 'edit']);
        Route::post('products', [ShopProductController::class, 'store']);
        Route::put('products/{slug}', [ShopProductController::class, 'update']);
        Route::delete('products/{slug}', [ShopProductController::class, 'destroy']);

        Route::post('products/{slug}/properties',  [ShopProductController::class, 'storeProperties']);
        Route::put('products/{slug}/properties/{id}', [ShopProductController::class, 'updateProperties']);
        Route::delete('products/{slug}/properties/{id}',  [ShopProductController::class, 'destroyProperties']);

        //Route::view('/product/{id}/properties', 'admin.content.shop.product.edit');
        /**
         * Shop Coupon
         */
        Route::get('coupon',  [ShopCouponController::class, 'index'])->name('coupon');
        Route::post('coupon',  [ShopCouponController::class, 'store']);
        Route::put('coupon/{id}',  [ShopCouponController::class, 'update']);
        Route::delete('coupon/{id}',  [ShopCouponController::class, 'destroy']);

        /**
         * Shop Order
         */
        Route::get('orders',  [ShopOrderController::class, 'index'])->name('orders');
        Route::post('orders/view',  [ShopOrderController::class, 'viewDetail']);
        Route::put('orders/{id}',  [ShopOrderController::class, 'update']);
        Route::delete('orders/{id}',  [ShopOrderController::class, 'destroy']);

        /**
         * Tags
         */
        Route::get('tags', [TagController::class, 'index'])->name('tag');
        Route::post('tags', [TagController::class, 'store']);
        Route::put('tags/{id}', [TagController::class, 'update']);
        Route::delete('tags/{id}', [TagController::class, 'destroy']);

        Route::prefix('blog')->name('blog.')->group(function () {
            /**
             * Blog Category
             */
            Route::get('categories', [BlogCategoryController::class, 'index'])->name('category');
            Route::post('categories', [BlogCategoryController::class, 'store']);
            Route::put('categories/{slug}', [BlogCategoryController::class, 'update']);
            Route::delete('categories/{slug}', [BlogCategoryController::class, 'destroy']);

            /**
             * Blog Post
             */
            Route::get('posts/list', [BlogPostController::class, 'index'])->name('post');
            Route::get('posts', [BlogPostController::class, 'create']);
            Route::get('posts/{slug}', [BlogPostController::class, 'edit']);
            Route::post('posts', [BlogPostController::class, 'store']);
            Route::put('posts/{slug}', [BlogPostController::class, 'update']);
            Route::delete('posts/{slug}', [BlogPostController::class, 'destroy']);

            /**
             * Blog Comment
             */
            Route::get('comments', [BlogCategoryController::class, 'index'])->name('comment');
        });

        /**
         *  Media
         */
        Route::get('media', function () {
            return view('admin.content.media.index');
        });

        /**
         *  Banner
         */
        Route::get('banners/list', [ShopBannerController::class, 'index'])->name('banners');
        Route::get('banners', [ShopBannerController::class, 'create']);
        Route::get('banners/{slug}', [ShopBannerController::class, 'edit']);
        Route::post('banners', [ShopBannerController::class, 'store']);
        Route::put('banners/{slug}', [ShopBannerController::class, 'update']);
        Route::delete('banners/{slug}', [ShopBannerController::class, 'destroy']);

        /**
         * Admin Other Function
         */
        Route::get('getSlugs', [AdminController::class, 'getSlug'])->name('getSlugs');
        Route::get('newsletters', [AdminController::class, 'getNewsletter'])->name('newsletters');
        Route::delete('newsletters', [AdminController::class, 'deleteNewsletter']);
        Route::get('contacts', [AdminController::class, 'getContact'])->name('contacts');
        Route::get('feedbacks', [AdminController::class, 'getFeedback'])->name('feedbacks');
    });
});
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });
