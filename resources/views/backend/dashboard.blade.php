@extends('backend.master')
@section('admin')

<style>
 .card.bg-white {
    background-color: #ffffff;
}
.card.text-black {
    color: #19c0d6dc;
}
.card.border-black {
    border: 1px solid #5eb7eb;
}
.card.shadow {
    box-shadow: 0 4px 12px rgba(104, 171, 202, 0.1);
}
.card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
    box-shadow: 0 6px 16px rgba(5, 181, 212, 0.15);
}
.progress-bar.bg-black {
    background-color: #54dce0;
}

.icon-visitors {
    color: #007bff;
}
.icon-products {
    color: #28a745;
}
.icon-orders {
    color: #ffc107;
}
.icon-users {
    color: #6f42c1;
}
</style>
    @php
        $products = App\Models\Product::whereHas('varient')->count();
        $users = App\Models\User::where('role', 'user')->count();
        $total_orders = App\Models\Order::all()->count();
        $new_orders = App\Models\Order::where('status', 'pending')->count();
        $approve_orders = App\Models\Order::where('status', 'approve')->count();
        $processing_orders = App\Models\Order::where('status', 'processing')->count();
        $delivering_orders = App\Models\Order::where('status', 'delivering')->count();
        $completed_order = App\Models\Order::where('status', 'completed')->count();
        $refunding_order = App\Models\Order::where('status', 'refunding')->count();
        $refunded_order = App\Models\Order::where('status', 'refunded')->count();
        $canceled_order = App\Models\Order::where('status', 'canceled')->count();
        $visitors = App\Models\UserTracker::all()->count();
        use Carbon\Carbon;
        $visitorsToday = App\Models\UserTracker::whereDate('created_at', Carbon::today())->count();
          $total_stock = App\Models\ProductStock::sum('StockQuantity');
    @endphp
  <div class="container-fluid page-content py-4">
    <!-- Title -->
    <div class="mb-4">
        <h4 class="fw-bold">Dashboard Overview</h4>
        <span class="badge bg-info p-2">All Time History</span>
    </div>

   <!-- Top Statistics -->
<div class="row g-3 mb-4">
    <!-- Visitors -->
    <div class="col-md-3">
        <div class="card bg-white text-black h-100 shadow border-black">
            <a href="{{ route('user-tracker.show') }}" class="text-black text-decoration-none">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-chart-line fa-2x me-3" style="color: #007bff;"></i>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-bold">Visitors</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Today</span>
                            <span class="fw-bold">{{ $visitorsToday }}</span>
                        </div>
                        <div class="progress my-2" style="height: 5px;">
                            <div class="progress-bar bg-black" style="width: 100%; opacity: 0.5;"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small>Total</small>
                            <small class="fw-bold">{{ $visitors }}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Products -->
    <div class="col-md-3">
        <div class="card bg-white text-black h-100 shadow border-black">
            <a href="{{ route('product.view') }}" class="text-black text-decoration-none">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-shopping-cart fa-2x me-3" style="color: #28a745;"></i>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-bold">Total Products</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">{{ $products }}</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- New Orders -->
    <div class="col-md-2">
        <div class="card bg-white text-black h-100 shadow border-black">
            <a href="{{ route('new.order') }}" class="text-black text-decoration-none">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-box fa-2x me-3" style="color: #ffc107;"></i>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-bold">New Orders</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">{{ $new_orders }}</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Users -->
    <div class="col-md-2">
        <div class="card bg-white text-black h-100 shadow border-black">
            <a href="{{ route('all.users') }}" class="text-black text-decoration-none">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-users fa-2x me-3" style="color: #6f42c1;"></i>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-bold">Users</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">{{ $users }}</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Total Stock -->
    <div class="col-md-2">
        <div class="card bg-white text-black h-100 shadow border-black">
            <a href="{{ route('stock.view') }}" class="text-black text-decoration-none">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-warehouse fa-2x me-3" style="color: #dc3545;"></i>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-bold">Total Stock</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">{{ $total_stock }}</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>



            <!-- Order Chart -->
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Last Week Order History</h6>
                            <canvas id="orderChart" height="100"></canvas>
                        </div>
                    </div>
                </div>

        <div class="col-6">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h6 class="card-title mb-3">Monthly Sales Income</h6>
                    <canvas id="monthlySalesChart" height="100"></canvas>
                </div>
            </div>
        </div>




    </div>

    <!-- Order Summary Table + Categorywise Chart -->
    <div class="row g-3">
        <!-- Order Table -->
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h6 class="card-title mb-3">Order Summary</h6>
                    <p class="mb-2">Total Orders: <strong>{{ $total_orders }} Nos</strong></p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statuses = [
                                        'New' => ['count' => $new_orders, 'route' => 'new.order'],
                                        'Confirm' => ['count' => $approve_orders, 'route' => 'order.confirmed'],
                                        'Process' => ['count' => $processing_orders, 'route' => 'order.processed'],
                                        'Delivery' => ['count' => $delivering_orders, 'route' => 'order.delivering'],
                                        'Completed' => ['count' => $completed_order, 'route' => 'order.completed'],

                                        'Canceled' => ['count' => $canceled_order, 'route' => 'order.canceled'],
                                    ];
                                @endphp
                                @foreach($statuses as $status => $data)
                                    <tr>
                                        <td>{{ $status }}</td>
                                        <td>{{ $data['count'] }}</td>
                                        <td><a href="{{ route($data['route']) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Stock Pie Chart -->
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h6 class="card-title mb-3">Categorywise Product Stock</h6>
                    <canvas id="categoryPieChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script>

document.addEventListener("DOMContentLoaded", function () {
    $.ajax({
        url: "{{ route('order.chart.data') }}",
        type: "GET",
        success: function (data) {
            const labels = data.map(item => item.date);
            const newOrders = data.map(item => item.new_orders);
            const completedOrders = data.map(item => item.completed_orders);
            const deliveredOrders = data.map(item => item.delivered_orders);

            const ctx = document.getElementById("orderChart").getContext("2d");
            new Chart(ctx, {
                type: "line", // Line chart
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "New Orders",
                            data: newOrders,
                            borderColor: "#007bff",
                            backgroundColor: "rgba(0, 123, 255, 0.1)",
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: "Completed Orders",
                            data: completedOrders,
                            borderColor: "#28a745",
                            backgroundColor: "rgba(40, 167, 69, 0.1)",
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: "Delivered Orders",
                            data: deliveredOrders,
                            borderColor: "#ffc107",
                            backgroundColor: "rgba(255, 193, 7, 0.1)",
                            fill: true,
                            tension: 0.4
                        }
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "bottom",
                        },
                        tooltip: {
                            mode: "index",
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Orders'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    }
                }
            });
        },
        error: function () {
            alert("Chart data load করতে সমস্যা হচ্ছে!");
        }
    });
});



document.addEventListener("DOMContentLoaded", function () {
    $.ajax({
        url: "{{ route('monthly.chart.data') }}",
        type: "GET",
        success: function (res) {
            const ctx = document.getElementById('monthlySalesChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: res.labels,
                    datasets: [{
                        label: 'Monthly Sales Income',
                        data: res.sales,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return '৳' + value; // Bangladeshi Taka symbol
                                }
                            }
                        }
                    }
                }
            });
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    $.ajax({
        url: "{{ route('chart.category.stock') }}",
        type: "GET",
        success: function (data) {
            const labels = data.map(item => item.categoryName);
            const stockData = data.map(item => item.total_stock);

            const colors = [
                '#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1',
                '#17a2b8', '#fd7e14', '#6610f2', '#20c997', '#e83e8c'
            ];

            const ctx = document.getElementById("categoryPieChart").getContext("2d");
            new Chart(ctx, {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Total Stock",
                        data: stockData,
                        backgroundColor: colors.slice(0, labels.length),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        },
        error: function () {
            alert("ডেটা লোড করতে সমস্যা হচ্ছে!");
        }
    });
});















        const monthandyear = document.querySelector('.monthandyear');
        monthandyear.addEventListener('change', function(e) {
            alert(this.value)
        });

        function historyFunction(resultValue) {
            $.ajax({
                url: "/current-history/" + resultValue.value,
                type: "GET",
                success: function(result) {

                    let order_date = '';
                    let total_order = 0;
                    let order_quantity = 0;
                    let order_amount = 0;
                    $.each(result.orderData, function(key, value) {
                        order_quantity += parseFloat(value.total_quantity);
                        order_amount += parseFloat(value.grand_total);
                        total_order += parseFloat(value.count);
                        order_date = value.order_date;
                    });
                    let refund_date = '';
                    let total_refund = 0;
                    let refund_quantity = 0;
                    let refund_amount = 0;
                    $.each(result.refundData, function(key, value) {
                        refund_quantity += parseFloat(value.total_quantity);
                        refund_amount += parseFloat(value.grand_total);
                        total_refund += parseFloat(value.count);
                        refund_date = value.order_date;
                    });

                    let purchase_date = '';
                    let total_purchase = 0;
                    let purchase_quantity = 0;
                    let purchase_amount = 0;
                    $.each(result.purchaseData, function(key, value) {
                        purchase_quantity += parseFloat(value.total_quantity);
                        purchase_amount += parseFloat(value.grand_total);
                        total_purchase += parseFloat(value.count);
                        purchase_date = value.purchase_date;
                    });


                    $('.order_date').text(order_date);
                    $('.total_order').text(total_order);
                    $('.order_quantity').text(order_quantity);
                    $('.order_amount').text(order_amount);

                    $('.purchase_date').text(purchase_date);
                    $('.purchase_quantity').text(purchase_quantity);
                    $('.total_purchase').text(total_purchase);
                    $('.purchase_amount').text(purchase_amount);

                    $('.refund_date').text(refund_date);
                    $('.refund_quantity').text(refund_quantity);
                    $('.total_refund').text(total_refund);
                    $('.refund_amount').text(refund_amount);
                }
            });
        }
    </script>
@endsection
