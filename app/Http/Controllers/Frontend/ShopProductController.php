<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\CommentModel;
use App\Models\ShopProductModel;
use App\Models\WishListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ShopProductController extends Controller
{
    public function index($slug) {
        $data = array();
        $product = ShopProductModel::where('slug', $slug)->first();
        $data['product'] =$product;
        $id = $product->id;
        $cat_id = $product->cat_id;
        $related_products = ShopProductModel::where('cat_id', $cat_id)->where('id','<>',$id)->take(4)->get();
        $data['related_products'] = $related_products;

        $cmt = CommentModel::where('product_id', $id)->get();
        $data['comments'] = $cmt;
        $count_cmt = CommentModel::where('product_id', $id)->count();
        $data['count_cmt'] = $count_cmt;

        //$stockProduct = DB::select('SELECT quantity FROM product_properties WHERE product_id ='.$id);
        
        $wishlist = WishListModel::where('user_id', Auth::id())->where('product_id', $id)->get();
        $count_wishlist = count($wishlist);
        $data['count_wishlist'] = $count_wishlist;

        return view('frontend.shop.product', $data);
    }

    public function comment(Request $request, $id) {
        $validatedData = $request->validate([
            'review' => 'required',
        ],[
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
