<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopCouponModel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ShopCouponController extends Controller
{
    public function index() {

        $coupons = ShopCouponModel::all();
        $data = array();
        $data['coupons'] = $coupons;

        return view('admin.content.shop.coupon.index', $data);
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'code' => 'unique:shop_coupons',
        ], [
            'code.unique' => 'Mã giảm giá đã tồn tại'
        ]);

        $input              = $request->all();
        $item               = new ShopCouponModel();
        $item->code         = $input['code'];
        $item->type         = $input['type'];
        $item->value        = isset($input['value'])? $input['value'] : 0;
        $item->percent_off  = isset($input['percent_off'])? $input['percent_off'] : 0;
        $item->save();

        Toastr::success('Thêm thành công');
        return redirect()->route('admin.coupon');

    }

    public function update(Request $request, $id) {
        
        $input = $request->all();
        if ( $input['type'] == 'percent') {
            $item               = ShopCouponModel::find($id);
            $item->code         = $input['code'];
            $item->type         = $input['type'];
            $item->value        = 0;
            $item->percent_off  = $input['percent_off'];
            $item->save();
        } elseif ($input['type'] == 'price') {
            $item               = ShopCouponModel::find($id);
            $item->code         = $input['code'];
            $item->type         = $input['type'];
            $item->value        = $input['value'];
            $item->percent_off  = 0;
            $item->save();
        }

        Toastr::success('Sửa thành công');
        return redirect()->route('admin.coupon');
    }

    public function destroy($id) {

        $item = ShopCouponModel::find($id);
        $item->delete();

        Toastr::success('Xóa thành công');
        return redirect()->route('admin.coupon');
    }
}
