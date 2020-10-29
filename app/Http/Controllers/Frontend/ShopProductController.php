<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommentModel;
use App\Models\ShopProductModel;
use App\Models\ShopSizeModel;
use App\Models\WishListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopProductController extends Controller
{
    public function index($slug)
    {
        $data = array();
        $product = ShopProductModel::where('slug', $slug)->first();
        $data['product'] = $product;

        $sizes = DB::select('SELECT DISTINCT B.id AS size_id, B.name AS size_name
        FROM product_properties AS A
        JOIN sizes AS B ON A.size_id = B.id WHERE A.product_id = ' . $product->id . ' ORDER BY size_id');
        $data['sizes'] = $sizes;

        $sql = DB::select('SELECT B.id AS size_id, B.name AS size_name, C.id AS color_id, C.name AS color_name, C.color, A.quantity
        FROM product_properties AS A
        JOIN sizes AS B ON A.size_id = B.id
        JOIN colors AS C ON A.color_id = C.id
        JOIN shop_products AS D ON A.product_id = D.id
        WHERE D.id = ' . $product->id . ' ORDER BY color_id');
        $property = [];
        foreach ($sql as $row) {
            if (array_key_exists($row->color_id, $property)) {
                $property[$row->color_id]['sizes'][$row->size_id] = [
                    'size_id'       => $row->size_id,
                    'size_name'     => $row->size_name,
                    'quantity'      => $row->quantity,
                ];
                continue;
            }
            $property[$row->color_id] = [
                'color_id'      => $row->color_id,
                'color_name'    => $row->color_name,
                'color'         => $row->color,
                'sizes'         => [
                    $row->size_id   => [
                        'size_id'       => $row->size_id,
                        'size_name'     => $row->size_name,
                        'quantity'      => $row->quantity,
                    ]
                ],
            ];
        }
        $data['properties'] = $property;

        $id = $product->id;
        $cat_id = $product->cat_id;
        $related_products = ShopProductModel::where('cat_id', $cat_id)->where('id', '<>', $id)->inRandomOrder()->take(4)->get();
        $data['related_products'] = $related_products;

        $cmt = CommentModel::where('product_id', $id)->get();
        $data['comments'] = $cmt;
        $count_cmt = CommentModel::where('product_id', $id)->count();
        $data['count_cmt'] = $count_cmt;

        //$stockProduct = DB::select('SELECT quantity FROM product_properties WHERE product_id ='.$id);

        $wishlist = WishListModel::where('user_id', Auth::id())->where('product_id', $id)->get();
        $count_wishlist = count($wishlist);
        $data['count_wishlist'] = $count_wishlist;

        $sql = DB::select('SELECT A.id, A.slug
        FROM tags AS A
        JOIN taggables AS B ON A.id = B.tag_id
        JOIN shop_products AS C ON B.product_id = C.id
        WHERE A.tag_type = 1 AND C.id = ' . $product->id);
        $data['tags'] = $sql;
    
        return view('frontend.shop.product', $data);
    }

    public function comment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'review' => 'required',
        ], [
            'review.required' => 'Bạn chưa đánh giá',
        ]);

        $input = $request->all();
        $item = new CommentModel();

        $item->user_id = \Auth::id();
        $item->product_id = $input['product_id'];
        $item->review = $input['review'];
        $item->rate = isset($input['rate']) ? $input['rate'] : 0;
        $item->save();

        \Toastr::success('Bình luận thành công');
        return redirect()->back();
    }
}
