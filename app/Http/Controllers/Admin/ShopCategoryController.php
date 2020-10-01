<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopCategoryModel;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
        $items = ShopCategoryModel::all();

        $data = array();
        $data['cats'] = $items;

        return view('admin.content.shop.category.list', $data);
    }

    public function create() {

        $data = array();
        $cats = ShopCategoryModel::all();
        $data['cats'] = $cats;
        $data['cates'] = ShopCategoryModel::getCategoryRecursive();

        return view('admin.content.shop.category.add', $data);
    }

    public function edit($id) {
        $data = array();
        $item = ShopCategoryModel::findOrFail($id);
        $data['cat'] = $item;
        $data['cates'] = ShopCategoryModel::getCategoryRecursiveExcept($id);

        return view('admin.content.shop.category.edit', $data );
    }


    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:shop_categories',
            //'image' => 'required|unique:shop_categories',

        ],[
            'name.required' => 'Bạn chưa nhập tên',
            'name.unique' => 'Danh mục đã tồn tại',
           // 'image.required' => 'Bạn chưa nhập ảnh',
            //'image.unique' => 'Ảnh đã tồn tại',
        ]);

        $input = $request->all();
        $item = new ShopCategoryModel();

        $item->name = $input['name'];
        $item->parent_id = $input['parent_id'];
        $item->slug = $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->image = isset($input['image']) ? json_encode($input['image']) : '';
        $item->intro = isset($input['intro']) ? $input['intro'] : '';
        $item->desc = isset($input['desc']) ? $input['desc'] : '';
        $item->homepage = isset($input['homepage']) ? (int) $input['homepage'] : 0;

        $item->save();

        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.category');
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
//             Rule::unique('shop_categories')->where(function ($query) {
//                return $query->where('id', 1);
//            })

        ],[
            'name.required' => 'Bạn chưa nhập tên',
        ]);
        $input = $request->all();
        $item = ShopCategoryModel::findOrFail($id);

        $item->name = $input['name'];
        $item->parent_id = $input['parent_id'];
        $item->slug = $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->image = isset($input['image']) ? json_encode($input['image']) : '';
        $item->intro = isset($input['intro']) ? $input['intro'] : '';
        $item->desc = isset($input['desc']) ? $input['desc'] : '';
        $item->homepage = isset($input['homepage']) ? (int) $input['homepage'] : 0;

        $item->save();

        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.category');
    }

    public function destroy($id) {
        $item = ShopCategoryModel::findOrFail($id);
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.category');
    }
}
