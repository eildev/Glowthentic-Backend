<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>SOBROKOM | Largest Ecommerce Website </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Ajax Header -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend') }}/assets/img/logo/favicon.svg">

        <!-- CSS here -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/animate.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/swiper-bundle.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/magnific-popup.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/spacing.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/meanmenu.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/nice-select.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/fontawesome.min.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/icon-dukamarket.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/main.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/invoice.css">

        <!-- Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />


        {{-- main jquery file --}}
        <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>

        <!-- tinymce js here -->
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document
                    .querySelector(".pageLoader")
                    .style.setProperty("display", "none", "important");
            });
        </script>
    </head>
<body>
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="invoice">
                        <div class="invoice overflow-auto">
                            <div style="min-width: 600px">
                                <header>
                                    <div class="row">
                                        <div class="col">
                                            <a href="javascript:;">
                                                <img src="https://sobrokom.store/frontend/assets/img/logo/horizontal-logo.webp" style="height:100px; width:100px;position:absolute">
                                            </a>
                                        </div>
                                        <div class="col company-details">
                                            <h2 class="name">
                                                <a target="_blank" href="javascript:;">
                                                    Sobrokom Corporation
                                                </a>
                                            </h2>
                                            <div>+880 1602 08 51 21</div>
                                            <div>sobrokom.store@gmail.com</div>
                                            <div>info@sobrokom.store</div>
                                        </div>
                                    </div>
                                </header>
                                <main>
                                    @php

                                        $billInfo = App\Models\OrderBillingDetails::where('order_id', $data['order']['id'])->first();
                                    @endphp
                                    <div class="row contacts" style="position:relative">
                                        <div class="col col-md-6 invoice-to">
                                            <div class="text-gray-light">INVOICE TO:</div>
                                            <h2 class="to">{{$billInfo->first_name}}</h2>
                                            <div class="address">{{$billInfo->address_1 ?? ''}}</div>
                                            <div class="email"><a href="{{$billInfo->email}}">{{$billInfo->email}}</a>
                                            </div>
                                        </div>
                                        <div class="col col-md-6 invoice-details" style="position:absolute;top:10px;right:10px">
                                            <h3 class="invoice-id">INVOICE: #{{ $data['invoice'] }}</h3>
                                            <div class="date">Date of Invoice: {{ $billInfo->created_at }}</div>
                                            <div class="date">Paymentt Status: <span class="badge text-bg-warning px-25">Unpaid</span></div>
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
                                            @php
                                                $orderDetails = App\Models\OrderDetails::where('order_id', $data['order']['id'])->get();
                                            @endphp
                                            @foreach ($orderDetails as $key => $orderDetail)
                                            <tr>
                                                <td class="no">{{ $key+1 }}</td>
                                                <td class="text-left">
                                                   <p>name</p>
                                                </td>
                                                <td class="">{{ $orderDetail->product_quantity }}</td>
                                                <td class="unit">1kg</td>
                                                <td class="qty">250</td>
                                                <td class="total">{{ $orderDetail->total_price }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">SUBTOTAL</td>
                                                <td colspan="5">{{ $data['order']['product_total'] }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">Dis {{ $order->discount }}%</td>
                                                <td>{{ ((($data['order']['product_total'] * $data['order']['discount'])/100)+$data['order']['product_total'] ) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">Shipping Chage</td>
                                                <td>{{ $data['order']['shipping_amount']}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">GRAND TOTAL</td>
                                                <td>{{ $data['order']['grand_total'] }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="thanks">Thank you!</div>
                                    <div class="notices">
                                        <div>NOTICE:</div>
                                        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after
                                            50
                                            days.</div>
                                    </div>
                                </main>
                                <footer>Invoice was created on a computer and is valid without the signature and seal.
                                </footer>

                            </div>
                            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend') }}/assets/js/jquery.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/waypoints.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/swiper-bundle.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/nice-select.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/slick.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/magnific-popup.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/counterup.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/wow.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/isotope-pkgd.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/imagesloaded-pkgd.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/countdown.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/ajax-form.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/meanmenu.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/main.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>
