<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShopProductModel;
use App\Models\WishListModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishListController extends Controller
{
    public function index()
    {
        $data = array();
        $user_id = Auth::id();
        $wishlists = DB::table('wishlist')->join('users', 'user_id', '=', 'users.id')
            ->join('shop_products', 'product_id', '=', 'shop_products.id')
            ->select('wishlist.id', 'wishlist.product_id', 'shop_products.name', 'shop_products.slug', 'shop_products.images', 'shop_products.priceCore', 'shop_products.priceSale')
            ->where('users.id', '=', $user_id)
            ->get();
        $data['wishlists'] = $wishlists;

        return view('frontend.user.wishlist', $data);
    }

    public function add($id, Request  $request)
    {
        if ($request->ajax()) {
            $product = ShopProductModel::find($id);
            DB::beginTransaction();
            try {
                if (!$product) {
                    $response = ['msg' => 'product not exist'];
                }
                if (!Auth::check()) {
                    $response = ['msg' => 'user not exist'];
                }
                $wishlist = WishListModel::where('user_id', Auth::id())->where('product_id', $id)->get();
                if (count($wishlist) != 0) {
                    $response = ['msg' => 'wishlist exist'];
                } else {
                    $wishlistID = DB::table('wishlist')->max('id');
                    $nextWishListID = $wishlistID + 1;
                    DB::table('wishlist')->insert([
                        'id'        => $nextWishListID,
                        'product_id'=> $id,
                        'user_id'   => Auth::id(),
                        'created_at'=> Carbon::now(),
                        'updated_at'=> Carbon::now(),
                    ]);
                    $response = [
                        'msg'           => 'success',
                        'id'            => $nextWishListID,
                        'name'          => $product->name,
                        'image'         => json_decode($product->images)[0],
                        'sale'          => $product->priceSale,
                        'priceCore'     => number_format($product->priceCore).' VNĐ',
                        'priceSale'     => number_format($product->priceSale).' VNĐ',
                        'linkWishlist'  => url('wishlists/'.$nextWishListID),
                        'linkProduct'   => url('products/'.$product->slug),
                    ];
                    DB::commit();
                }
            } catch (Exception $e) {
                DB::rollBack();
            }
            return response($response);
        }
    }

    public function destroy($id)
    {
        $item = WishListModel::find($id);
        $item->delete();
        $countWishlist = count(WishListModel::where('user_id', Auth::id())->get());
        $response = [
            'msg'           => 'success',
            'id'            => $id,
            'countWishlist' => $countWishlist,
        ];
        return response($response);
    }
}
