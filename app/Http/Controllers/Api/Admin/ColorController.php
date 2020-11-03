<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopColorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index()
    {
        $colors = ShopColorModel::all();
        $data = array();
        $data['colors'] = $colors;

        return view('admin.shop.color.index', $data);
    }
    public function showModalEdit(Request $response) {

    }
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
        ];
        return response()->json($response, 200);
    }
}
