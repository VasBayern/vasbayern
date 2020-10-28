<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TagProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagProductController extends Controller
{
    public function index()
    {
        $tags = TagProductModel::all();
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
        $item           = new TagProductModel();
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->tag_type = $input['type'];
        $item->save();
        if(isset($input['tag'])) {
            foreach($input['tag'] as $tag) {
                DB::table('taggables')->insertOrIgnore([
                    'product_id'    => $item->id,
                    'tag_id'        => $tag,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.tag');
    }

    public function update(Request $request, $id)
    {
        $input          = $request->all();
        $item           = TagProductModel::findOrFail($id);
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->tag_type = $input['type'];
        $item->save();

        if(isset($input['tag'])) {
            //$tagExist = DB::table('taggables')::where('product_id');
            foreach($input['tag'] as $tag) {
                DB::table('taggables')->insertOrIgnore([
                    'product_id'    => $item->id,
                    'tag_id'        => $tag,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.tag');
    }

    public function destroy($id)
    {
        $item = TagProductModel::findOrFail($id);
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.tag');
    }
}
