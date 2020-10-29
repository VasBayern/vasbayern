<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommentContactModel;
use App\Models\NewsletterModel;
use App\Models\ShopBrandModel;
use App\Models\ShopCategoryModel;
use App\Models\ShopProductModel;
use App\Models\ShopSizeModel;
use App\Models\TagModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function getTag($slug)
    {
        $tag = TagModel::where('slug', $slug)->get();
        if ($tag['tag_type'] == 1) {
            $sql = DB::select('SELECT A.id, A.slug, A.name, A.priceCore, A.priceSale, A.new
            FROM shop_products AS A
            JOIN taggables AS B ON A.id = B.product_id
            JOIN tag AS C ON B.tag_id = C.id
            WHERE C.tag_type = 1 AND C.id = ' . $tag->id);
            return view('frontend.content.tag');
        } elseif ($tag['tag_type'] == 2) {
            $sql = DB::select('SELECT A.id, A.slug, A.name, A.priceCore, A.priceSale, A.new
            FROM shop_products AS A
            JOIN taggables AS B ON A.id = B.product_id
            JOIN tag AS C ON B.tag_id = C.id
            WHERE C.tag_type = 2 AND C.id = ' . $tag->id);
            return view('frontend.content.tag');
        }
    }
    public function getFaq()
    {
        return view('frontend.content.faq');
    }

    public function getContact()
    {
        return view('frontend.content.contact');
    }

    public function comment(Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required',
            'email' => 'required|email'
        ], [
            'comment.required' => 'Bạn chưa bình luận',
        ]);

        $input = $request->all();
        $item = new CommentContactModel();

        $item->name = $input['name'];
        $item->email = $input['email'];
        $item->comment = $input['comment'];
        $item->status = 0;
        $item->save();

        \Toastr::success('Vui lòng chờ email phản hồi', 'Gửi thành công');
        return redirect()->back();
    }

    public function followBlog(Request $request)
    {
        $email = $request->email;
        if (NewsletterModel::where('email', '=', $email)->exists()) {
            \Toastr::error('Vui lòng nhập email khác', 'Email này đã được đăng ký');
        } else {
            $item = new NewsletterModel();
            $item->email = $email;
            $item->save();
            \Toastr::success('Hệ thống sẽ gửi tin mới nhất qua email của bạn', 'Đăng kí thành công');
        }
        return redirect()->back();
    }

    public function searchAuto(Request $request)
    {
        $products = DB::table('shop_products')->select('name')->get()->toArray();
        return response($products);
    }

    public function searchProduct(Request $request)
    {
        $products = ShopProductModel::where('name', 'like', '%' . $request->name . '%')->get();
        $data = array();
        $data['products'] = $products;

        $categories = ShopCategoryModel::all();
        $data['categories'] = $categories;

        $brands = ShopBrandModel::all();
        $data['brands'] = $brands;

        $sizes = ShopSizeModel::all();
        $data['sizes'] = $sizes;

        return view('frontend.content.searchProduct', $data);
    }

    public function addToCart(Request $request)
    {
        $id = $request->id;
        $product = ShopProductModel::find($id);

        $sizes = DB::select('SELECT DISTINCT B.id AS size_id, B.name AS size_name
        FROM product_properties AS A
        JOIN sizes AS B ON A.size_id = B.id WHERE A.product_id = ' . $id . ' ORDER BY size_id');

        $sql = DB::select('SELECT B.id AS size_id, B.name AS size_name, C.id AS color_id, C.name AS color_name, C.color, A.quantity
        FROM product_properties AS A
        JOIN sizes AS B ON A.size_id = B.id
        JOIN colors AS C ON A.color_id = C.id
        JOIN shop_products AS D ON A.product_id = D.id
        WHERE D.id = ' . $id . ' ORDER BY color_id');
        $properties = [];
        foreach ($sql as $row) {
            if (array_key_exists($row->color_id, $properties)) {
                $properties[$row->color_id]['sizes'][$row->size_id] = [
                    'size_id'       => $row->size_id,
                    'size_name'     => $row->size_name,
                    'quantity'      => $row->quantity,
                ];
                continue;
            }
            $properties[$row->color_id] = [
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
        $response = [
            'product'       => $product,
            'sizes'         => $sizes,
            'properties'    => $properties,
        ];
        return response()->json(view('frontend.shop.quickView-modal', $response)->render());
    }
}
