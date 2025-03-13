@extends('frontend.master')
@section('maincontent')
    <!-- breadcrumb-area-start -->
    <div class="breadcrumb__area grey-bg pt-5 pb-5">
        <div class="container" style="margin-top:80px">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-breadcrumb__content">
                        <div class="tp-breadcrumb__list">
                            <span class="tp-breadcrumb__active"><a href="{{ route('home') }}">Home</a></span>
                            <span class="dvdr">/</span>
                            <span>Tracking Page</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- shop-area-start -->
    <section class="shop-area-start grey-bg pb-200">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__filter-content mb-40">
                        <div class="row align-items-center py-2 text-center">
                            <form action="{{ route('order.tracking.invoice') }}" method="GET">
                                <div class="d-flex">
                                    <input type="text" name="search" placeholder="Search your Invoice Number"
                                        class="form-control rounded-0 rounded-start"
                                        value="{{ !empty($searchTag) ? $searchTag : '' }}">
                                    <button type="submit" class="tp-btn rounded-0 rounded-end">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @if (!empty($trackes))
                        @if ($trackes->count() > 0)
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Date</th>
                                            <th class="product-thumbnail">Invoice</th>
                                            <th class="cart-product-name">Phone Number</th>
                                            <th class="product-price">Product Qty</th>
                                            <th class="product-quantity">Grand Total</th>
                                            <th class="product-remove">Order Address</th>
                                            <th class="product-remove">Status</th>
                                            <th class="product-remove">Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trackes as $order)
                                            @php
                                                $address = App\Models\OrderBillingDetails::where('order_id', $order->id)->first();
                                            @endphp
                                            <tr>
                                                <td class="product-thumbnail">
                                                    {{ $order->created_at }}
                                                </td>
                                                <td class="product-name">
                                                    {{ $order->invoice_number }}
                                                </td>
                                                <td class="product-price">
                                                    {{ $order->user_identity }}
                                                </td>
                                                <td class="product-quantity">
                                                    {{ $order->product_quantity }}
                                                </td>
                                                <td class="product-subtotal">
                                                    {{ $order->grand_total }}
                                                </td>
                                                <td class="product-remove">

                                                    {{ $address->address_1 ?? '' }}
                                                </td>
                                                <td class="product-remove text-info">
                                                    {{ $order->status }}
                                                </td>
                                                <td class="product-remove">
                                                    <a style="color: #9e54a1"
                                                        href="{{ url('/pdf/genarate/' . $order->id . '/' . $order->invoice_number) }}">Download</a>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="invoice">
                                <div class="toolbar hidden-print">
                                    <div class="text-end">
                                        <a href="{{ url('/pdf/genarate/' . $order->id . '/' . $order->invoice_number) }}"
                                            type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as
                                            PDF</a>
                                    </div>
                                    <hr>
                                </div>
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
                                                    <h5 class="to">{{ $address->first_name }}</h5>
                                                    <div class="address">{{ $address->address_1 ?? '' }}</div>
                                                    <div class="email"><a
                                                            href="{{ $address->email }}">{{ $address->email }}</a>
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
                                                    @php
                                                        $orderDetails = App\Models\OrderDetails::where('order_id', $order->id)->get();

                                                    @endphp
                                                    @foreach ($orderDetails as $key => $orderDetail)
                                                    @php
                                                        $productDetails = App\Models\Variant::where('product_id', $orderDetail->product_id)->first();
                                                        $productInfo = App\Models\Product::findorFail($orderDetail->product_id);
                                                    @endphp
                                                        <tr>
                                                            <td class="no">{{ $key + 1 }}</td>
                                                            <td class="text-left">{{ $productInfo->product_name }}</td>
                                                            <td class="">{{ $orderDetail->product_quantity }}</td>
                                                            <td class="unit">{{ $orderDetail->weight }}{{ $productDetails->unit }}</td>
                                                            <td class="qty">৳250</td>
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
                                                        <td>৳{{ ($order->product_total * $order->discount) / 100 + $order->product_total }}
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
                                            <div class="thanks">Thank you!</div>
                                            <div class="notices" style="font-size: 15px !important">
                                                <div  style="font-size: 13px !important">NOTICE:</div>
                                                <div class="notice"  style="font-size: 15px !important">A finance charge of 1.5% will be made on unpaid
                                                    balances after
                                                    50
                                                    days.</div>
                                            </div>
                                        </main>
                                        <footer>
                                            Invoice was created on a computer and is valid without the signature and
                                            seal.
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
            <!--- Delivery Status --->
            <div class="py-2">
                <h2 class="font-weight-light text-center text-muted py-3">Order Status</h2>
                <!-- timeline item 1 -->
                <div class="row g-0">
                    <div class="col-sm">
                        <!--spacer-->
                    </div>
                    <!-- timeline item 1 center dot -->
                    <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                        <div class="row h-50" >
                            <div class="col" >&nbsp;</div>
                            <div class="col" >&nbsp;</div>
                        </div>
                        <h5 class="m-2">
                            <span class="badge rounded-pill bg-light border submit_circle majid">&nbsp;</span>
                        </h5>
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <!-- timeline item 1 event content -->
                    <div class="col-sm py-2">
                        <div class="card radius-15 submit_card">
                            <div class="card-body">
                                <?php
                                    $date = new DateTime($order->created_at);
                                    $formattedDate = $date->format('M j');
                                    $day = $date->format('j');
                                    if ($day % 10 == 1 && $day != 11) {
                                        $formattedDate .= 'st';
                                    } elseif ($day % 10 == 2 && $day != 12) {
                                        $formattedDate .= 'nd';
                                    } elseif ($day % 10 == 3 && $day != 13) {
                                        $formattedDate .= 'rd';
                                    } else {
                                        $formattedDate .= 'th';
                                    }
                                    $formattedDate .= $date->format(' Y g:i A');

                                ?>
                                <div class="float-end text-muted small"><span class="submit_data">{{$formattedDate}}</span></div>
                                <h4 class="card-title text-muted submit_title">Order Submited</h4>
                                <p class="card-text">Your Order has been submited sucessfully. waiting for admin approval.
                                    you will get Order Confirmation SMS into your phone. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
                <!-- timeline item 2 -->
                <div class="row g-0">
                    <div class="col-sm py-2">
                        <div class="card radius-15 confirm_card">
                            <div class="card-body">
                                <div class="float-end small"><span class="confirm_date">Jan 10th 2019 8:30 AM</span></div>
                                <h4 class="card-title confirm_title">Order Confirmed</h4>
                                <p class="card-text">Your Order has been Confirmed by admin. Waiting for Processing.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                        <h5 class="m-2">
                            <span class="badge rounded-pill bg-light border confirm_circle">&nbsp;</span>
                        </h5>
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <!--spacer-->
                    </div>
                </div>
                <!--/row-->
                <!-- timeline item 3 -->
                <div class="row g-0">
                    <div class="col-sm">
                        <!--spacer-->
                    </div>
                    <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                        <h5 class="m-2">
                            <span class="badge rounded-pill bg-light border process_circle">&nbsp;</span>
                        </h5>
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col-sm py-2">
                        <div class="card radius-15">
                            <div class="card-body process_card">
                                <div class="float-end text-muted small process_date">Jan 11th 2019 8:30 AM</div>
                                <h4 class="card-title process_title">Order Processing</h4>
                                <p>Your Order is Processing now. After processing it will send to delivery man.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
                <!-- timeline item 4 -->
                <div class="row g-0">
                    <div class="col-sm py-2">
                        <div class="card radius-15">
                            <div class="card-body onthe_way_card">
                                <div class="float-end text-muted small onthe_way_date">Jan 12th 2019 11:30 AM</div>
                                <h4 class="card-title onthe_way_title">On the way </h4>
                                <p>Your order has been processed and now it's on the way.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                        <h5 class="m-2">
                            <span class="badge rounded-pill bg-light border onthe_way_circle">&nbsp;</span>
                        </h5>
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <!--spacer-->
                    </div>
                </div>
                <!--/row-->
                <!-- timeline item 5 -->
                <div class="row g-0">
                    <div class="col-sm">
                        <!--spacer-->
                    </div>
                    <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                        <h5 class="m-2">
                            <span class="badge rounded-pill bg-light border complete_circle">&nbsp;</span>
                        </h5>
                        <div class="row h-50">
                            <div class="col border-end">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col-sm py-2">
                        <div class="card radius-15">
                            <div class="card-body complete_card">
                                <div class="float-end text-muted small complete_date">Jan 11th 2019 8:30 AM</div>
                                <h4 class="card-title complete_title">Order Completed</h4>
                                <p>Your Order has been Completed</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
            </div>
            @else
            <p>No Order found</p>
            @endif
            @endif


    </section>
    <!-- shop-area-end -->
@endsection

