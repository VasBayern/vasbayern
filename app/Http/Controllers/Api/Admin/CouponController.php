<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopCouponModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = ShopCouponModel::all();
        $data = array();
        $data['coupons'] = $coupons;
        return view('admin.shop.coupon.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'unique:shop_coupons',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $input              = $request->all();
        $item               = new ShopCouponModel();
        $item->code         = $input['code'];
        $item->type         = $input['type'];
        $item->value        = isset($input['value']) ? $input['value'] : 0;
        $item->percent_off  = isset($input['percent_off']) ? $input['percent_off'] : 0;
        $item->save();
        $response = [
            'success'       => true,
            'id'            => $item->id,
            'name'          => $item->code,
            'type'          => $item->type,
            'value'         => $item->value,
            'percent_off'   => $item->percent_off,
            'link'          => url('api/admin/coupons/'. $item->id)
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $item               = ShopCouponModel::find($id);
        $checkNameExist     = DB::select('SELECT name FROM shop_coupons WHERE name != "' . $item->name . '" AND name = "' . $input['name'] . '"');
        if (!empty($checkNameExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Mã đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->code         = $input['code'];
        $item->type         = $input['type'];
        if ($input['type'] == 1) {
            $item->value        = 0;
            $item->percent_off  = $input['percent_off'];
        } elseif ($input['type'] == 2) {
            $item->value        = $input['value'];
            $item->percent_off  = 0;
        }
        $item->save();
        $response = [
            'success'       => true,
            'id'            => $item->id,
            'name'          => $item->code,
            'type'          => $item->type,
            'value'         => $item->value,
            'percent_off'   => $item->percent_off,
            'link'          => url('api/admin/coupons/'. $item->id)
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ShopCouponModel::findOrFail($id);
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $id,
        ];
        return response()->json($response, 200);
    }
}
