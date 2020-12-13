<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\TagModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = TagModel::all();
        $data = array();
        $data['tags'] = $tags;
        return view('admin.shop.tag.index', $data);
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
            'name' => 'unique:tags',
            'slug' => 'unique:tags',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $input          = $request->all();
        $item           = new TagModel();
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->tag_type = $input['type'];
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $item->id,
            'name'      => $item->name,
            'slug'      => $item->slug,
            'type'      => $item->tag_type,
            'link'      => url('api/admin/tags/' . $item->id)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input          = $request->all();
        $item           = TagModel::findOrFail($id);
        $checkNameExist = DB::select('SELECT name FROM tags WHERE name != "' . $item->name . '" AND name = "' . $input['name'] . '"');
        $checkSlugExist = DB::select('SELECT slug FROM tags WHERE slug != "' . $item->slug . '" AND slug = "' . $input['slug'] . '"');
        if (!empty($checkNameExist) || !empty($checkSlugExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Thẻ đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->name     = $input['name'];
        $item->slug     = $input['slug'];
        $item->tag_type = $input['type'];
        $item->save();
        $response = [
            'success'   => true,
            'id'        => $item->id,
            'name'      => $item->name,
            'slug'      => $item->slug,
            'type'      => $item->tag_type,
            'link'      => url('api/admin/tags/' . $item->id)
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = TagModel::findOrFail($id);
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $id,
        ];
        return response()->json($response, 200);
    }
}
