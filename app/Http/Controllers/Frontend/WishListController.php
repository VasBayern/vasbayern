<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShopProductModel;
use App\Models\WishListModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishListController extends Controller
{
    public function index() {
        $data = array();
        $user_id = Auth::id();
        $wishlists = DB::table('wishlist')->join('users', 'user_id', '=', 'users.id')
            ->join('shop_products', 'product_id', '=', 'shop_products.id')
            ->select('wishlist.id', 'wishlist.product_id', 'shop_products.name', 'shop_products.images', 'shop_products.priceCore', 'shop_products.priceSale')
            ->where('users.id', '=', $user_id)
            ->paginate(10);
        $data['wishlists'] = $wishlists;

        return view('frontend.user.wishlist', $data);
    }

    public function update($product_id, Request  $request) {
        if ($request->ajax()) {
            $product = ShopProductModel::find($product_id);
            if (!$product) {
                return response(['msg' => 'not exist']);
            }
            /*$msg = 'success';
            try {
                DB::table('wishlist')->insert([
                    'product_id' => $product_id,
                    'user_id' => Auth::id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

            } catch (\Exception $e) {
                $msg = 'error';
            }
            return response(['msg' => $msg]);*/
            $wishlist = WishListModel::where('user_id', Auth::id())->where('product_id', $product_id)->get();
            if (count($wishlist) != 0) {
                return response(['msg' => 'error']);
            } else {
                DB::table('wishlist')->insert([
                    'product_id' => $product_id,
                    'user_id' => Auth::id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return response(['msg' => 'success']);
            }
        }
    }

    public function destroy($id) {
        $item = WishListModel::find($id);
        $item->delete();
        \Toastr::success('Xóa thành công');
        return redirect()->back();
    }
}
