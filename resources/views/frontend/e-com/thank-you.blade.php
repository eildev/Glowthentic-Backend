@extends('frontend.master')
@section('maincontent')
    <!-- about-area-start -->
    <section class="about-area pt-100 pb-60">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <h2 class=" text-center">Thanks you
                        for Purchase our Product
                    </h2>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="invoice">
                                <div class="invoice overflow-auto pt-0">
                                    <div style="min-width: 600px">
                                        <header>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="javascript:;">
                                                        <img src="{{ asset('frontend/assets/img/logo/horizontal-logo.webp') }}"
                                                            width="80" alt="">
                                                    </a>
                                                </div>
                                                <div class="col company-details">
                                                    <h5 class="name">
                                                        <a target="_blank" href="javascript:;">
                                                            Sobrokom Corporation
                                                        </a>
                                                    </h5>
                                                    <div>+880 1602 08 51 21</div>
                                                    <div>sobrokom.store@gmail.com</div>
                                                    <div>info@sobrokom.store</div>
                                                </div>
                                            </div>
                                        </header>
                                        <main>
                                            <div class="row contacts">
                                                <div class="col invoice-to">
                                                    <div class="text-gray-light" style="font-size:15px">INVOICE TO:</div>
                                                    <h5 class="to">Name: {{ $billing->first_name }}</h5>
                                                    <div class="address">Phone: {{ $billing->phone ?? '' }}</div>
                                                    <div class="email"><a href="{{ $billing->email }}">Email:
                                                            {{ $billing->email }}</a>
                                                    </div>
                                                </div>
                                                <div class="col invoice-details">
                                                    <h5 class="invoice-id">INVOICE: #{{ $order->invoice_number }}</h5>
                                                    <div class="date">Date of Invoice: {{ $order->created_at }}</div>
                                                    <div class="date">Paymentt Status: <span
                                                            class="badge text-bg-warning px-25">Unpaid</span></div>
                                                </div>
                                            </div>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-left">PRODUCT NAME</th>
                                                        <th class="text-right">PRODUCT QUANTITY</th>
                                                        <th class="text-right">WEIGHT</th>
                                                        <th class="text-right">UNIT PRICE</th>
                                                        <th class="text-right">TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order_details as $key => $orderDetail)
                                                        @php
                                                            $productDetails = App\Models\Variant::where(
                                                                'product_id',
                                                                $orderDetail->product_id,
                                                            )->first();
                                                            $productInfo = App\Models\Product::findorFail(
                                                                $orderDetail->product_id,
                                                            );
                                                        @endphp
                                                        <tr>
                                                            <td class="no">{{ $key + 1 }}</td>
                                                            <td class="text-left">{{ $productInfo->product_name }}</td>
                                                            <td class="">{{ $orderDetail->product_quantity }}</td>
                                                            <td class="unit">
                                                                {{ $orderDetail->weight }}{{ $productDetails->unit }}</td>
                                                            <td class="qty">৳{{ $productDetails->regular_price }}</td>
                                                            <td class="total">৳{{ $orderDetail->total_price }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5">SUBTOTAL</td>
                                                        <td colspan="5">৳{{ $order->product_total }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">Dis {{ $order->discount }}%</td>
                                                        <td>৳{{ ($order->product_total * $order->discount) / 100 }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">Shipping Chage</td>
                                                        <td>৳{{ $order->shipping_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">GRAND TOTAL</td>
                                                        <td>৳{{ $order->grand_total }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <style>
                                                .invoice table tbody tr:last-child td {
                                                    padding: 5px 5px 0 5px !important;
                                                    font-size: 16px !important;
                                                }
                                            </style>
                                        </main>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area-end -->
@endsection
