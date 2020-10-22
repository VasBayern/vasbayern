<?php

namespace App\Providers;

use App\Models\WishListModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $categories = DB::table('shop_categories')->select('id', 'name', 'slug', 'parent_id')->get();
        // $parents = [];
        // foreach ($categories as $category) {
        //     if (array_key_exists($category->parent_id, $parents)) {
        //         $parents[$category->parent_id]['childCategory'][] = [
        //             'id'    => $category->id,
        //             'name'  => $category->name,
        //             'slug'  => $category->slug,
        //         ];
        //     }
        //     continue;
        //     $parents[$category->parent_id] = [
        //         'id'    => $category->id,
        //         'name'  => $category->name,
        //         'slug'  => $category->slug,
        //         'childCategory' => [
        //             [
        //                 'id'    => $category->id,
        //                 'name'  => $category->name,
        //                 'slug'  => $category->slug,
        //             ]
        //         ],
        //     ];
        // }
        // dd($parents);
        // $wishlists = WishListModel::where('user_id', Auth::id())->get();
        // $data = array();
        // $data['count_wishlist'] = count($wishlists);
        // $data['wishlists'] = $wishlists;
        //View::share($data);
        //dd($data);


    }
}
