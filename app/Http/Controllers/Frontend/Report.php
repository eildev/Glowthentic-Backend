<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;
class Report extends Controller
{
    public function monthlySalesReport(){
       // Optionally, accept month and year as request parameters
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $monthlySalesReport = Product::query()
            ->select([
                DB::raw('ROW_NUMBER() OVER (ORDER BY products.product_name) AS sl'),
                'products.product_name',
                DB::raw('SUM(order_details.product_quantity) AS sales_quantity'),
                DB::raw('AVG(variants.regular_price) AS product_price'),
                DB::raw('AVG(order_details.product_price) AS sales_price'),
                DB::raw('SUM(variants.regular_price * order_details.product_quantity) AS total_product_price'),
                DB::raw('SUM(order_details.total_price) AS total_sales_price'),
                DB::raw('(SUM(variants.regular_price * order_details.product_quantity) - SUM(order_details.total_price)) AS price_difference'),
            ])
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->join('variants', 'order_details.variant_id', '=', 'variants.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->groupBy('products.product_name')
            ->get();

    }
}
