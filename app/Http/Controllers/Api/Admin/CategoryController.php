<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ShopCategoryModel::getCategoryRecursive();
        $data = array();
        $data['categories'] = $categories;
        return view('admin.shop.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $categories = ShopCategoryModel::all();
        $data['categories'] = $categories;
        $data['parent_categories'] = ShopCategoryModel::getCategoryRecursive();
        return view('admin.shop.category.add', $data);
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
            'name' => 'unique:shop_categories',
            'slug' => 'unique:shop_categories',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $input              = $request->all();
        $item               = new ShopCategoryModel();
        $item->name         = $input['name'];
        $item->parent_id    = $input['parent_id'];
        $item->slug         = $input['slug'];
        $item->image        = $input['image'];
        $item->intro        = isset($input['intro']) ? $input['intro'] : '';
        $item->desc         = isset($input['desc'])  ? $input['desc'] : '';
        $item->homepage     = $input['homepage'];
        $item->sort_no     = $input['sort_no'];
        $item->save();
        $response = [
            'success'   => true,
            'link'      => url('api/admin/categories'),
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = array();
        $category = ShopCategoryModel::where('slug', $slug)->first();
        $id = $category['id'];
        $data['category'] = $category;
        $data['parent_categories'] = ShopCategoryModel::getCategoryRecursiveExcept($id);
        return view('admin.shop.category.edit', $data);
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
        $input              = $request->all();
        $item               = ShopCategoryModel::where('slug', $slug)->first();
        $checkNameExist = app(AdminController::class)->checkRecordExist($item->name, $input['name'], 'shop_categories', 'name');
        $checkSlugExist = app(AdminController::class)->checkRecordExist($item->slug, $input['slug'], 'shop_categories', 'slug');
        if (!empty($checkNameExist) || !empty($checkSlugExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Danh mục hoặc slug đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->name         = $input['name'];
        $item->parent_id    = $input['parent_id'];
        $item->slug         = $input['slug'];
        $item->image        = $input['image'];
        $item->intro        = isset($input['intro']) ? $input['intro'] : '';
        $item->desc         = isset($input['desc'])  ? $input['desc'] : '';
        $item->homepage     = $input['homepage'];
        $item->save();
        $response = [
            'success'   => true,
            'link'      => url('api/admin/categories'),
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
        $item = ShopCategoryModel::where('slug', $slug)->first();
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $item->id,
        ];
        return response()->json($response, 200);
    }
}
