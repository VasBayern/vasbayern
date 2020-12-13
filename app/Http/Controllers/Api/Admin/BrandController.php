<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopBrandModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = ShopBrandModel::all();
        $data = array();
        $data['brands'] = $brands;
        return view('admin.shop.brand.index', $data);
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
            'name'          => 'unique:shop_brands',
            'slug'          => 'unique:shop_brands',
            'link'          => 'unique:shop_brands',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $input          = $request->all();
        $item           = new ShopBrandModel();
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->image    = $input['image'];
        $item->link     = $input['link'];
        $item->intro    = isset($input['intro']) ? $input['intro'] : '';
        $item->desc     = isset($input['desc']) ? $input['desc'] : '';
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $item->id,
            'name'      => $item->name,
            'slug'      => $item->slug,
            'image'     => $item->image,
            'linkBrand' => $item->link,
            'intro'     => $item->intro,
            'desc'      => $item->desc,
            'link'      => url('api/admin/brands/' . $item->slug)
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $input              = $request->all();
        $item               = ShopBrandModel::where('slug', $slug)->first();
        $checkNameExist     = DB::select('SELECT name FROM shop_brands WHERE name != "' . $item->name . '" AND name = "' . $input['name'] . '"');
        $checkSlugExist     = DB::select('SELECT slug FROM shop_brands WHERE slug != "' . $item->slug . '" AND slug = "' . $input['slug'] . '"');
        $checkLinkExist     = DB::select('SELECT link FROM shop_brands WHERE link != "' . $item->link . '" AND link = "' . $input['link'] . '"');

        if (!empty($checkNameExist) || !empty($checkSlugExist) || !empty($checkLinkExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Tên hoặc slug hoặc link đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->image    = $input['image'];
        $item->link     = $input['link'];
        $item->intro    = isset($input['intro']) ? $input['intro'] : '';
        $item->desc     = isset($input['desc']) ? $input['desc'] : '';
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $item->id,
            'name'      => $item->name,
            'slug'      => $item->slug,
            'image'     => $item->image,
            'linkBrand' => $item->link,
            'intro'     => $item->intro,
            'desc'      => $item->desc,
            'link'      => url('api/admin/brands/' . $item->slug)
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $item = ShopBrandModel::where('slug', $slug)->first();
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $item->id,
        ];
        return response()->json($response, 200);
    }
}
