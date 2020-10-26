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
use Illuminate\Support\Facades\DB;

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

    public function filter(Request $request)
    {
        $input = $request->dataPost;

        $sql = 'SELECT
        A.id, A.name, A.slug, A.images, A.priceCore, A.priceSale,
        B.name AS cat_name,
        C.id AS brand_id,
        E.id as size_id, E.name AS size_name,
        F.id as color_id, F.name AS color_name, F.color AS color
        FROM shop_products AS A
        JOIN shop_categories AS B ON A.cat_id = B.id
        JOIN shop_brands AS C ON A.brand_id = C.id
        JOIN product_properties AS D ON A.id = D.product_id
        JOIN sizes AS E ON D.size_id = E.id
        JOIN colors AS F ON D.color_id = F.id
        WHERE 1=1 AND ';

        if (isset($input)) {
            foreach ($input as $key => $value) {
                switch ($key) {
                    case 0:
                        foreach ($value as $brandID) {
                            $sql .= ' brand_id = ' . $brandID . ' OR ';
                        }
                        break;
                    case 1:
                        foreach ($value as $sizeID) {
                            $sql .= ' size_id = ' . $sizeID . ' OR ';
                        }
                        break;
                    case 2:
                        foreach ($value as $colorID) {
                            $sql .= ' size_id = ' . $colorID . ' OR ';
                        }
                        break;
                    default:
                        $sql .= ' 2 = 2';
                        break;
                }
            }
        }
        $exec = DB::select($sql);
        $filterProduct = [];
        foreach ($exec as $row) {
            $images = json_decode($row->images);
            foreach ($images as $image) {
                $image = $images[0];
            }
            $filterProduct = [
                'name'      => $row->name,
                'slug'      => $row->slug,
                'image'     => $image,
                'priceCore' => $row->priceCore,
                'priceSale' => $row->priceSale,
                'cat_name'  => $row->cat_name,
            ];
        }
        $response = array_values($filterProduct);
        return response($response);
    }
}
