<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrderModel extends Model
{
    use HasFactory;

    public $table = 'order';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function order_detail()
    {
        return $this->hasMany('App\Models\ShopOrderDetailModel', 'order_id', 'id');
    }

    public static function countOrderByTime($startTime, $endTime)
    {
        $result = ShopOrderModel::whereBetween('created_at', [$startTime, $endTime])->count();
        return $result;
    }

    public static function getTotalRevenue($startTime, $endTime)
    {
        $result = ShopOrderModel::where('status', 3)->whereBetween('created_at', [$startTime, $endTime])->sum('total');
        return $result;
    }

    public static function getRevenueByTime($startTime, $endTime, $unitTime, $formatTime)
    {
        $result = [];
        while ($startTime <= $endTime) {
            $sum = (int) ShopOrderModel::where('status', 3)->where('created_at', 'LIKE',  '%' . $startTime . '%')->sum('total');
            $result[] = [$startTime, $sum];
            if( $unitTime == 'hour') {
                $startTime = date($formatTime, strtotime($startTime) + 60*60);
            } else {
                $startTime = date($formatTime, strtotime('+1 ' . $unitTime, strtotime($startTime)));
            }
        }
        return $result;
    }
}
