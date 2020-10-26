<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShopBrandModel;
use App\Models\ShopCategoryModel;
use App\Models\ShopColorModel;
use App\Models\ShopProductModel;
use App\Models\ShopSizeModel;
use App\Models\WishListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopCategoryController extends Controller
{
    public function index($slug)
    {
        $data = array();

        $category = ShopCategoryModel::where('slug', $slug)->first();
        $data['category'] = $category;

        $products = ShopProductModel::where('cat_id', $category->id)->paginate(6);
        $data['products'] = $products;

        $categories = ShopCategoryModel::all();
        $data['categories'] = $categories;

        $brands = ShopBrandModel::all();
        $data['brands'] = $brands;

        $sizes = ShopSizeModel::all();
        $data['sizes'] = $sizes;

        $colors = ShopColorModel::all();
        $data['colors'] = $colors;

        return view('frontend.shop.category', $data);
    }
}
