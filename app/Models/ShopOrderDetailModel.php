<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrderDetailModel extends Model
{
    use HasFactory;

    public $table = 'order_detail';

    public function order()
    {
        return $this->belongsTo('App\Models\ShopOrderModel','order_id','id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\ShopProductModel','product_id','id');
    }
}
