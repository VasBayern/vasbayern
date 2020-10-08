<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopCategoryModel;
use Brian2694\Toastr\Facades\Toastr;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
  
    public function index() {

        $categories = ShopCategoryModel::all();
        $data = array();
        $data['categories'] = $categories;

        return view('admin.content.shop.category.index', $data);
    }

    public function create() {

        $data = array();
        $categories = ShopCategoryModel::all();
        $data['categories'] = $categories;
        $data['parent_categories'] = ShopCategoryModel::getCategoryRecursive();

        return view('admin.content.shop.category.add', $data);
    }

    public function edit($slug) {

        $data = array();
        $item = ShopCategoryModel::where('slug', $slug)->first();
        $data['category'] = $item;
        $data['parent_categories'] = ShopCategoryModel::getCategoryRecursiveExcept($slug);

        return view('admin.content.shop.category.edit', $data );
    }


    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => 'unique:shop_categories',
            'slug' => 'unique:shop_categories',

        ],[
            'name.unique' => 'Danh mục đã tồn tại',
            'slug.unique' => 'Slug đã tồn tại',
        ]);

        $input = $request->all();
        $item = new ShopCategoryModel();

        $item->name         = $input['name'];
        $item->parent_id    = $input['parent_id'];
        $item->slug         = $input['slug'];
        $item->image        = isset($input['image'])    ? json_encode($input['image'])  : '';
        $item->intro        = isset($input['intro'])    ? $input['intro']               : '';
        $item->desc         = isset($input['desc'])     ? $input['desc']                : '';
        $item->homepage     = $input['homepage'];
        $item->save();

        Toastr::success('Thêm thành công');
        return redirect()->route('admin.category');
    }

    public function update(Request $request, $slug) {

        $input = $request->all();
        $item = ShopCategoryModel::where('slug', $slug)->first();
        $item->name         = $input['name'];
        $item->parent_id    = $input['parent_id'];
        $item->slug         = $input['slug'];
        $item->image        = isset($input['image'])    ? json_encode($input['image'])  : '';
        $item->intro        = isset($input['intro'])    ? $input['intro']               : '';
        $item->desc         = isset($input['desc'])     ? $input['desc']                : '';
        $item->homepage     = $input['homepage'];
        $item->save();

        Toastr::success('Sửa thành công');
        return redirect()->route('admin.category');
    }

    public function destroy($slug) {
        $item = ShopCategoryModel::where('slug', $slug)->first();
        $item->delete();

        Toastr::success('Xóa thành công');
        return redirect()->route('admin.category');
    }
}
