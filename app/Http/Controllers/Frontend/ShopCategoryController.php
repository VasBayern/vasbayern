<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShopBrandModel;
use App\Models\ShopCategoryModel;
use App\Models\ShopColorModel;
use App\Models\ShopProductModel;
use App\Models\ShopSizeModel;
use App\Models\TagModel;
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

        $categories = ShopCategoryModel::where('parent_id', '!=', '0')->get();
        $data['categories'] = $categories;

        $brands = ShopBrandModel::all();
        $data['brands'] = $brands;

        $sizes = ShopSizeModel::all();
        $data['sizes'] = $sizes;

        $colors = ShopColorModel::all();
        $data['colors'] = $colors;

        $tags = TagModel::where('tag_type', 1)->get();
        $data['tags'] = $tags;

        return view('frontend.shop.category', $data);
    }

    public function filter(Request $request)
    {
        $input = $request->dataPost;

        $sql = 'SELECT
        MAX(A.id) AS id, MAX(A.name) AS name, MAX(A.slug) AS slug, MAX(A.images) AS images, MAX(A.priceCore) AS priceCore,
        MAX(A.priceSale) AS priceSale, MAX(A.new) AS new,
        MAX(B.id) AS cat_id, MAX(B.name) AS cat_name,
        MAX(C.id) AS brand_id,
        MAX(E.id) as size_id, MAX(E.name) AS size_name,
        MAX(F.id) as color_id, MAX(F.name) AS color_name, MAX(F.color) AS color
        -- MAX(G.tag_id) AS tag_id
        
        FROM shop_products AS A
        JOIN shop_categories AS B ON A.cat_id = B.id
        JOIN shop_brands AS C ON A.brand_id = C.id
        JOIN product_properties AS D ON A.id = D.product_id
        JOIN sizes AS E ON D.size_id = E.id
        JOIN colors AS F ON D.color_id = F.id
        -- JOIN taggables AS G ON A.id = G.product_id
        -- JOIN tags AS H ON G.tag_id = H.id
        WHERE 1=1 ';

        if (isset($input)) {
            foreach ($input as $key => $value) {
                switch ($key) {
                    case 0:
                        $sql .= ' AND ';
                        foreach ($value as $key => $categoryID) {
                            if (!next($value)) {
                                $sql .= ' cat_id = ' . $categoryID;
                            } else {
                                $sql .= ' cat_id = ' . $categoryID . ' OR ';
                            }
                        }
                        break;
                    case 1:
                        $sql .= ' AND ';
                        foreach ($value as $key => $brandID) {
                            if (!next($value)) {
                                $sql .= ' brand_id = ' . $brandID;
                            } else {
                                $sql .= ' brand_id = ' . $brandID . ' OR ';
                            }
                        }
                        break;
                    case 2:
                        $sql .= ' AND ';
                        foreach ($value as $key => $sizeID) {
                            if (!next($value)) {
                                $sql .= ' size_id = ' . $sizeID;
                            } else {
                                $sql .= ' size_id = ' . $sizeID . ' OR ';
                            }
                        }
                        break;
                    case 3:
                        $sql .= ' AND ';
                        foreach ($value as $key => $colorID) {
                            if (!next($value)) {
                                $sql .= ' color_id = ' . $colorID;
                            } else {
                                $sql .= ' color_id = ' . $colorID . ' OR ';
                            }
                        }
                        break;
                    case 4:
                        $sql .= ' AND ';
                        foreach ($value as $key => $tagID) {
                            if (!next($value)) {
                                $sql .= ' tag_id = ' . $tagID;
                            } else {
                                $sql .= ' tag_id = ' . $tagID . ' OR ';
                            }
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        $sql .= ' GROUP BY A.updated_at';
        $exec = DB::select($sql);
        $filterProduct = [];
        foreach ($exec as $row) {
            $images = json_decode($row->images);
            $filter = [
                'id'        => $row->id,
                'name'      => $row->name,
                'link'      => url('products/' . $row->slug),
                'image'     => $images[0],
                'sale'      => $row->priceSale,
                'priceCore' => number_format($row->priceCore) . ' VNĐ',
                'priceSale' => number_format($row->priceSale) . ' VNĐ',
                'new'       => $row->new,
                'cat_name'  => $row->cat_name,
            ];
            array_push($filterProduct, $filter);
        }
        $response = array_values($filterProduct);
        return response($response);
    }
}
