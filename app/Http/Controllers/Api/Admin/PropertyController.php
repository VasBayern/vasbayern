<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopColorModel;
use App\Models\ShopProductPropertiesModel;
use App\Models\ShopSizeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input      = $request->all();
        $product_id = $input['product_id'];
        $size_id    = $input['size_id'];
        $color_id   = $input['color_id'];
        $quantity   = $input['quantity'];
        $sizes  = DB::table('sizes')->select('name')->where('id', $size_id)->get();
        foreach($sizes as $row) {
            $size = $row->name;
        }
        $colors = DB::table('colors')->select('name', 'color')->where('id', $color_id)->get();
        foreach($colors as $row) {
            $color_name = $row->name;
            $color      = $row->color;
        }
        $propertyProduct = ShopProductPropertiesModel::where('product_id', $product_id)->where('color_id', $color_id)->where('size_id', $size_id)->get()->toArray();
        if (count($propertyProduct) > 0) {
            $response = [
                'success'   => false,
                'msg'   => 'Đã tồn tại',
            ];
            return response()->json($response, 422);
        } else {
            $item               = new ShopProductPropertiesModel();
            $item->product_id   = $product_id;
            $item->size_id      = $size_id;
            $item->color_id     = $color_id;
            $item->quantity     = $quantity;
            $item->save();
            $response = [
                'success'   => true,
                'id'        => $item->id,
                'size'      => $size,
                'color_name'=> $color_name,
                'color'     => $color,
                'quantity'  => $item->quantity,
                'link'      => url('api/admin/properties/'. $item->id),
            ];
            return response()->json($response, 200);
        }
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
        $quantity = (int)$input['quantity'];
        DB::table('product_properties')->where('id', $id)->update(['quantity' => $quantity]);
        
        $property = DB::table('product_properties')->where('id', $id)->get();
        // $sizes  = DB::table('sizes')->select('name')->where('id', $size_id)->get();
        // foreach($sizes as $row) {
        //     $size = $row->name;
        // }
        // $colors = DB::table('colors')->select('name', 'color')->where('id', $color_id)->get();
        // foreach($colors as $row) {
        //     $color_name = $row->name;
        //     $color      = $row->color;
        // }
        // $response = [
        //     'success'   => true,
        //     'id'        => $item->id,
        //     'size'      => $size,
        //     'color_name'=> $color_name,
        //     'color'     => $color,
        //     'quantity'  => $quantity,
        //     'link'      => url('api/admin/properties/'. $id),
        // ];
        return response()->json($property, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ShopProductPropertiesModel::find($id);
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $item->id,
        ];
        return response()->json($response, 200);
    }
}
