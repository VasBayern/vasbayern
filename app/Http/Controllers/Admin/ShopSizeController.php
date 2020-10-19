<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopSizeModel;
use Illuminate\Http\Request;

class ShopSizeController extends Controller
{
    public function index() {
        $sizes = ShopSizeModel::all();
        $data = array();
        $data['sizes'] = $sizes;

        return view('admin.content.shop.size.index', $data);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'max:255|unique:sizes',
        ],[
            'name.unique' => 'Size đã tồn tại',
        ]);

        $input          = $request->all();
        $item           = new ShopSizeModel();
        $item->name     = $input['name'];
        $item->save();

        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.size');
    }

    public function update(Request $request, $id) {

        $input          = $request->all();
        $item           = ShopSizeModel::findOrFail($id);
        $item->name     = $input['name'];
        $item->save();

        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.size');
    }

    public function destroy($id) {

        $item = ShopSizeModel::findOrFail($id);
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.size');
    }

}
