<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryModel;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index() {

        $categories = BlogCategoryModel::all();
        $data = array();
        $data['categories'] = $categories;

        return view('admin.content.blog.category.index', $data);
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'name'          => 'unique:content_category',
            'slug'          => 'unique:content_category',
        ], [
            'name.unique'   => 'Danh mục đã tồn tại',
            'slug.unique'   => 'Slug đã tồn tại'
        ]);
        $input      = $request->all();
        $item       = new BlogCategoryModel();
        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->save();

        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.blog.category');
    }

    public function update(Request $request, $slug) {

        $input      = $request->all();
        $item       = BlogCategoryModel::where('slug', $slug)->first();
        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->save();

        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.blog.category');
    }

    public function destroy($slug) {

        $item = BlogCategoryModel::where('slug', $slug)->first();
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.blog.category');
    }
}
