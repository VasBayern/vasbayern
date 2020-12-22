<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopOrderDetailModel;
use App\Models\ShopOrderModel;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(Request $request, $id)
    {
        $sort = $request->startDate;
        //$id  1: week, 2: month, 3: year
        $now = date('Y-m-d H:m:s');
        $time = ($id == 1) ? date('Y-m-1 00:00:00') : date('Y-1-1 00:00:00');
        $lastDayAgo = ($id == 1) ? date('Y-m-d 00:00:00', strtotime('last day of last month')) : date('Y-m-d 00:00:00', strtotime('last day of last year'));
        $firstDayAgo = ($id == 1) ? date('Y-m-d 00:00:00', strtotime('first day of last month')) : date('Y-1-1 00:00:00', strtotime('last year'));

        $countUser = User::countUserByTime($time, $now);
        $countUserAgo = User::countUserByTime($firstDayAgo, $lastDayAgo);
        $countOrder = ShopOrderModel::countOrderByTime($time, $now);
        $countOrderAgo = ShopOrderModel::countOrderByTime($firstDayAgo, $lastDayAgo);
        $countProductSold = (int) ShopOrderDetailModel::countProductSoldByTime($time, $now);
        $countProductSoldAgo = (int) ShopOrderDetailModel::countProductSoldByTime($firstDayAgo, $lastDayAgo);
        $revenue = (int) ShopOrderModel::getTotalRevenue($time, $now);
        $revenueAgo = (int) ShopOrderModel::getTotalRevenue($firstDayAgo, $lastDayAgo);

        $revenueByTime = ShopOrderModel::getRevenueByTime($time, $now);
        $revenueByTimeAgo = ShopOrderModel::getRevenueByTime($firstDayAgo, $lastDayAgo);

        $endTime = date('Y-m-d H:m:s');
        switch ($id) {
            case 1:
                $startTime = date('Y-m-d 00:00:00');
                $startTimeAgo = date('Y-m-d 00:00:00', strtotime('first day of last month'));
                $endTimeAgo = date('Y-m-d 23:59:59', strtotime('last day of last month'));
                break;
            case 2:
                $startTime = date("Y-m-d 00:00:00", strtotime('monday this week'));
                $startTimeAgo = date('Y-m-d 00:00:00', strtotime('first day of last month'));
                $endTimeAgo = date('Y-m-d 23:59:59', strtotime('last day of last month'));
                break;
            case 3:
                $startTime = date("Y-m-01 00:00:00");
                break;
            case 4:
                $startTime = date("Y-01-01 00:00:00");
                break;
            default:
                break;
        }

        $response = [
            // 'countUser'         => $countUser,
            // 'countUserAgo'      => $countUserAgo,
            // 'countOrder'        => $countOrder,
            // 'countOrderAgo'     => $countOrderAgo,
            // 'countProductSold'  => $countProductSold,
            // 'countProductSoldAgo' => $countProductSoldAgo,
            // 'revenue'           => $revenue,
            // 'revenueAgo'        => $revenueAgo,
            // 'revenueByTime'     => $revenueByTime,
            // 'revenueByTimeAgo'  => $revenueByTimeAgo,
        ];
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
