<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Order;
 use Illuminate\Support\Facades\DB;

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

        }


        return response()->json([
            'orderData' => $orderData,

            'refundData' => $refundData
        ]);
    }



    public function OrderChart(){
       try{
        $lastWeek = Carbon::now()->subDays(6)->startOfDay();

        $orders = DB::table('orders')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as new_orders"),
                DB::raw("SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_orders"),
                DB::raw("SUM(CASE WHEN status = 'Delivering' THEN 1 ELSE 0 END) as delivered_orders")
            )
            ->where('created_at', '>=', $lastWeek)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'ASC')
            ->get();
        //   dd($orders);
        return response()->json($orders);
       }
       catch(\Exception $e){
        return response()->json([
            'error' => $e->getMessage()
        ]);
       }
    }


    public function categoryStockChart(){
        $data = DB::table('categories')
        ->join('products', 'categories.id', '=', 'products.category_id')
        ->join('product_stocks', 'products.id', '=', 'product_stocks.product_id')
        ->select('categories.categoryName', DB::raw('SUM(product_stocks.StockQuantity) as total_stock'))
        ->groupBy('categories.categoryName')
        ->get();

       return response()->json($data);
    }

    public function monthlyChartData()
    {
        $data = DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(grand_total) as total_sales'))
            ->whereYear('created_at', date('Y'))
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Convert month number to name
        $labels = [];
        $sales = [];

        foreach ($data as $item) {
            $labels[] = date("F", mktime(0, 0, 0, $item->month, 1)); // January, February...
            $sales[] = $item->total_sales;
        }

        return response()->json([
            'labels' => $labels,
            'sales' => $sales
        ]);
    }
}
