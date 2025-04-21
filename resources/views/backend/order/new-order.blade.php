@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">10+ Order Table</h5>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                    <th>SI</th>
                                    <th>Date</th>
                                    <th>Invoice no</th>
                                    <th>User Phone Number</th>
                                    <th>Product Qty</th>
                                    <th>Amount</th>
                                    <th>Pay to</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Address</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($newOrders->count() > 0)
                                    @foreach ($newOrders as $order)

                                    @php
                                    if($order->user_id!=null){
                                        $customers = App\Models\UserDetails::where('user_id', $order->user_id)->first();
                                        }
                                    else{
                                        $customers = App\Models\UserDetails::where('session_id',$order->session_id)->first();
                                    }
                                    @endphp
                                        @if ($order->product_quantity >= '20')
                                            @php
                                                $originalDateString = $order->created_at;
                                                $dateTime = new DateTime($originalDateString);
                                                $formattedDate = $dateTime->format('Y-m-d');
                                            @endphp
                                            <tr>
                                                <td>{{ $serialNumber++ }}</td>
                                                <td>{{ $formattedDate }}</td>
                                                <td>{{ $order->invoice_number }}</td>
                                                <td>{{$customers->phone_number}}</td>
                                                <td>{{ $order->total_quantity }}</td>
                                                <td>{{ $order->grand_total }}</td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>{{ $order->payment_status }}</td>

                                                <td>
                                                    <span class="text-warning text-capitalize">{{ $order->status }}</span>
                                                </td>
                                                <td>{{$customers->address}}</td>
                                                <td>
                                                    <a href="{{ route('admin.approve.order',$order->id) }}"
                                                        class="btn btn-sm btn-info">Approve</a>
                                                    <a href="{{ route('order.details', $order->id) }}"
                                                        class="btn btn-sm btn-success">View</a>
                                                    <a href="{{ route('admin.denied.order', $order->invoice_number) }}"
                                                        class="btn btn-sm btn-danger" id="delete">Denied</a>
                                                </td>
                                            </tr>

                                        @endif
                                        <!-- Modal -->
                                        <div class="modal fade" id="sms{{ $order->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Send SMS to User
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('send.sms') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-control">
                                                                <label for="sms">Write Message</label>
                                                                <input type="hidden" name="phone"
                                                                    value="{{ $order->user_identity }}">
                                                                <textarea name="sms" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Send
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center text-warning">Data not Found</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">New Order Table</h5>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Date</th>
                                    <th>Invoice no</th>
                                    <th>User Phone Number</th>
                                    <th>Product Qty</th>
                                    <th>Amount</th>
                                    <th>Pay to</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($newOrders->count() > 0)
                                    {{-- @dd($newOrders); --}}
                                    @foreach ($newOrders as $order)

                                    @php
                                    if($order->user_id!=null){
                                        $customers = App\Models\UserDetails::where('user_id', $order->user_id)->first();
                                        }
                                    else{
                                        $customers = App\Models\UserDetails::where('session_id',$order->session_id)->first();
                                    }
                                    @endphp

                                        @if ($order->product_quantity <= '20')
                                            @php
                                                $originalDateString = $order->created_at;
                                                $dateTime = new DateTime($originalDateString);
                                                $formattedDate = $dateTime->format('Y-m-d');
                                            @endphp
                                            <tr>
                                                <td>{{ $serialNumber++ }}</td>
                                                <td>{{ $formattedDate }}</td>
                                                <td>{{ $order->invoice_number }}</td>
                                                <td>{{$customers->phone_number}}</td>
                                                <td>{{ $order->total_quantity }}</td>
                                                <td>{{ $order->grand_total }}</td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>{{ $order->payment_status }}</td>

                                                <td>
                                                    <span class="text-warning text-capitalize">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                                <td>{{$customers->address}}</td>
                                                <td>
                                                    <a href="{{ route('admin.approve.order',$order->id) }}"
                                                        class="btn btn-sm btn-info">Approve</a>
                                                    <a href="{{ route('order.details', $order->id) }}"
                                                        class="btn btn-sm btn-success">View</a>
                                                    <a href="{{ route('admin.denied.order', $order->invoice_number) }}"
                                                        class="btn btn-sm btn-danger" id="delete">Denied</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center text-warning">Data not Found</td>
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
