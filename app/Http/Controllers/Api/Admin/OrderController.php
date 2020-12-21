<?php

namespace App\Http\Controllers\Api\Admin;

use App\Events\SuccessShipped;
use App\Http\Controllers\Controller;
use App\Mail\SuccessShippedMail;
use App\Models\ShopOrderModel;
use App\Models\ShopProductModel;
use App\Models\ShopProductPropertiesModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = ShopOrderModel::all();
        $data = array();
        $data['orders'] = $orders;
        return view('admin.shop.order.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sql = DB::select('SELECT A.id AS order_id, A.name AS user_name, A.phone, A.address, A.note, A.status, A.total,
            A.promotion, A.payment_method, A.sub_total, A.ship_price, A.shipment,
            B.id AS orderDetail_id, B.quantity, B.unit_price, B.total_price, 
            C.id AS product_id, C.name AS product_name, C.images,
            D.email,
            E.id AS size_id, E.name AS size_name,
            F.id AS color_id, F.name AS color_name 
            FROM `order` AS A
            INNER JOIN `order_detail` AS B 
            ON A.id = B.order_id
            INNER JOIN `shop_products` AS C
            ON B.product_id = C.id
            INNER JOIN `users` AS D
            ON A.user_id = D.id
            INNER JOIN `sizes` AS E
            ON B.size_id = E.id
            INNER JOIN `colors` AS F
            ON B.color_id = F.id
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
                        'orderDetail_id'    => $row->orderDetail_id,
                        'quantity'          => $row->quantity,
                        'unit_price'        => $unit_price,
                        'total_price'       => $total_price,
                        'product'           => [
                            'id'            => $row->product_id,
                            'name'          => $row->product_name,
                            'image'         => $image,
                        ],
                        'size'              => [
                            'id'            => $row->size_id,
                            'name'          => $row->size_name
                        ],
                        'color'              => [
                            'id'            => $row->color_id,
                            'name'          => $row->color_name
                        ]
                    ];
                    continue;
                }
                $order[$row->order_id]  = [
                    'order_id'          => $row->order_id,
                    'email'             => $row->email,
                    'name'              => $row->user_name,
                    'phone'             => $row->phone,
                    'address'           => $row->address,
                    'note'              => $row->note,
                    'sub_total'         => $sub_total,
                    'ship_price'        => $ship_price,
                    'promotion'         => $promotion,
                    'total'             => $total,
                    'shipment'          => $row->shipment,
                    'payment_method'    => $row->payment_method,
                    'status'            => $row->status,
                    'url'               => url('admin/orders/' . $row->order_id),
                    'orderDetails'      => [
                        [
                            'orderDetail_id'    => $row->orderDetail_id,
                            'quantity'          => $row->quantity,
                            'unit_price'        => $unit_price,
                            'total_price'       => $total_price,
                            'product'           => [
                                'id'            => $row->product_id,
                                'name'          => $row->product_name,
                                'image'         => $image,
                            ],
                            'size'              => [
                                'id'            => $row->size_id,
                                'name'          => $row->size_name
                            ],
                            'color'              => [
                                'id'            => $row->color_id,
                                'name'          => $row->color_name
                            ]
                        ]
                    ]
                ];
            }
        }
        $response = [
            'order' => array_values($order),
        ];
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input          = $request->all();
        $status         = $input['status'];
        $products       = $input['product_id'];
        $sizes          = $input['size_id'];
        $colors         = $input['color_id'];
        $quantities     = $input['quantity'];
        $order          = ShopOrderModel::findOrFail($id);
        $statusOrigin   = $order->status;
        if (isset($input['shipment'])) {
            $order->shipment = $input['shipment'];
        }
        $order->status  = $status;
        $order->save();
        DB::beginTransaction();
        try {
            if ($statusOrigin == 1) {
                if ($status == 2 || $status == 3) {
                    foreach ($products as $key => $product_id) {
                        ShopProductPropertiesModel::where('product_id', $product_id)->where('size_id', $sizes[$key])->where('color_id', $colors[$key])->decrement('quantity', $quantities[$key]);
                        $property = ShopProductPropertiesModel::where('product_id', $product_id)->where('size_id', $sizes[$key])->where('color_id', $colors[$key])->first();
                        if ($property['quantity'] == 0) {
                            $property->delete();
                        }
                    }
                }
            } elseif ($statusOrigin == 2) {
                if ($status == 0) {
                    foreach ($products as $key => $product_id) {
                        //delete then rollback
                        $property = ShopProductPropertiesModel::where('product_id', $product_id)->where('size_id', $sizes[$key])->where('color_id', $colors[$key])->first();
                        if (isset($property)) {
                            ShopProductPropertiesModel::where('product_id', $product_id)->where('size_id', $sizes[$key])->where('color_id', $colors[$key])->increment('quantity', $quantities[$key]);
                        } else {
                            $item               = new ShopProductPropertiesModel();
                            $item->product_id   = $product_id;
                            $item->color_id     = $colors[$key];
                            $item->size_id      = $sizes[$key];
                            $item->quantity     = $quantities[$key];
                            $item->save();
                        }
                    }
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        if ($status == 3) {
            $email = $input['email'];
            event(new SuccessShipped($email));
        }
        $response = [
            'success'   => true,
            'id'        => $id,
            'status'    => (int) $order->status,
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ShopOrderModel::find($id);
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $item->id,
        ];
        return response()->json($response, 200);
    }
}
