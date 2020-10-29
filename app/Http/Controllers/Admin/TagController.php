<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TagModel;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = TagModel::all();
        $data = array();
        $data['tags'] = $tags;

        return view('admin.content.shop.tag.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'max:255|unique:tags',
        ], [
            'name.unique' => 'Thẻ đã tồn tại',
        ]);
        $input          = $request->all();
        $item           = new TagModel();
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->tag_type = $input['type'];
        $item->save();
      
        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.tag');
    }

    public function update(Request $request, $id)
    {
        $input          = $request->all();
        $item           = TagModel::findOrFail($id);
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->tag_type = $input['type'];
        $item->save();

        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.tag');
    }

    public function destroy($id)
    {
        $item = TagModel::findOrFail($id);
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.tag');
    }
}
