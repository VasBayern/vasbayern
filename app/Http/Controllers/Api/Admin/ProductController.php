<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopBrandModel;
use App\Models\ShopCategoryModel;
use App\Models\ShopColorModel;
use App\Models\ShopProductModel;
use App\Models\ShopSizeModel;
use App\Models\TagModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ShopProductModel::all();
        $data = array();
        $data['products'] = $products;
        return view('admin.shop.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $categories = ShopCategoryModel::getCategoryRecursive();
        $data['categories'] = $categories;
        $brands = ShopBrandModel::all();
        $data['brands'] = $brands;
        $tags = TagModel::where('tag_type', 1)->get();
        $data['tags'] = $tags;
        //$data['category_parents'] = ShopCategoryModel::getCategoryRecursive();
        return view('admin.shop.product.add', $data);
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
            'name' => 'unique:shop_products',
            'slug' => 'unique:shop_products',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $input              = $request->all();
        $item               = new ShopProductModel();
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->images       = json_encode($input['images']);
        $item->intro        = isset($input['intro']) ? $input['intro'] : '';
        $item->desc         = isset($input['desc'])  ? $input['desc'] : '';
        $item->priceCore    = $input['priceCore'];
        $item->priceSale    = isset($input['priceSale']) ? $input['priceSale'] : 0;
        $item->cat_id       = $input['cat_id'];
        $item->brand_id     = $input['brand_id'];
        $item->new          = $input['new'];
        $item->homepage     = $input['homepage'];
        $item->save();
        foreach ($input['tag'] as $tag) {
            DB::table('taggables')->insertOrIgnore([
                'product_id'    => $item->id,
                'post_id'       => NULL,
                'tag_id'        => $tag,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
        $response = [
            'success'   => true,
            'link'      => url('api/admin/products'),
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
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
        $product = ShopProductModel::where('slug', $slug)->first();
        $data['product'] = $product;
        $categories = ShopCategoryModel::all();
        $data['categories'] = $categories;
        $brands = ShopBrandModel::all();
        $data['brands'] = $brands;
        $sizes = ShopSizeModel::all();
        $data['sizes'] = $sizes;
        $colors = ShopColorModel::all();
        $data['colors'] = $colors;
        $data['category_parents'] = ShopCategoryModel::getCategoryRecursive($product->id);
        $tags = TagModel::where('tag_type', 1)->get();
        $data['tags'] = $tags;

        $sql = DB::select('SELECT A.id
        FROM tags AS A
        JOIN taggables AS B ON A.id = B.tag_id
        JOIN shop_products AS C ON B.product_id = C.id
        WHERE A.tag_type = 1 AND C.id = ' . $product->id);
        $tagProductIDs = [];
        foreach ($sql as $row) {
            array_push($tagProductIDs, $row->id);
        }
        $data['tagProductIDs'] = $tagProductIDs;
        return view('admin.shop.product.edit', $data);
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
        $item               = ShopProductModel::where('slug', $slug)->first();
        $checkNameExist     = DB::select('SELECT name FROM shop_products WHERE name != "' . $item->name . '" AND name = "' . $input['name'] . '"');
        $checkSlugExist     = DB::select('SELECT slug FROM shop_products WHERE slug != "' . $item->slug . '" AND slug = "' . $input['slug'] . '"');

        if (!empty($checkNameExist) && !empty($checkSlugExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Sản phẩm hoặc slug đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->images       = json_encode($input['images']);
        $item->intro        = isset($input['intro']) ? $input['intro'] : '';
        $item->desc         = isset($input['desc'])  ? $input['desc'] : '';
        $item->priceCore    = $input['priceCore'];
        $item->priceSale    = isset($input['priceSale']) ? $input['priceSale'] : 0;
        $item->cat_id       = $input['cat_id'];
        $item->brand_id     = $input['brand_id'];
        $item->new          = $input['new'];
        $item->homepage     = $input['homepage'];
        $item->save();

        $getAllTag = [];
        $getTag = DB::table('taggables')->where('product_id', $item->id)->get();
        foreach ($getTag as $tag) {
            array_push($getAllTag, $tag->tag_id);
        }
        $duplicateTags = array_intersect($getAllTag, $input['tag']);
        $removeTags = array_diff($getAllTag, $duplicateTags);
        $addTags = array_diff($input['tag'], $duplicateTags);
        foreach ($removeTags as $tag) {
            DB::table('taggables')->where('product_id', $item->id)->where('tag_id', $tag)->delete();
        }
        foreach ($addTags as $tag) {
            DB::table('taggables')->insert([
                'product_id'    => $item->id,
                'post_id'       => NULL,
                'tag_id'        => $tag,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
        $response = [
            'success'   => true,
            'link'      => url('api/admin/products'),
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
        $item = ShopProductModel::where('slug', $slug)->first();
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $item->id,
        ];
        return response()->json($response, 200);
    }
}
