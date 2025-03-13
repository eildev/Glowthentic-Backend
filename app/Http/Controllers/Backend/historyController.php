<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Order;
use App\Models\PurchaseDetails;

class historyController extends Controller
{
    public function CurrentHistory($value){
        $date = Carbon::now()->toDateString();
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $currentWeek = Carbon::now()->format('W');
        if($value == "today"){
            $orderData = Order::selectRaw('DATE(created_at) as order_date, SUM(grand_total) as grand_total, SUM(product_quantity) as total_quantity, COUNT(id) as count')
            ->where('status', 'approve')
            ->whereDate('created_at', $date)
            ->groupByRaw('DATE(created_at)')
            ->get();
            $refundData = Order::selectRaw('DATE(created_at) as order_date, SUM(grand_total) as grand_total, SUM(product_quantity) as total_quantity, COUNT(id) as count')
            ->where('status', 'refunded')
            ->whereDate('created_at', $date)
            ->groupByRaw('DATE(created_at)')
            ->get();
            $purchaseData = PurchaseDetails::selectRaw('DATE(created_at) as purchase_date, SUM(grand_total) as grand_total, SUM(quantity) as total_quantity, COUNT(id) as count')
            ->whereDate('created_at', $date)
            ->groupByRaw('DATE(created_at)')
            ->get();
        }
        if($value == "currentYearly"){
            $orderData = Order::selectRaw('DATE(created_at) as order_date,SUM(grand_total) as grand_total, SUM(product_quantity) as total_quantity, COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->where('status','approve')
            ->groupByRaw('DATE(created_at)')
            ->get();
            $refundData = Order::selectRaw('DATE(created_at) as order_date,SUM(grand_total) as grand_total, SUM(product_quantity) as total_quantity, COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->where('status','refunded')
            ->groupByRaw('DATE(created_at)')
            ->get();
            $purchaseData = PurchaseDetails::selectRaw('DATE(created_at) as purchase_date,SUM(grand_total) as grand_total, SUM(quantity) as total_quantity, COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->groupByRaw('DATE(created_at)')
            ->get();
        }
        if($value == "currentMonthly"){
            // dd($year, $month);
            $orderData = Order::selectRaw('DATE(created_at) as order_date,SUM(grand_total) as grand_total, SUM(product_quantity) as total_quantity,COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->where('status','approve')
            ->whereMonth('created_at', $month)
            ->groupByRaw('DATE(created_at)')
            ->get();
            $refundData = Order::selectRaw('DATE(created_at) as order_date,SUM(grand_total) as grand_total, SUM(product_quantity) as total_quantity,COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->where('status','refunded')
            ->whereMonth('created_at', $month)
            ->groupByRaw('DATE(created_at)')
            ->get();
            $purchaseData = PurchaseDetails::selectRaw('DATE(created_at) as purchase_date,SUM(grand_total) as grand_total, SUM(quantity) as total_quantity,COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupByRaw('DATE(created_at)')
            ->get();
        }
        if($value == "currentWeekly"){
            $orderData = Order::selectRaw('DATE(created_at) as order_date,SUM(grand_total) as grand_total, SUM(product_quantity) as total_quantity,COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->where('status','approve')
            ->whereRaw('WEEK(created_at, 1) = '.$currentWeek)
            ->groupByRaw('DATE(created_at)')
            ->get();
            $refundData = Order::selectRaw('DATE(created_at) as order_date,SUM(grand_total) as grand_total, SUM(product_quantity) as total_quantity,COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->where('status','refunded')
            ->whereRaw('WEEK(created_at, 1) = '.$currentWeek)
            ->groupByRaw('DATE(created_at)')
            ->get();
            $purchaseData = PurchaseDetails::selectRaw('DATE(created_at) as purchase_date,SUM(grand_total) as grand_total, SUM(quantity) as total_quantity,COUNT(id) as count')
            ->whereYear('created_at', $year)
            ->whereRaw('WEEK(created_at, 1) = '.$currentWeek)
            ->groupByRaw('DATE(created_at)')
            ->get();
        }


        return response()->json([
            'orderData' => $orderData,
            'purchaseData' => $purchaseData,
            'refundData' => $refundData
        ]);
    }
}
