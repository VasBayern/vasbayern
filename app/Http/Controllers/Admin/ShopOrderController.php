<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopOrderModel;
use App\Models\ShopProductPropertiesModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopOrderController extends Controller
{
    public function index()
    {

        $orders = ShopOrderModel::all();
        $data = array();
        $data['orders'] = $orders;

        return view('admin.content.order.index', $data);
    }

    public function viewDetail(Request $request)
    {
        $id = $request->id;
        $sql = DB::select('SELECT A.id AS order_id, A.name AS user_name, A.phone, A.address, A.note, A.status, A.total,
            A.promotion, A.payment_method, A.sub_total, A.ship_price, A.shipment,
            B.id AS orderDetail_id, B.quantity, B.unit_price, B.total_price, 
            C.id AS product_id, C.name AS product_name, C.images,
            D.email
            FROM `order` AS A
            INNER JOIN `order_detail` AS B 
            ON A.id = B.order_id
            INNER JOIN `shop_products` AS C
            ON B.product_id = C.id
            INNER JOIN `users` AS D
            ON A.user_id = D.id
            WHERE A.id = ' . $id . '
            ORDER BY orderDetail_id, product_id ASC');

        if (!empty($sql)) {
            $order = [];
            foreach ($sql as $row) {
                $images = json_decode($row->images);
                foreach ($images as $image) {
                    $image = $images[0];
                }
                $sub_total      =   number_format($row->sub_total) .    ' VNĐ';
                $promotion      =   number_format($row->promotion) .    ' VNĐ';
                $ship_price     =   number_format($row->ship_price) .   ' VNĐ';
                $total          =   number_format($row->total) .        ' VNĐ';
                $unit_price     =   number_format($row->unit_price) .   ' VNĐ';
                $total_price    =   number_format($row->total_price) .  ' VNĐ';

                if (array_key_exists($row->order_id, $order)) {
                    $order[$row->order_id]['orderDetails'][] = [
                        'orderDetail_id' => $row->orderDetail_id,
                        'quantity' => $row->quantity,
                        'unit_price' => $unit_price,
                        'total_price' => $total_price,
                        'product' => [
                            'id' => $row->product_id,
                            'name' => $row->product_name,
                            'image' => $image,
                        ]
                    ];
                    continue;
                }
                $order[$row->order_id] = [
                    'order_id' => $row->order_id,
                    'name' => $row->user_name,
                    'phone' => $row->phone,
                    'address' => $row->address,
                    'note' => $row->note,
                    'sub_total' => $sub_total,
                    'ship_price' => $ship_price,
                    'promotion' => $promotion,
                    'total' => $total,
                    'shipment' => $row->shipment,
                    'payment_method' => $row->payment_method,
                    'status' => $row->status,
                    'orderDetails' => [
                        [
                            'orderDetail_id' => $row->orderDetail_id,
                            'quantity' => $row->quantity,
                            'unit_price' => $unit_price,
                            'total_price' => $total_price,
                            'product' => [
                                'id' => $row->product_id,
                                'name' => $row->product_name,
                                'image' => $image,
                            ]
                        ]
                    ]
                ];
            }
        }
        $response = [
            'order' => $order,
        ];

        $returnHTML = view('admin.content.order.detail', $response)->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );

        // $returnHTML = view('admin.content.order.detail')->with('order', $order)->render();
        // return response()->json(array('success' => true, 'html'=>$returnHTML));
        //return response($response);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $order = ShopOrderModel::findOrFail($input['id']);
            $order->shipment = $input['shipment'];
            $order->status = $input['status'];
            $order->save();

        } catch (Exception $e) {
            throw "Update failed";
        }
        $response = [
            'status' => 'success',
        ];
        return response($response);
    }
    public function destroy($id)
    {

        $item = ShopOrderModel::find($id);
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.orders');
    }
}
