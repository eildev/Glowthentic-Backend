@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Transit order list</h5>

                        <a href="{{ route('popupMessage') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Date</th>
                                    <th>Invoice no</th>
                                    <th>User Name</th>
                                    <th>User Phone Number</th>
                                    <th>Product Qty</th>
                                    <th>Amount</th>
                                    <th>Pay to</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Courier Data</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($transit_orders->count() > 0)
                                    @foreach ($transit_orders as $transit_orders)
                                        @php
                                            if ($transit_orders->order->user_id != null) {
                                                $customers = App\Models\UserDetails::where(
                                                    'user_id',
                                                    $transit_orders->order->user_id,
                                                )->first();
                                            } else {
                                                $customers = App\Models\UserDetails::where(
                                                    'session_id',
                                                    $transit_orders->order->session_id,
                                                )->first();
                                            }
                                        @endphp





                                        @php
                                            $originalDateString = $transit_orders->order->created_at;
                                            $dateTime = new DateTime($originalDateString);
                                            $formattedDate = $dateTime->format('Y-m-d');
                                        @endphp
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $formattedDate }}</td>
                                            <td>{{ $transit_orders->order->invoice_number ?? '' }}</td>
                                            <td>{{ $customers->full_name ?? '' }}</td>
                                            <td>
                                                {{ $customers?->phone_number ? (substr($customers?->phone_number, 0, 1) === '0' ? $customers?->phone_number : '0' . $customers?->phone_number) : '0' }}
                                            </td>
                                            <td>{{ $transit_orders->order->total_quantity ?? 0 }}</td>
                                            <td>{{ $transit_orders->order->grand_total ?? 0 }}</td>
                                            <td>{{ $transit_orders->order->payment_method ?? '' }}</td>
                                            <td>{{ $transit_orders->order->payment_status ?? '' }}</td>
                                            <td>
                                                <span
                                                    class="text-warning text-capitalize">{{ $transit_orders->delivery_status ?? '' }}</span>
                                            </td>
                                            <td>
                                                <span>Courier Id:{{ $transit_orders->courier_id ?? '' }}</span></br>
                                                <span>Tracking Number:{{ $transit_orders->tracking_number ?? '' }}</span>
                                            </td>
                                            <td>{{ $customers->address ?? '' }}</td>
                                            <td>
                                                {{-- <a href="{{ route('admin.completed.order',$delivering_orders->order->invoice_number) }}" class="btn btn-sm btn-info">Complete</a> --}}

                                                <a href="{{ route('admin.transit.order.change.completed', $transit_orders->id) }}"
                                                    class="btn btn-sm btn-info">Delivered</a>
                                                <a href="{{ route('order.details', $transit_orders->order->id) }}"
                                                    class="btn btn-sm btn-success">View</a>
                                                {{-- <a href="{{ route('admin.denied.order', $transit_orders->id) }}"
                                                    class="btn btn-sm btn-danger" id="delete">Cancel</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12" class="text-center text-warning">Data not Found</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
