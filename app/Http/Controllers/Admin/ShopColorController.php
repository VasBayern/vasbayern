<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopColorModel;
use Illuminate\Http\Request;

class ShopColorController extends Controller
{
    public function index()
    {
        $colors = ShopColorModel::all();
        $data = array();
        $data['colors'] = $colors;

        return view('admin.content.shop.color.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'unique:colors',
            'color' => 'unique:colors',
        ], [
            'name.unique' => 'Màu đã tồn tại',
            'color.unique' => 'Mã màu đã tồn tại',
        ]);

        $input          = $request->all();
        $item           = new ShopColorModel();
        $item->name     = $input['name'];
        $item->color    = $input['color'];
        $item->save();

        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.color');
    }

    public function update(Request $request, $id)
    {
        $input          = $request->all();
        $item           = ShopColorModel::findOrFail($id);
        $item->name     = $input['name'];
        $item->color    = $input['color'];
        $item->save();

        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.color');
    }

    public function destroy($id)
    {
        $item = ShopColorModel::findOrFail($id);
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.color');
    }
}
