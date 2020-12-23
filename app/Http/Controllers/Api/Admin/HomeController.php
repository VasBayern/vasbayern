<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelperModel;
use App\Models\ShopOrderDetailModel;
use App\Models\ShopOrderModel;
use App\Models\User;
use DateTime;
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
        $endTime = date('Y-m-d H:i:s');
        // 0: day, 1: week, 2: month, 3: year
        switch ($id) { 
            case 0:
                $unitTime = 'hour';
                $formatTime = 'Y-m-d H';
                $startTime = date('Y-m-d 00');
                $startTimeAgo = date('Y-m-d 00', strtotime('-1 day'));
                $endTimeAgo = date('Y-m-d 23', strtotime('-1 day'));
                break;
            case 1:
                $unitTime = 'day';
                $formatTime = 'Y-m-d';
                $startTime = date($formatTime, strtotime('monday this week'));
                $startTimeAgo = date($formatTime, strtotime('monday last week'));
                $endTimeAgo = date($formatTime, strtotime('sunday last week'));
                break;
            case 2:
                $unitTime = 'day';
                $formatTime = 'Y-m-d';
                $startTime = date("Y-m-01");
                $startTimeAgo = date($formatTime, strtotime('first day of last month'));
                $endTimeAgo = date($formatTime, strtotime('last day of last month'));
                break;
            case 3:
                $unitTime = 'month';
                $formatTime = 'Y-m';
                $startTime = date("Y-01");
                $startTimeAgo = date($formatTime, strtotime('last year January 1st'));
                $endTimeAgo = date($formatTime, strtotime('last year December 31st'));
                break;
            default:
                break;
        }
        $countUser = User::countUserByTime($startTime, $endTime);
        $countUserAgo = User::countUserByTime($startTimeAgo, $endTimeAgo);
        $countOrder = ShopOrderModel::countOrderByTime($startTime, $endTime);
        $countOrderAgo = ShopOrderModel::countOrderByTime($startTimeAgo, $endTimeAgo);
        $countProductSold = (int) ShopOrderDetailModel::countProductSoldByTime($startTime, $endTime);
        $countProductSoldAgo = (int) ShopOrderDetailModel::countProductSoldByTime($startTimeAgo, $endTimeAgo);
        $revenue = (int) ShopOrderModel::getTotalRevenue($startTime, $endTime);
        $revenueAgo = (int) ShopOrderModel::getTotalRevenue($startTimeAgo, $endTimeAgo);
        $revenueByTime =  ShopOrderModel::getRevenueByTime($startTime, $endTime, $unitTime, $formatTime);
        $revenueByTimeAgo =  ShopOrderModel::getRevenueByTime($startTimeAgo, $endTimeAgo, $unitTime, $formatTime);

        $response = [
            'sort'              => (int) $id,
            'countUser'         => $countUser,
            'countUserAgo'      => $countUserAgo,
            'countOrder'        => $countOrder,
            'countOrderAgo'     => $countOrderAgo,
            'countProductSold'  => $countProductSold,
            'countProductSoldAgo' => $countProductSoldAgo,
            'revenue'           => $revenue,
            'revenueAgo'        => $revenueAgo,
            'revenueByTime'     => $revenueByTime,
            'revenueByTimeAgo'  => $revenueByTimeAgo,
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
