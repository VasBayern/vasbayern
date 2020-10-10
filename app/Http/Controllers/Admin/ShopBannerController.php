<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopBannerModel;
use Illuminate\Http\Request;

class ShopBannerController extends Controller
{
    public function index() {

        $banners = ShopBannerModel::all();
        $data = array();
        $data['banners'] = $banners;

        return view('admin.content.banner.index', $data);
    }
    public function create() {

        $data = array();
        $data['locations'] = ShopBannerModel::getBannerLocations();

        return view('admin.content.banner.add', $data);
    }

    public function edit($slug) {
        $data = array();
        $banner = ShopBannerModel::where('slug', $slug)->first();
        $data['banner'] = $banner;
        $data['locations'] = ShopBannerModel::getBannerLocations();

        return view('admin.content.banner.edit', $data);
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'name'          => 'unique:shop_banners',
            'slug'          => 'unique:shop_banners',
            'image'         => 'unique:shop_banners',
        ],[
            'name.unique'   => 'Banner đã tồn tại',
            'name.unique'   => 'Slug đã tồn tại',
            'image.unique'  => 'Ảnh đã tồn tại',
        ]);
        $input              = $request->all();
        $item               = new ShopBannerModel();
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->image        = $input['image'];
        $item->link         = $input['link'];
        $item->location_id  = isset($input['location_id'])  ? (int) $input['location_id'] : 0;
        $item->intro        = isset($input['intro'])        ? $input['intro'] : '';
        $item->desc         = isset($input['desc'])         ? $input['desc'] : '';
        $item->save();

        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.banners');
    }

    public function update(Request $request, $slug) {

        $input              = $request->all();
        $item               = ShopBannerModel::where('slug', $slug)->first();
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->image        = $input['image'];
        $item->link         = $input['link'];
        $item->location_id  = isset($input['location_id'])  ? (int) $input['location_id'] : 0;
        $item->intro        = isset($input['intro'])        ? $input['intro'] : '';
        $item->desc         = isset($input['desc'])         ? $input['desc'] : '';
        $item->save();

        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.banners');
    }

    public function destroy($slug) {

        $item = ShopBannerModel::where('slug', $slug)->first();
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.banners');
    }
}
