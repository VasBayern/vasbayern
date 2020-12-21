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

    public static function countOrderByTime($time, $now) {
        $result = ShopOrderModel::whereBetween('created_at', [$time, $now])->count();
        return $result;
    } 

    public static function getTotalRevenue($time, $now) {
        $result = ShopOrderModel::where('status', 3)->whereBetween('created_at', [$time, $now])->sum('total');
        return $result;
    } 

    public static function getRevenueByTime($time, $now) {
        $result = ShopOrderModel::select('updated_at', 'total')->where('status', 3)->whereBetween('created_at', [$time, $now])->get();
        return $result;
    } 
}
