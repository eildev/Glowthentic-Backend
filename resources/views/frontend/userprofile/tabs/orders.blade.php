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
                                <th>Download Invoice</th>
                                <th>Refunds</th>
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
                                        @if ($order->status == 'pending')
                                            {{'Order Pending'}}
                                        @elseif ($order->status == 'approve')
                                            {{'Order Processing'}}
                                        @elseif ($order->status == 'processing')
                                            {{'Order Processing'}}
                                        @elseif ($order->status == 'delivering')
                                            {{'Order Delivering'}}
                                        @elseif ($order->status == 'completed')
                                            {{'Order Completed'}}
                                        @endif

                                        </td>
                                        <td> </td>
                                        @if ($order->status == 'completed')
                                            <td><a href="{{ route('user.refund.order',$order->invoice_number) }}" class="btn btn-info btn-sm">Refund </a></td>

                                        @else
                                            <td><a href="{{ route('user.cancel.order',$order->invoice_number) }}" class="btn btn-danger btn-sm" id="order_cancel">Cancel</a></td>
                                        @endif

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


<script>
            $(document).ready(function() {
            //    delete function
            $(document).on('click', '#order_cancel', function(e) {
                e.preventDefault();

                var link = $(this).attr("href");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to cancel this order!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Deleted!',
                            'Your Order has been canceld.',
                            'success'
                        )
                    }
                })

            });
        });
</script>
