<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPostModel;
use App\Models\ShopBannerModel;
use App\Models\ShopCategoryModel;
use App\Models\ShopProductModel;
use App\Models\ShopSizeModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $data = array();

        $parent_categories = ShopCategoryModel::where('parent_id', 0)->take(3)->get();
        $data['parent_categories'] = $parent_categories;
        $parent_1_categories = ShopCategoryModel::where('parent_id',1)->where('homepage',1)->limit(3)->get();
        $data['parent_1_categories'] = $parent_1_categories;
        $parent_2_categories = ShopCategoryModel::where('parent_id',2)->where('homepage',1)->limit(4)->get();
        $data['parent_2_categories'] = $parent_2_categories;
        $parent_3_categories = ShopCategoryModel::where('parent_id',3)->where('homepage',1)->limit(3)->get();
        $data['parent_3_categories'] = $parent_3_categories;

        // $product_special = ShopProductModel::where('homepage',1)->inRandomOrder()->take(2)->get();
        // $data['product_special'] = $product_special;

        $data['banner_mains'] = $banner_mains = ShopBannerModel::getBannerByLocation(1);
        $data['banner_sale_1'] = $banner_sale_1 = ShopBannerModel::getBannerByLocation(2);
        $data['banner_sale_2'] = $banner_sale_2 = ShopBannerModel::getBannerByLocation(3);
        $data['benefit_items'] = $benefit_items = ShopBannerModel::getBannerByLocation(4);

        $blogs = BlogPostModel::orderBy('created_at', 'desc')->take(3)->get();
        $data['blogs'] = $blogs;
        
        $sizes = ShopSizeModel::all();
        $data['sizes']=$sizes;

        return view('frontend.dashboard',$data);
    }
}
