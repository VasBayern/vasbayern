<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrderModel extends Model
{
    use HasFactory;

    public $table = 'order';

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function order_detail() {
        return $this->hasMany('App\Models\ShopOrderDetailModel','order_id','id');
    }
}