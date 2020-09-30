<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProductModel extends Model
{
    use HasFactory;

    public $table = 'shop_products';

    public function category()
    {
        return $this->belongsTo('App\Models\ShopCategoryModel','cat_id','id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\ShopBrandModel','brand_id','id');
    }

    public function product_properties()
    {
        return $this->hasMany('App\Models\ShopProductPropertiesModel', 'product_id', 'id');
    }
    public function comment()
    {
        return $this->hasMany('App\Models\CommentModel', 'product_id', 'id');
    }
    public function wishlist()
    {
        return $this->hasMany('App\Models\WishListModel', 'product_id', 'id');
    }
}
