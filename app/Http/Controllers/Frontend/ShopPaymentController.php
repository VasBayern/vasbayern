<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderProduct;
use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\Models\ShopOrderDetailModel;
use App\Models\ShopOrderModel;
use App\Models\ShopProductModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopPaymentController extends Controller
{
    public function index()
    {
        $data = array();
        $user_id = Auth::id();
        //thông tin địa chỉ giao hàng
        $customer_default = CustomerModel::where([
            ['user_id', $user_id],
            ['default', 1],
        ])->first();
        $data['customer_default'] = $customer_default;

        $customer = CustomerModel::where([
            ['user_id', $user_id],
            ['default', 0],
        ])->first();
        $data['customer'] = $customer;

        //sp trong cart
        $cartCollection = \Cart::getContent();
        $data['cart_products'] = $cartCollection;
 
        //chi tiết sp
        $products = array();
        foreach ($cartCollection as $item) {
            $product_id = $item->id;
            $products[$product_id] = ShopProductModel::find($product_id);
        }
        $data['products'] = $products;

        //check mã giảm
        if (session()->has('coupon')) {
            $coupon = session()->get('coupon');
            $data['coupon'] = $coupon;
        }

        //ngày tháng
        $tomorrow = Carbon::tomorrow('Asia/Ho_Chi_Minh')->dayOfWeek;
        $day_tomorrow = Carbon::tomorrow('Asia/Ho_Chi_Minh')->day;
        $month_tomorrow = Carbon::tomorrow('Asia/Ho_Chi_Minh')->month;

        $nextday = Carbon::now('Asia/Ho_Chi_Minh')->addDay(3)->dayOfWeek;
        $day_nextday = Carbon::now('Asia/Ho_Chi_Minh')->addDay(3)->day;
        $month_nextday = Carbon::now('Asia/Ho_Chi_Minh')->addDay(3)->month;

        $dayofWeek = [
            0 => 'Chủ Nhật',
            1 => 'Thứ Hai',
            2 => 'Thứ Ba',
            3 => 'Thứ Tư',
            4 => 'Thứ Năm',
            5 => 'Thứ Sáu',
            6 => 'Thứ Bảy'
        ];
        $weekday = $dayofWeek[$tomorrow];
        $data['tomorrow'] = $weekday;
        $data['day_tomorrow'] = $day_tomorrow;
        $data['month_tomorrow'] = $month_tomorrow;

        $weekday_2 = $dayofWeek[$nextday];
        $data['nextday'] = $weekday_2;
        $data['day_nextday'] = $day_nextday;
        $data['month_nextday'] = $month_nextday;

        $data['sub_total'] = \Cart::getSubTotal();
        $data['total_quantity'] = \Cart::getTotalQuantity();

        return view('frontend.shop.payment', $data);
    }

    public function chooseShip(Request $request)
    {
        /*  $data = array();
        $input = $request->all();
        echo $ship_price = (double) $input['ship_price'];*/
    }

    public function order(Request $request)
    {
        $input = $request->all();
        if (!isset($input['name'])) {
            \Toastr::error('Chưa có địa chỉ nhận hàng');
            return redirect()->back();
        }
        $order                  = new ShopOrderModel();
        $order->user_id         = Auth::id();
        $order->name            = $input['name'];
        $order->phone           = $input['phone'];
        $order->address         = $input['address'];
        $order->note            = $input['note'];
        $order->sub_total       = (int)$input['sub_total'];
        $order->ship_price      = (int)$input['ship_price'];
        $order->promotion       = (int)$input['promotion'];
        $order->total           = (int)$input['total_price'];
        $order->payment_method  = $input['payment'];
        $order->status          = 1;
        $order->shipment        = 0;
        $order->save();

        $detail = \Cart::getContent();
        foreach ($detail as $product) {
            $order_detail               = new ShopOrderDetailModel();
            $order_detail->order_id     = $order->id;
            $order_detail->product_id   = $product->id;
            $order_detail->quantity     = $product->quantity;
            $order_detail->unit_price   = $product->price;
            $order_detail->total_price  = $product->price * $product->quantity;
            $order_detail->size_id       = 1;
            $order_detail->save();
        }
        event(new OrderProduct($order, $detail));
        \Cart::clear();
        \Toastr::success('Vui lòng kiểm tra email!', 'Mua hàng thành công', ["timeOut" => "6000",]);
        return redirect()->route('cart');
    }
}
