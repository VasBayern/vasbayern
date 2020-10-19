<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProductPropertiesModel extends Model
{
    use HasFactory;

    public $table = 'product_properties';

    public function product() {
        return $this->belongsTo('App\Models\ShopProductModel','product_id', 'id');
    }

    public function size() {
        return $this->belongsTo('App\Models\ShopSizeModel','size_id', 'id');
    }

    public function color() {
        return $this->belongsTo('App\Models\ShopColorModel','color_id', 'id');
    }
}
