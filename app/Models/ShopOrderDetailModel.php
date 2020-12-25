<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShopOrderDetailModel extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    public function order()
    {
        return $this->belongsTo('App\Models\ShopOrderModel', 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\ShopProductModel', 'product_id', 'id');
    }

    public static function countProductSoldByTime($startTime, $endTime)
    {
        $result = ShopOrderDetailModel::whereBetween('created_at', [$startTime, $endTime])->where('status', 1)->sum('quantity');
        return $result;
    }

    public static function countCategorySold($startTime, $endTime)
    {
        $sql = DB::select(
            'SELECT C.name, sum(A.quantity) AS quantity, sum(A.total_price) AS total 
            FROM order_detail AS A
            LEFT JOIN shop_products AS B ON A.product_id = B.id
            LEFT JOIN shop_categories AS C ON B.cat_id = C.id
            WHERE A.created_at BETWEEN "' . $startTime . '" AND "' . $endTime . '"
            GROUP BY C.name
            ORDER BY total DESC
            LIMIT 7'
        );
        $result = [];
        foreach ($sql as $row) {
            $result[] = [
                'name' => $row->name,
                'quantity' => (int) $row->quantity,
                'total' => (int) $row->total,
            ];
        }
        $sql = DB::select(
            'SELECT sum(A.quantity) AS quantity, sum(A.total_price) AS total 
            FROM order_detail AS A
            LEFT JOIN shop_products AS B ON A.product_id = B.id
            LEFT JOIN shop_categories AS C ON B.cat_id = C.id
            WHERE A.created_at BETWEEN "' . $startTime . '" AND "' . $endTime . '"
            GROUP BY C.name
            ORDER BY total DESC
            LIMIT 1000 OFFSET 7'
        );
        if (count($sql) > 0) {
            $quantity = 0;
            $total = 0;
            foreach ($sql as $row) {
                $quantity += $row->quantity;
                $total += $row->total;
            }
            $orthers = [
                'name' => 'Danh mục khác',
                'quantity' => $quantity,
                'total' => $total,
            ];
            $result[] = $orthers;
        }
        return $result;
    }

    public static function countProductSold($startTime, $endTime)
    {
        $sql = DB::select(
            'SELECT B.name, sum(A.quantity) AS quantity, sum(A.total_price) AS total 
            FROM order_detail AS A
            LEFT JOIN shop_products AS B ON A.product_id = B.id
            WHERE A.created_at BETWEEN "' . $startTime . '" AND "' . $endTime . '"
            GROUP BY B.name
            ORDER BY total DESC
            LIMIT 7'
        );
        $result = [];
        foreach ($sql as $row) {
            $result[] = [
                'name' => $row->name,
                'quantity' => (int) $row->quantity,
                'total' => (int) $row->total,
            ];
        }
        $sql = DB::select(
            'SELECT sum(A.quantity) AS quantity, sum(A.total_price) AS total 
            FROM order_detail AS A
            LEFT JOIN shop_products AS B ON A.product_id = B.id
            WHERE A.created_at BETWEEN "' . $startTime . '" AND "' . $endTime . '"
            GROUP BY B.name
            ORDER BY total DESC
            LIMIT 1000 OFFSET 7'
        );
        if (count($sql) > 0) {
            $quantity = 0;
            $total = 0;
            foreach ($sql as $row) {
                $quantity += $row->quantity;
                $total += $row->total;
            }
            $orthers = [
                'name' => 'Sản phẩm khác',
                'quantity' => $quantity,
                'total' => $total,
            ];
            $result[] = $orthers;
        }
        return $result;
    }

    public static function countCustomerBuy($startTime, $endTime)
    {
        $sql = DB::select(
            'SELECT C.name, C.email, sum(B.quantity) as quantity, sum(B.total_price) AS total
            FROM `order` AS A
            LEFT JOIN order_detail AS B ON A.id = B.order_id
            LEFT JOIN users AS C ON A.user_id = C.id
            WHERE A.created_at BETWEEN "' . $startTime . '" AND "' . $endTime . '"
            GROUP BY C.id, C.name, C.email
            ORDER BY total DESC
            LIMIT 7'
        );
        $result = [];
        foreach ($sql as $row) {
            $result[] = [
                'name' => $row->name,
                'email' => $row->email,
                'quantity' => (int) $row->quantity,
                'total' => (int) $row->total,
            ];
        }
        $sql = DB::select(
            'SELECT sum(B.quantity) AS quantity, sum(B.total_price) AS total 
            FROM `order` AS A
            LEFT JOIN order_detail AS B ON A.id = B.order_id
            LEFT JOIN users AS C ON A.user_id = C.id
            WHERE A.created_at BETWEEN "' . $startTime . '" AND "' . $endTime . '"
            GROUP BY C.id
            ORDER BY total DESC
            LIMIT 1000 OFFSET 7'
        );
        if (count($sql) > 0) {
            $quantity = 0;
            $total = 0;
            foreach ($sql as $row) {
                $quantity += $row->quantity;
                $total += $row->total;
            }
            $orthers = [
                'name' => 'Khách hàng khác',
                'email' => '',
                'quantity' => $quantity,
                'total' => $total,
            ];
            $result[] = $orthers;
        }
        return $result;
    }
}
