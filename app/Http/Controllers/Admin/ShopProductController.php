<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopBrandModel;
use App\Models\ShopCategoryModel;
use App\Models\ShopColorModel;
use App\Models\ShopProductModel;
use App\Models\ShopProductPropertiesModel;
use App\Models\ShopSizeModel;
use App\Models\TagModel;
use App\Models\TagProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopProductController extends Controller
{
    public function index()
    {
        $products = ShopProductModel::all();
        $data = array();
        $data['products'] = $products;

        return view('admin.content.shop.product.index', $data);
    }

    public function create()
    {
        $data = array();
        $categories = ShopCategoryModel::all();
        $data['categories'] = $categories;
        $brands = ShopBrandModel::all();
        $data['brands'] = $brands;
        $tags = TagModel::where('tag_type', 1)->get();
        $data['tags'] = $tags;
        $data['category_parents'] = ShopCategoryModel::getCategoryRecursive();

        return view('admin.content.shop.product.add', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'unique:shop_products',
            'slug'          => 'unique:shop_products',
        ], [
            'name.unique'   => 'Sản phẩm đã tồn tại',
            'slug.unique'   => 'Slug đã tồn tại',
        ]);
        $input              = $request->all();
        $item               = new ShopProductModel();
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->images       = json_encode($input['images']);
        $item->intro        = isset($input['intro'])    ?  $input['intro']              : '';
        $item->desc         = isset($input['desc'])     ?  $input['desc']               : '';
        $item->priceCore    = $input['priceCore'];
        $item->priceSale    = isset($input['priceSale']) ?  $input['priceSale']         : 0;
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

        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.product');
    }

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
        $data['category_parents'] = ShopCategoryModel::getCategoryRecursive($slug);
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
        return view('admin.content.shop.product.edit', $data);
    }

    public function update(Request $request, $slug)
    {
        $input              = $request->all();
        $item               = ShopProductModel::where('slug', $slug)->first();
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->images       = json_encode($input['images']);
        $item->intro        = isset($input['intro'])        ?  $input['intro']      : '';
        $item->desc         = isset($input['desc'])         ?  $input['desc']       : '';
        $item->priceCore    = $input['priceCore'];
        $item->priceSale    = isset($input['priceSale'])    ?  $input['priceSale']  : 0;
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
        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.product');
    }

    public function destroy($slug)
    {
        $item = ShopProductModel::where('slug', $slug)->first();
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.product');
    }

    public function storeProperties(Request $request, $slug)
    {
        $input = $request->all();
        $product_id = $input['product_id'];
        $size_id  = $input['size_id'];
        $color_id = $input['color_id'];
        $quantity = $input['quantity'];
        $propertyProduct = ShopProductPropertiesModel::where('product_id', $product_id)->where('color_id', $color_id)->where('size_id', $size_id)->get()->toArray();
        if (count($propertyProduct) > 0) {
            \Toastr::error('Đã tồn tại');
            return redirect()->back();
        } else {
            $item               = new ShopProductPropertiesModel();
            $item->product_id   = $product_id;
            $item->size_id      = $size_id;
            $item->color_id     = $color_id;
            $item->quantity     = $quantity;
            $item->save();
            \Toastr::success('Thêm thành công');
            return redirect()->back();
        }
    }

    public function updateProperties(Request $request, $slug, $id)
    {
        $input = $request->all();
        $quantity = (int)$input['quantity'];
        DB::table('product_properties')->where('id', $id)->update(['quantity' => $quantity]);

        \Toastr::success('Sửa số lượng thành công');
        return redirect()->back();
    }

    public function destroyProperties($slug, $id)
    {
        $item = ShopProductPropertiesModel::find($id);
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->back();
    }
    public function viewProperties(Request $request)
    {
        $product_id = $request->product_id;
        $properties = ShopProductPropertiesModel::where('product_id', $product_id)->get();
        if (count($properties) > 0) {
            echo '<table>
                  <tr>
                  <th style="width: 120px">Size</th>
                  <th style="width: 120px">Số lượng</th>
                  </tr>';

            foreach ($properties as $property) {
                echo '<tr><td>';
                $size_name = ShopSizeModel::find($property->size_id);
                echo $size_name->name . '</td><td>';
                echo $property->quantity . '</td></tr>';
            }
            echo '</table>';
        } else {
            echo 'Chưa có size cho sản phẩm';
        }
    }
}
