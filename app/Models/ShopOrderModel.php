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

    public static function getRevenueByTime($startDate, $endDate, $timeUnit, $timeFormat)
    {


        //$endTime = date('Y-m', $endTime);
        $result = [];
        while ($startDate < $endDate) {
            if ($timeUnit == 'day' || $timeUnit == 'month') {
                $sum = (int) ShopOrderModel::where('status', 3)->where('created_at', 'LIKE',  '%' . $startDate . '%')->sum('total');
                $startDate = date($timeFormat, strtotime('+1 ' . $timeUnit, strtotime($startDate)));
            } else {
                $nextDate = date($timeFormat, strtotime('+1 ' . $timeUnit, strtotime($startDate)));
                $sum = (int) ShopOrderModel::where('status', 3)->whereBetween('created_at', [$startDate, $nextDate])->sum('total');
                $nextDate1 = date($nextDate, strtotime('+1 day', strtotime($nextDate)));
                $result[] = [$startDate . '-' . $nextDate, $sum];
                $startDate = date($timeFormat, strtotime('+7 days', strtotime($startDate)));
                
            }
            
        }
        return $result;
    }
}
