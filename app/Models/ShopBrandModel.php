<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopBrandModel extends Model
{
    use HasFactory;

    public $table = 'shop_brands';

    protected $fillable = [
        'name', 'slug', 'image', 'link', 'intro', 'desc',
    ];

    public function product() {
        return $this->hasMany('App\Models\ShopProductModel','brand_id','id');
    }
}
