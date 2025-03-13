<div class="tpshop__top ml-60">
    <div class="product__filter-content mb-40">
        <div class="row align-items-center my-3">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">
                    {{-- <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all"
                                type="button" role="tab" aria-controls="nav-all" aria-selected="false">tab 1

                            </button>
                            <button class="nav-link active" id="order_history" data-bs-toggle="tab"
                                data-bs-target="#nav-popular" type="button" role="tab" aria-controls="nav-popular"
                                aria-selected="true">
                                Order History
                            </button>
                            <button class="nav-link" id="nav-product-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-product" type="button" role="tab" aria-controls="nav-product"
                                aria-selected="false">
                                tab 3
                            </button>
                        </div>
                    </nav> --}}
                    <strong>Order History</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="tab_card mb-20">
                <div class="table-content table-responsive">
                    <table class="table">

                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Invoice Number</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serialNumber = 1;
                            @endphp
                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $serialNumber++ }}</td>
                                        <td>{{ $order->invoice_number }}</td>
                                        <td>{{ $order->product_quantity }}</td>
                                        <td>{{ $order->grand_total }}</td>
                                        <td>
                                        @if ($order->status == 'refunding')
                                            {{'Refund Processing'}}
                                        @elseif ($order->status == 'refunded')
                                            {{'Refund Completed'}}
                                        @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center text-warning">Data not Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
