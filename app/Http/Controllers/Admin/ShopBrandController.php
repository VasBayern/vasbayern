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
            'name' => 'required|max:255|unique:shop_brands',
            'slug' => 'required|unique:shop_brands',
            'link' => 'required|unique:shop_brands',

        ],[
            'name.required' => 'Bạn chưa nhập tên',
            'name.unique' => 'Thương hiệu đã tồn tại',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã tồn tại',
            'link.required' => 'Bạn chưa nhập đường dẫn',
            'link.unique' => 'Đường dẫn đã tồn tại',
        ]);

        $input          = $request->all();
        $item           = new ShopBrandModel();
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->image    = isset($input['image'])    ? json_encode($input['image'])  : '';
        $item->link     = $input['link'];
        $item->intro    = isset($input['intro'])    ? $input['intro']               : '';
        $item->desc     = isset($input['desc'])     ? $input['desc']                : '';
        $item->save();

        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.brand');
    }

    public function update(Request $request, $slug) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'link' => 'required|max:255',
        ],[
            'name.required' => 'Bạn chưa nhập tên',
            'slug.required' => 'Bạn chưa nhập slug',
            'link.required' => 'Bạn chưa nhập link',
        ]);

        $input          = $request->all();
        $item           = ShopBrandModel::where('slug', $slug)->first();
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->image    = isset($input['image'])    ? json_encode($input['image'])  : '';
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
