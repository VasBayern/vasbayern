<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopOrderModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopOrderController extends Controller
{
    public function index() {
     
        $orders = ShopOrderModel::all();
        $data = array();
        $data['orders'] = $orders;

        return view('admin.content.shop.order.index', $data);
    }

    public function viewDetail(Request $request) {

        $id = $request->id;
        //$order = ShopOrderModel::with('order_detail')->where('id', $id)->first();
        //$orderDetail = ShopOrderDetailModel::with('product')->where('order_id',$id)->get();
        //return view('admin.content.shop.order.view-detail',$data)->render();
        $sql = DB::select('
            SELECT A.id AS order_id, A.name AS user_name, A.phone, A.address, A.note, A.status, A.total,
            A.promotion, A.payment_method, A.sub_total, A.ship_price, A.shipment, A.promotion, A.payment_method,
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
            WHERE A.id = '.$id .'
            ORDER BY orderDetail_id, product_id ASC'          
        );

        $order = [];
        if(!empty($sql)) {
            foreach($sql as $row) {
                $images = json_decode($row->images);
                foreach($images as $image) {
                    $image = $images[0];
                } 
                $sub_total      =   number_format($row->sub_total) .    ' VNĐ';
                $promotion      =   number_format($row->promotion) .    ' VNĐ';
                $ship_price     =   number_format($row->ship_price) .   ' VNĐ';
                $total          =   number_format($row->total) .        ' VNĐ';
                $unit_price     =   number_format($row->unit_price) .   ' VNĐ';
                $total_price    =   number_format($row->total_price) .  ' VNĐ';

                $order[] = [
                    'order_id'      => $row->order_id,
                    'email'         => $row->email,
                    'user_name'     => $row->user_name,
                    'phone'         => $row->phone,
                    'address'       => $row->address,
                    'note'          => $row->note,
                    'sub_total'     => $sub_total,
                    'promotion'     => $promotion,
                    'ship_price'    => $ship_price,
                    'total'         => $total,
                    'payment_method'=> $row->payment_method,
                    'status'        => $row->status,
                    'shipment'      => $row->shipment,
                    'orderDetail'   => 
                    [
                        'orderDetail_id'    => $row->orderDetail_id,
                        'product'           => 
                        [
                            'product_id'        => $row->product_id,
                            'product_name'      => $row->product_name,
                            'image'            => $image,
                            'quantity'          => $row->quantity,
                            'unit_price'        => $unit_price,
                            'total_price'       => $total_price,
                        ],
                    ],
                ];
            }
        }
        $order = array_values($order);
        $response = [
            'order' => $order,
        ];
        return response($response);
    }

    public function update(Request $request) {
        $input = $request->all();
        try{
            $order = ShopOrderModel::findOrFail($input['id']);
            $order->shipment = $input['shipment'];
            $order->status = $input['status'];
            $order->save();
        } catch(Exception $e) {
            throw "Update failed";
        }
        $response = [
            'status' => 'success',
        ];
        return response($response);
    }
    public function destroy($id) {

        $item = ShopOrderModel::find($id);
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.orders');
    }
}
