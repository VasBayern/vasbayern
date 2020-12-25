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
        // 0: day, 1:week, 2:month
        $startDate = '';
        switch ($id) {
            case 1:
                $timeUnit = 'day';
                $timeFormat = 'Y/m/d';
                $startDate = $request->startDate ? $request->startDate : date($timeFormat, strtotime('-1 month'));
                break;
            case 2:
                $timeUnit = 'week';
                $timeFormat = 'Y/m/d';
                $startDate = $request->startDate ? $request->startDate : date($timeFormat, strtotime('-8 week'));
                break;
            case 3:
                $timeUnit = 'month';
                $timeFormat = 'Y/m';
                $startDate = $request->startDate ? $request->startDate : date($timeFormat, strtotime('-1 year'));
                break;
            default:
                break;
        }
        $endDate = $request->endDate ? $request->endDate : date('Y/m/d');

        $countUser = (int) User::countUserByTime($startDate, $endDate);
        $countOrder = (int) ShopOrderModel::countOrderByTime($startDate, $endDate);
        $countProductSold = (int) ShopOrderDetailModel::countProductSoldByTime($startDate, $endDate);
        $revenue = (int) ShopOrderModel::getTotalRevenue($startDate, $endDate);
        $revenueByTime = ShopOrderModel::getRevenueByTime($startDate, $endDate, $timeUnit, $timeFormat);
        $categoryDetail = ShopOrderDetailModel::countCategorySold($startDate, $endDate);
        $productDetail = ShopOrderDetailModel::countProductSold($startDate, $endDate);
        $customerDetail = ShopOrderDetailModel::countCustomerBuy($startDate, $endDate);
        // //$endTime = date('Y-m-d H:i:s');

        // // // 0: day, 1: week, 2: month, 3: year
        // // switch ($id) {
        // //     case 0:
        // //         $unitTime = 'hour';
        // //         $formatTime = 'Y-m-d H';
        // //         $startTime = date('Y-m-d 00');
        // //         $startTimeAgo = date('Y-m-d 00', strtotime('-1 day'));
        // //         $endTimeAgo = date('Y-m-d 23', strtotime('-1 day'));
        // //         break;
        // //     case 1:
        // //         $unitTime = 'day';
        // //         $formatTime = 'Y-m-d';
        // //         $startTime = date($formatTime, strtotime('monday this week'));
        // //         $startTimeAgo = date($formatTime, strtotime('monday last week'));
        // //         $endTimeAgo = date($formatTime, strtotime('sunday last week'));
        // //         break;
        // //     case 2:
        // //         $unitTime = 'day';
        // //         $formatTime = 'Y-m-d';
        // //         $startTime = date("Y-m-01");
        // //         $startTimeAgo = date($formatTime, strtotime('first day of last month'));
        // //         $endTimeAgo = date($formatTime, strtotime('last day of last month'));
        // //         break;
        // //     case 3:
        // //         $unitTime = 'month';
        // //         $formatTime = 'Y-m';
        // //         $startTime = date("Y-01");
        // //         $startTimeAgo = date($formatTime, strtotime('last year January 1st'));
        // //         $endTimeAgo = date($formatTime, strtotime('last year December 31st'));
        // //         break;
        // //     default:
        // //         break;
        // // }

        // $countUser = User::countUserByTime($startDate, $endDate);
        // //$countUserAgo = User::countUserByTime($startTimeAgo, $endTimeAgo);
        // $countOrder = ShopOrderModel::countOrderByTime($startDate, $endDate);
        // // $countOrderAgo = ShopOrderModel::countOrderByTime($startTimeAgo, $endTimeAgo);
        // $countProductSold = (int) ShopOrderDetailModel::countProductSoldByTime($startDate, $endDate);
        // //$countProductSoldAgo = (int) ShopOrderDetailModel::countProductSoldByTime($startTimeAgo, $endTimeAgo);
        // $revenue = (int) ShopOrderModel::getTotalRevenue($startDate, $endDate);
        // //$revenueAgo = (int) ShopOrderModel::getTotalRevenue($startTimeAgo, $endTimeAgo);
        // $revenueByTime =  ShopOrderModel::getRevenueByTime($startDate, $endDate, $unitTime, $formatTime);
        // //$revenueByTimeAgo =  ShopOrderModel::getRevenueByTime($startTimeAgo, $endTimeAgo, $unitTime, $formatTime);

        // $categoryDetail = ShopOrderDetailModel::countCategorySold($startDate, $endDate);
        // $productDetail = ShopOrderDetailModel::countProductSold($startDate, $endDate);
        // $customerDetail = ShopOrderDetailModel::countCustomerBuy($startDate, $endDate);
        $response = [
            'sort'              => (int) $id,
            'countUser'         => $countUser,
            //'countUserAgo'      => $countUserAgo,
            'countOrder'        => $countOrder,
            //'countOrderAgo'     => $countOrderAgo,
            'countProductSold'  => $countProductSold,
            //'countProductSoldAgo' => $countProductSoldAgo,
            'revenue'           => $revenue,
            //'revenueAgo'        => $revenueAgo,
            'revenueByTime'     => $revenueByTime,
            //'revenueByTimeAgo'  => $revenueByTimeAgo,
            'categoryDetail'    => $categoryDetail,
            'productDetail'     => $productDetail,
            'customerDetail'    => $customerDetail,
            'date' => $startDate . '------' . $endDate
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
