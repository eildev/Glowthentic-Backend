@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row py-1">
            @if ($orders->count() > 0)
                @php
                    $customers = $orders->orderBillingDetails;
                    // @dd($customers);
                    $first_name = $customers->first_name;
                    $last_name = $customers->last_name;
                    $email = $customers->email;
                    $phone = $customers->phone;
                    $address_1 = $customers->address_1;
                    $address_2 = $customers->address_2;
                    $city = $customers->city;
                    $division = $customers->division;
                    $post_code = $customers->post_code;
                    $country = $customers->country;
                    $order_notes = $customers->order_notes;

                    $order_id = $orders->id;
                    $invoice_number = $orders->invoice_number;
                    $user_identity = $orders->user_identity;
                    $product_quantity = $orders->product_quantity;
                    $product_total = $orders->product_total;
                    $coupon_id = $orders->coupon_id;
                    $discount = $orders->discount;
                    $sub_total = $orders->sub_total;
                    $shipping_method = $orders->shipping_method;
                    $shipping_amount = $orders->shipping_amount;
                    $grand_total = $orders->grand_total;
                    $payment_method = $orders->payment_method;
                    $payment_id = $orders->payment_id;
                    $payment_status = $orders->payment_status;
                    $order_note = $orders->order_note;
                    $status = $orders->status;

                    // @dd($invoice_number);
                @endphp
                <div class="card border-top border-0 border-3 border-info col-md-12">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-info">Maximum Order Details Table</h5>
                           <div>
                                <!--<button  class="btn btn-info btn-sm text-light">-->
                                <!--       Order -->
                                <!--</button>-->
                                @if(!empty($user_identity))
                                    <button data-bs-target="#sms{{$order_id}}" data-bs-toggle="modal" class="btn btn-info btn-sm text-light">
                                        Send Message to {{ $user_identity ?? '' }}
                                    </button>
                                @endif
                           </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="sms{{$order_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Send SMS to User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('send.sms') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                    <div class="form-control">
                                        <label for="sms">Write Message</label>
                                        <input type="hidden" name="phone" value="{{ $user_identity }}">
                                        <textarea name="sms" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Send changes</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        <hr>
                        <!-- End Modal -->

                        <div class="table-responsive">
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <strong><p><u> User Information </u></p></strong>
                                    <div class="row py-1">
                                        <div class="col-4">First Name</div>
                                        {{-- <div class="col-6">: {{ $order_id }}</div> --}}
                                        <div class="col-6">: {{ $first_name ?? 'Data Not Found' }}</div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Last Name </div>
                                        <div class="col-6">: {{ $last_name ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Email </div>
                                        <div class="col-6">: {{ $email ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Phone Number </div>
                                        <div class="col-6">: {{ $phone ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Primary Address </div>
                                        <div class="col-6"><span style="text-wrap: wrap;">: {{ $address_1 ?? 'Data Not Found' }}</span> </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Secondary Address </div>
                                        <div class="col-6"><span style="text-wrap: wrap;">: {{ $address_2 ?? 'Data Not Found' }} </span></div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> City </div>
                                        <div class="col-6">: {{ $city ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Division </div>
                                        <div class="col-6">: {{ $division ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Post Code </div>
                                        <div class="col-6">: {{ $post_code ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Country </div>
                                        <div class="col-6">: {{ $country ?? 'Data Not Found' }} </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <strong><p><u>Order Information</u></p></strong>
                                    <div class="row py-1">
                                        <div class="col-4">Invoice Number</div>
                                        <div class="col-6">: {{ $invoice_number ?? 'Data Not Found' }}</div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4">Total Product</div>
                                        <div class="col-6">: {{ $product_quantity ?? 'Data Not Found' }}</div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Amount </div>
                                        <div class="col-6">: {{ $product_total ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Shipping Method </div>
                                        <div class="col-6">: {{ $shipping_method ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Shipping Amount </div>
                                        <div class="col-6">: {{ $shipping_amount ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Sub Total </div>
                                        <div class="col-6">: {{ $sub_total ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Coupon ID </div>
                                        <div class="col-6">: {{ $coupon_id ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Discount </div>
                                        <div class="col-6">: {{ $discount ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Grand Total </div>
                                        <div class="col-6">: {{ $grand_total ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Payment Method </div>
                                        <div class="col-6">: {{ $payment_method ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Payment Status </div>
                                        <div class="col-6">: {{ $payment_status ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Order Note </div>
                                        <div class="col-6">: {{ $order_note ?? 'Data Not Found' }} </div>
                                    </div>
                                    <div class="row py-1">
                                        <div class="col-4"> Order Status </div>
                                        <div class="col-6">: {{ $status ?? 'Data Not Found' }} </div>
                                    </div>
                                </div>
                            </div>
                            <table id="order_table" class="table table-striped table-bordered py-3" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <strong><p><u>Order Details</u></p></strong>
                                    @php
                                        $serialNumber = 1;
                                    @endphp

                                    @foreach ($orders->orderDetails as $order)

                                        @php
                                            $originalDateString = $order->created_at;
                                            $dateTime = new DateTime($originalDateString);
                                            $formattedDate = $dateTime->format('Y-m-d');


                                            $product = App\Models\Product::where('id', $order->product_id)->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>
                                                <img src="{{ asset('/uploads/products/' . $product->product_image) }}"
                                                    style="height: 100px;" class="img-fluid" alt="Products Image">
                                            </td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $order->product_quantity }}</td>
                                            <td>{{ $order->product_price }}</td>
                                            <td>{{ $order->total_price }}</td>

                                            <!--<td>-->
                                            <!--    <a href="#" class="btn btn-sm btn-info">Approve</a>-->
                                            <!--    <a href="#" class="btn btn-sm btn-danger" id="delete">Denied</a>-->
                                            <!--</td>-->

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center text-warning">Data not Found</td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>


                    </div>
                </div>
            @endif
        </div>
        <!--end row-->
    </div>

@endsection
