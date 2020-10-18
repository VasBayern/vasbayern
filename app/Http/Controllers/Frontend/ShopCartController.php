<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShopCouponModel;
use App\Models\ShopProductModel;
use App\Models\ShopProductPropertiesModel;
use App\Models\ShopSizeModel;
use Illuminate\Http\Request;

class ShopCartController extends Controller
{
    public function index()
    {
        $data = array();
        $cartCollection = \Cart::getContent();
        $data['catProducts'] = $cartCollection;
        $products = array();
        foreach ($cartCollection as $product) {
            $product_id = $product->id;
            $products[$product_id] = ShopProductModel::find($product_id);
        }
        $data['products'] = $products;
        $data['subTotal'] = \Cart::getSubTotal();
        $data['totalQuantity'] = \Cart::getTotalQuantity();

        return view('frontend.shop.cart', $data);
    }

    public function add(Request $request)
    {
        $input = $request->all();
        $product_id = (int) $input['product_id'];
        $quantity = (int) $input['quantity'];
        $size_id =  $input['size_id'];
        $size = ShopSizeModel::find($size_id);
        $product  = ShopProductModel::find($product_id);

        if (isset($product->id)) {
            if ($product->priceSale > 0) {
                $price = $product->priceSale;
            } else {
                $price = $product->priceCore;
            }
            \Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'quantity' => $quantity,
                'attributes' => array(
                    'size_id' => $size->id,
                    'size_name' => $size->name,
                ),
            ));
            session()->save();
            
            $quantityCart = \Cart::getTotalQuantity();
            $total = \Cart::getSubTotal();
            $total = number_format($total) . ' VNĐ';
            $price = number_format($price) . ' VNĐ';
            $cartCollection = \Cart::getContent();

            $images = json_decode($product->images);
            $response = [
                'quantityCart'  => $quantityCart,
                'id'            => $product_id,
                'name'          => $product->name,
                'price'         => $price,
                'quantity'      => $quantity,
                'total'         => $total,
                'image'         => $images[0]
            ];
        }
        return response($response);
    }
    public function update(Request $request)
     {
        $input = $request->all();
        $product_id = (int) $input['product_id'];
        $quantity = (int) $input['quantity'];
        $product_price = (int) $input['product_price'];

        $product = ShopProductModel::find($product_id);
        \Cart::update($product->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $quantity,
            ),
        ));
        session()->save();

        $totalPrice = (float)$product_price * $quantity;
        $subTotal = \Cart::getSubTotal();

        if (session()->has('coupon')) {
            //remove all product
            if ($subTotal == 0) {
                $total = 0;
            } else {
                $coupon = session()->get('coupon');
                if ($coupon['type'] == 'percent') {
                    $discount =  $coupon['discount_percent'];
                    $total = $subTotal - ($subTotal * (float) $discount / 100);
                } elseif ($coupon['type'] == 'price') {
                    $discount =   $coupon['discount_price'];
                    $total = $subTotal - (float) $discount;
                }
            }
        } else {
            $total =  $subTotal;
        }

        $totalPrice = number_format($totalPrice) . ' VNĐ';
        $subTotal = number_format($subTotal) . ' VNĐ';
        $total = number_format($total) . ' VNĐ';
        $quantityCart = \Cart::getTotalQuantity();

        $response = [
            'id' => $product_id,
            'quantity' => $quantity,
            'quantityCart'  => $quantityCart,
            'totalPrice' => $totalPrice,
            'subTotal' => $subTotal,
            'total' => $total
        ];

        return response($response);
     }

    public function remove(Request $request)
    {
        $input = $request->all();
        $product_id = $input['product_id'];
        $product = ShopProductModel::find($product_id);

        if (isset($product_id)) {
            \Cart::remove($product->id);
            session()->save();
        }
        $subTotal = \Cart::getSubTotal();
        $quantityCart = \Cart::getTotalQuantity();

        /**
         * Coupon
         */
        $total = 0;
        if (session()->has('coupon')) {
            //remove all product
            if ($subTotal == 0) {
                $total = 0;
                session()->forget('coupon');
            } else {
                $coupon = session()->get('coupon');
                if ($coupon['type'] == 'percent') {
                    $discount =  $coupon['discount_percent'];
                    $total = $subTotal - ($subTotal * (float) $discount / 100);
                } elseif ($coupon['type'] == 'price') {
                    $discount =   $coupon['discount_price'];
                    $total = $subTotal - (float) $discount;
                }
            }
        } else {
            $total =  $subTotal;
        }
        $subTotal = number_format($subTotal) . ' VNĐ';
        $total = number_format($total) . ' VNĐ';

        $response = [
            'id' => $product_id,
            'subTotal' => $subTotal,
            'quantityCart' => $quantityCart,
            'total' => $total
        ];
        return response($response);
    }

    public function clear()
    {
        \Cart::clear();
        session()->forget('coupon');
        session()->save();

        $response = ['msg' => 'success'];
        return response($response);
    }

    public function addCoupon(Request $request)
    {
        $input = $request->all();
        $coupon = ShopCouponModel::where('code', $input['code'])->first();
        if (!$coupon) {
            $response = ['msg' => 'error'];
            return response($response);
        } else {
            session()->put('coupon', [
                'name' => $coupon->code,
                'type' => $coupon->type,
                'discount_price' => $coupon->value,
                'discount_percent' => $coupon->percent_off,
            ]);

            $sub_total = \Cart::getSubTotal();
            $total = 0;
            $coupon = session()->get('coupon');
            if ($coupon['type'] == 'percent') {
                $discount =  $coupon['discount_percent'];
                $couponValue =  '- ' . number_format($discount) . ' %';
                $total = $sub_total - ($sub_total * (float) $discount / 100);
            } elseif ($coupon['type'] == 'price') {
                $discount =   $coupon['discount_price'];
                $couponValue =  '- ' . number_format($discount) . ' VNĐ';
                $total = $sub_total - (float) $discount;
            }
            if ($sub_total == 0) {
                $total = 0;
            }
            $total = number_format($total) . ' VNĐ';

            $response = [
                'msg' => 'success',
                'couponName' => $input['code'],
                'couponType' => $coupon['type'],
                'couponValue'   => $couponValue,
                'totalPrice' => $total
            ];
            return response($response);
        }
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('coupon');
        $sub_total = \Cart::getSubTotal();
        if ($sub_total == 0) {
            $total = 0;
        } else {
            $total = $sub_total;
        }
        $total = number_format($total) . ' VNĐ';
        $response = [
            'msg'      => 'success',
            'total' => $total,
        ];
        return response($response);
    }
}
