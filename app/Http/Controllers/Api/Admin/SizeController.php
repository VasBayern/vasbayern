<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopSizeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = ShopSizeModel::all();
        $data = array();
        $data['sizes'] = $sizes;
        return view('admin.shop.size.index', $data);
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
            'name' => 'unique:sizes',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $item           = new ShopSizeModel();
        $item->name     = $input['name'];
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $item->id,
            'name'      => $item->name,
            'link'      => url('api/admin/sizes/' . $item->id)
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
        $item           = ShopSizeModel::findOrFail($id);
        $checkNameExist = app(AdminController::class)->checkRecordExist($item->name, $input['name'], 'sizes', 'name');
        if (!empty($checkNameExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Size đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->name     = $input['name'];
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $id,
            'name'      => $item->name,
            'link'      => url('api/admin/sizes/' . $item->id)
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
        $item = ShopSizeModel::findOrFail($id);
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $id,
        ];
        return response()->json($response, 200);
    }
}
