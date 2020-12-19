<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopBannerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = ShopBannerModel::all();
        $data = array();
        $data['banners'] = $banners;
        $data['locations'] = ShopBannerModel::getBannerLocations();
        return view('admin.content.banner.index', $data);
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
            'name'          => 'unique:shop_banners',
            'slug'          => 'unique:shop_banners',
            'image'         => 'unique:shop_banners',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $input              = $request->all();
        $item               = new ShopBannerModel();
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->image        = $input['image'];
        $item->link         = $input['link'];
        $item->location_id  = isset($input['location_id'])  ? (int) $input['location_id'] : 0;
        $item->intro        = isset($input['intro']) ? $input['intro'] : '';
        $item->desc         = isset($input['desc']) ? $input['desc'] : '';
        $item->save();
        ShopBannerModel::getBannerLocations();
        $response = [
            'success'       => true,
            'id'            => $item->id,
            'name'          => $item->name,
            'slug'          => $item->slug,
            'image'         => $item->image,
            'link'          => $item->link,
            'location_id'   => $item->location_id,
            'intro'         => $item->intro,
            'desc'          => $item->desc,
            'url'           => url('api/admin/banners/' . $item->slug)
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = ShopBannerModel::where('slug', $slug)->first();
        $response = [
            'success'       => true,
            'id'            => $item->id,
            'name'          => $item->name,
            'slug'          => $item->slug,
            'image'         => $item->image,
            'link'          => $item->link,
            'location_id'   => $item->location_id,
            'intro'         => $item->intro,
            'desc'          => $item->desc
        ];
        return response()->json($response, 200);
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
        $input          = $request->all();
        $item           = ShopBannerModel::where('slug', $slug)->first();
        $checkNameExist = app(AdminController::class)->checkRecordExist($item->name, $input['name'], 'shop_banners', 'name');
        $checkSlugExist = app(AdminController::class)->checkRecordExist($item->slug, $input['slug'], 'shop_banners', 'slug');
        $checkImageExist = app(AdminController::class)->checkRecordExist($item->link, $input['link'], 'shop_banners', 'image');
        if (!empty($checkNameExist) || !empty($checkSlugExist) || !empty($checkImageExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Tên hoặc slug hoặc ảnh đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->image        = $input['image'];
        $item->link         = $input['link'];
        $item->location_id  = isset($input['location_id'])  ? (int) $input['location_id'] : 0;
        $item->intro        = isset($input['intro']) ? $input['intro'] : '';
        $item->desc         = isset($input['desc']) ? $input['desc'] : '';
        $item->save();
        $response = [
            'success'       => true,
            'id'            => $item->id,
            'name'          => $item->name,
            'slug'          => $item->slug,
            'image'         => $item->image,
            'link'          => $item->link,
            'location_id'   => $item->location_id,
            'intro'         => $item->intro,
            'desc'          => $item->desc,
            'url'           => url('api/admin/banners/' . $item->slug)
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
        $item = ShopBannerModel::where('slug', $slug)->first();
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $item->id,
        ];
        return response()->json($response, 200);
    }
}
