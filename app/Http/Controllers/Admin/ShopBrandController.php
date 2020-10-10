<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopBrandModel;
use Illuminate\Http\Request;


class ShopBrandController extends Controller
{
    public function index() {
        $brands = ShopBrandModel::all();
        $data = array();
        $data['brands'] = $brands;

        return view('admin.content.shop.brand.index', $data);
    }

    public function create() {

        return view('admin.content.shop.brand.add');
    }

    public function edit($slug) {
        $data = array();
        $brand = ShopBrandModel::where('slug', $slug)->first();
        $data['brand'] = $brand;

        return view('admin.content.shop.brand.edit', $data );
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name'          => 'unique:shop_brands',
            'slug'          => 'unique:shop_brands',
            'link'          => 'unique:shop_brands',

        ],[
            'name.unique'   => 'Thương hiệu đã tồn tại',
            'slug.unique'   => 'Slug đã tồn tại',
            'link.unique'   => 'Đường dẫn đã tồn tại',
        ]);

        $input          = $request->all();
        $item           = new ShopBrandModel();
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->image    = $input['image'];
        $item->link     = $input['link'];
        $item->intro    = isset($input['intro'])    ? $input['intro']               : '';
        $item->desc     = isset($input['desc'])     ? $input['desc']                : '';
        $item->save();

        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.brand');
    }

    public function update(Request $request, $slug) {

        $input          = $request->all();
        $item           = ShopBrandModel::where('slug', $slug)->first();
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->image    = $input['image'];
        $item->link     = $input['link'];
        $item->intro    = isset($input['intro'])    ? $input['intro']               : '';
        $item->desc     = isset($input['desc'])     ? $input['desc']                : '';
        $item->save();

        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.brand');
    }

    public function destroy($slug) {
        $item = ShopBrandModel::where('slug', $slug)->first();
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.brand');
    }

}
