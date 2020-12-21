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
    public function index(Request $request)
    {
        $sort = $request->sort;
        $sort = 'month';
        $now = date('Y-m-d H:m:s');
        $time = ($sort == "month") ? date('Y-m-1 00:00:00') : date('Y-1-1 00:00:00');
        $lastDayAgo = ($sort == "month") ? date('Y-m-d 00:00:00',strtotime('last day of last month')) : date('Y-m-d 00:00:00',strtotime('last day of last year'));
        $firstDayAgo = ($sort == "month") ? date('Y-m-d 00:00:00',strtotime('first day of last month')) : date('Y-1-1 00:00:00', strtotime('last year'));

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

        $response = [
            'countUser'         => $countUser,
            'countUserAgo'      => $countUserAgo,
            'countOrder'        => $countOrder,
            'countOrderAgo'     => $countOrderAgo,
            'countProductSold'  => $countProductSold,
            'countProductSoldAgo'=> $countProductSoldAgo,
            'revenue'           => $revenue,
            'revenueAgo'        => $revenueAgo,
            'revenueByTime'     => $revenueByTime,
            'revenueByTimeAgo'  => $revenueByTimeAgo,
        ];
        return response()->view('admin.dashboard', $response, 200);
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
    public function show($id)
    {
        //
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
