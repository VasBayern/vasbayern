<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommentContactModel;
use App\Models\NewsletterModel;
use App\Models\ShopBrandModel;
use App\Models\ShopCategoryModel;
use App\Models\ShopProductModel;
use App\Models\ShopSizeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function getFaq() {
        return view('frontend.content.faq');
    }

    public function getContact() {
        return view('frontend.content.contact');
    }

    public function comment(Request $request) {
        $validatedData = $request->validate([
            'comment' => 'required',
            'email' => 'required|email'
        ],[
            'comment.required' => 'Bạn chưa bình luận',
        ]);

        $input = $request->all();
        $item = new CommentContactModel();

        $item->name = $input['name'];
        $item->email = $input['email'];
        $item->comment = $input['comment'];
        $item->status = 0;
        $item->save();

        \Toastr::success('Vui lòng chờ email phản hồi','Gửi thành công' );
        return redirect()->back();
    }

    public function followBlog(Request $request) {
        $email = $request->email;
        if(NewsletterModel::where('email', '=', $email)->exists()) {
            \Toastr::error('Vui lòng nhập email khác','Email này đã được đăng ký' );
        } else {
            $item = new NewsletterModel();
            $item->email = $email;
            $item->save();
            \Toastr::success('Hệ thống sẽ gửi tin mới nhất qua email của bạn','Đăng kí thành công' );
        }
        return redirect()->back();
    }

    public function searchAuto(Request $request) {
        $products = DB::table('shop_products')->select('name')->get()->toArray();
        return response($products);
    }

    public function searchProduct(Request $request) {
        $products = ShopProductModel::where('name', 'like', '%'.$request->name.'%')->get();
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
}
