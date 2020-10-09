<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopBrandModel;
use App\Models\ShopCategoryModel;
use App\Models\ShopProductModel;
use App\Models\ShopProductPropertiesModel;
use App\Models\ShopSizeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopProductController extends Controller
{
    public function index() {

        $products = ShopProductModel::all();
        $data = array();
        $data['products'] = $products;

        return view('admin.content.shop.product.index', $data);
    }

    public function create() {

        $data = array();
        $categories = ShopCategoryModel::all();
        $data['categories'] = $categories;
        $brands = ShopBrandModel::all();
        $data['brands'] = $brands;
        $data['category_parents'] = ShopCategoryModel::getCategoryRecursive();

        return view('admin.content.shop.product.add', $data);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'unique:shop_products',
        ], [
            'name.unique' => 'Sản phẩm đã tồn tại',
        ]);

        $input = $request->all();
        $item = new ShopProductModel();
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->images       = isset($input['images'])   ? json_encode($input['images']) : '';
        $item->intro        = isset($input['intro'])    ?  $input['intro']              : '';
        $item->desc         = isset($input['desc'])     ?  $input['desc']               : '';
        $item->priceCore    = $input['priceCore'];
        $item->priceSale    = isset($input['priceSale'])?  $input['priceSale']          : 0;
        $item->cat_id       = $input['cat_id'];
        $item->brand_id     = $input['brand_id'];
        $item->new          = $input['new'];
        $item->homepage     = $input['homepage'];
        $item->save();

        \Toastr::success('Thêm thành công');
        return redirect()->route('admin.product');
    }

    public function edit($slug) {

        $data = array();
        $product = ShopProductModel::where('slug', $slug)->first();
        $data['product'] = $product;
        $categories = ShopCategoryModel::all();
        $data['categories'] = $categories;
        $brands = ShopBrandModel::all();
        $data['brands'] = $brands;
        $sizes = ShopSizeModel::all();
        $data['sizes'] = $sizes;
        $data['category_parents'] = ShopCategoryModel::getCategoryRecursive($slug);

        return view('admin.content.shop.product.edit', $data);
    }

    public function update(Request $request, $slug) {

        $input = $request->all();
        $item = ShopProductModel::where('slug', $slug)->first();
        $item->name         = $input['name'];
        $item->slug         = $input['slug'];
        $item->images       = isset($input['images'])       ? json_encode($input['images']) : '';
        $item->intro        = $input['intro'];
        $item->desc         = $input['desc'];
        $item->priceCore    = $input['priceCore'];
        $item->priceSale    = isset($input['priceSale'])    ?  $input['priceSale'] : 0;
        $item->cat_id       = $input['cat_id'];
        $item->brand_id     = $input['brand_id'];
        $item->new          = $input['new'];
        $item->homepage     = $input['homepage'];
        $item->save();

        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.product');
    }

    public function destroy($slug) {

        $item = ShopProductModel::where('slug', $slug)->first();
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.product');
    }

    public function storeProperties(Request $request, $slug) {

        $input = $request->all();
        $id = $input['id'];
        $size_id = $input['size_id'];
        $propertyProduct = ShopProductPropertiesModel::where('product_id',$id)->where('size_id',$size_id)->get()->toArray();
        if(count($propertyProduct)>0){
            \Toastr::error('Size đã tồn tại');
            return redirect()->back();
        }else{
            $item = new ShopProductPropertiesModel();
            $item->product_id = $id;
            $item->size_id    = $size_id;
            $item->quantity   = $input['quantity'];
            $item->save();
            \Toastr::success('Thêm size thành công');
            return redirect()->back();
        }
    }

    public function updateProperties(Request $request, $slug, $id) {
        $input = $request->all();
        $quantity = (int)$input['quantity'];
        DB::table('product_properties')->where('id',$id)->update(['quantity' => $quantity]);
        \Toastr::success('Sửa số lượng thành công');
        return redirect()->back();
    }

    public function destroyProperties($slug, $id) {

        $item = ShopProductPropertiesModel::find($id);
        $item->delete();
        \Toastr::success('Xóa thành công');
        return redirect()->back();
    }
    public function viewProperties(Request $request) {
        $product_id = $request->product_id;
        $properties = ShopProductPropertiesModel::where('product_id',$product_id)->get();
        if (count($properties) > 0) {
            echo '<table>
                  <tr>
                  <th style="width: 120px">Size</th>
                  <th style="width: 120px">Số lượng</th>
                  </tr>';

                foreach ($properties as $property) {
                    echo '<tr><td>';
                    $size_name = ShopSizeModel::find($property->size_id);
                    echo $size_name->name.'</td><td>';
                    echo $property->quantity.'</td></tr>';
                }
            echo '</table>';
        } else {
            echo 'Chưa có size cho sản phẩm';
        }
    }
}
