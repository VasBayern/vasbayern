<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Models\BlogCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BlogCategoryModel::all();
        $data = array();
        $data['categories'] = $categories;
        return view('admin.blog.category.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'unique:content_category',
            'slug' => 'unique:content_category',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $input      = $request->all();
        $item       = new BlogCategoryModel();
        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $item->id,
            'name'      => $item->name,
            'slug'      => $item->slug,
            'url'       => url('api/admin/content/categories/' . $item->slug)
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = BlogCategoryModel::where('slug', $slug)->first();
        $response = [
            'success'   => true,
            'id'        => $item->id,
            'name'      => $item->name,
            'slug'      => $item->slug,
        ];
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $input      = $request->all();
        $item       = BlogCategoryModel::where('slug', $slug)->first();
        $checkNameExist = app(AdminController::class)->checkRecordExist($item->name, $input['name'], 'content_category', 'name');
        $checkSlugExist = app(AdminController::class)->checkRecordExist($item->slug, $input['slug'], 'content_category', 'slug');
        if (!empty($checkNameExist) || !empty($checkSlugExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Danh mục hoặc slug đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $item->id,
            'name'      => $item->name,
            'slug'      => $item->slug,
            'url'       => url('api/admin/content/categories/' . $item->slug)
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $item = BlogCategoryModel::where('slug', $slug)->first();
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $item->id,
        ];
        return response()->json($response, 200);
    }
}
