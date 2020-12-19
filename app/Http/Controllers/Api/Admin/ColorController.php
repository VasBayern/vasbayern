<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopColorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = ShopColorModel::all();
        $data = array();
        $data['colors'] = $colors;
        return view('admin.shop.color.index', $data);
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
            'name' => 'unique:colors',
            'color' => 'unique:colors',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $item           = new ShopColorModel();
        $item->name     = $input['name'];
        $item->color    = $input['color'];
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $item->id,
            'name'      => $item->name,
            'color'     => $item->color,
            'link'      => url('api/admin/colors/' . $item->id)
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
        $input          = $request->all();
        $item           = ShopColorModel::findOrFail($id);
        $checkNameExist = app(AdminController::class)->checkRecordExist($item->name, $input['name'], 'colors', 'name');
        $checkColorExist = app(AdminController::class)->checkRecordExist($item->color, $input['color'], 'colors', 'color');
        if (!empty($checkNameExist) || !empty($checkColorExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Màu đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->name     = $input['name'];
        $item->color    = $input['color'];
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $id,
            'name'      => $item->name,
            'color'     => $item->color,
            'link'      => url('api/admin/colors/' . $item->id)
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
        $item = ShopColorModel::findOrFail($id);
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $id,
        ];
        return response()->json($response, 200);
    }
}
