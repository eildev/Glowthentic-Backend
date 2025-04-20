@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Procesed Order list</h5>

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
                                @if ($processed_orders->count() > 0)
                                    @foreach ($processed_orders as $order)
                                    @php
                                    $originalDateString = $order->created_at;
                                    $dateTime = new DateTime($originalDateString);
                                    $formattedDate = $dateTime->format('Y-m-d');
                                    @endphp
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                                <td>{{ $formattedDate }}</td>
                                                <td>{{ $order->invoice_number }}</td>
                                                <td>{{$order->phone_number}}</td>
                                                <td>{{ $order->total_quantity }}</td>
                                                <td>{{ $order->grand_total }}</td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>{{ $order->payment_status }}</td>

                                                <td>
                                                    <span class="text-warning text-capitalize">{{ $order->status }}</span>
                                                </td>
                                                <td>Banasree</td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm text-light send_data_id" data-id="{{$order->id}}" data-bs-toggle="modal"
                                                data-bs-target="#orderAssign">
                                               Assign Order
                                            </a>
                                                <a href="{{ route('order.details', $order->id) }}" class="btn btn-sm btn-success">View</a>
                                                <a href="{{ route('admin.denied.order', $order->invoice_number) }}"
                                                    class="btn btn-sm btn-danger" id="delete">Cancel</a>
                                            </td>
                                        </tr>
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


    <div class="modal fade" id="orderAssign" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="couponErrorMessages" class="alert alert-danger d-none"></div>
                    <form id="deliverAssignForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <hr>

                              <input type="hidden" class="order_id" name="order_id" id="order_id">
                                <!-- Discount Type -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Assign To</label>
                                    <div class="col-sm-9">
                                        <select name="delivery_method" class="form-select assign_type" required>
                                            <option value="">Choose...</option>
                                            <option value="In-house">Delivery Man</option>
                                            <option value="third-party">Courier</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3" id="delivery_man" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Delivery Man</label>
                                    <div class="col-sm-9">
                                        <select name="assign_to" class="form-select" required>
                                            <option value="">Choose...</option>
                                            <option value="X">X</option>
                                            <option value="Y">Y</option>
                                            <option value="Z">Z</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3" id="courier" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Courier</label>
                                    <div class="col-sm-9">
                                        <select name="courier_service" class="form-select courier_service" required >
                                            <option value="">Choose...</option>
                                            <option value="SteadFast" >Stead Fast</option>
                                            <option value="Pathao">Pathao</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="display: none;" id="steadfast_courier_info">
                                    <div class="col-12">
                                        <hr>
                                        <h4>SteadFast Information Fill</h4>
                                        <hr>
                                        <div class="row mb-3" id="" style="">
                                            <label class="col-sm-3 col-form-label">Invoice Number</label>
                                            <div class="col-sm-9">
                                               <input type="text" class="form-control" name="invoice" placeholder="Invoice Number" id="invoice_number">
                                            </div>
                                        </div>

                                        <div class="row mb-3" id="" style="">
                                            <label class="col-sm-3 col-form-label">Recipent Name</label>
                                            <div class="col-sm-9">
                                               <input type="text" class="form-control" name="recipient_name" placeholder="Enter Recipent Name" id="recipient_name">
                                            </div>
                                        </div>

                                        <div class="row mb-3" id="" style="">
                                            <label class="col-sm-3 col-form-label">Recipient Phone No:</label>
                                            <div class="col-sm-9">
                                               <input type="text" class="form-control" name="recipient_phone" placeholder="Enter Recipent Phone No" id="recipient_phone">
                                            </div>
                                        </div>
                                        <div class="row mb-3" id="" style="">
                                            <label class="col-sm-3 col-form-label">COD Amount</label>
                                            <div class="col-sm-9">
                                               <input type="text" class="form-control" name="cod_amount" placeholder="Enter COD Amount" id="cod_amount">
                                            </div>
                                        </div>

                                        <div class="row mb-3" id="" style="">
                                            <label class="col-sm-3 col-form-label">Receipent Address</label>
                                            <div class="col-sm-9">
                                               <textarea cols="5" rows="5" type="text" class="form-control" name="recipient_address" placeholder="Enter Recipent Address" id="recipient_address"></textarea>
                                            </div>
                                        </div>



                                        <div class="row mb-3" id="" style="">
                                            <label class="col-sm-3 col-form-label">Note(Optional)</label>
                                            <div class="col-sm-9">
                                               <textarea cols="5" rows="5" type="text" class="form-control" name="note" placeholder="Note"></textarea>
                                            </div>
                                        </div>


                                    </div>

                                </div>


                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary assign_deliver">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>

    $(document).on('click','.assign_deliver',function(){
        let formData = new FormData($('#deliverAssignForm')[0]);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.error-message').remove();
            $.ajax({

                url:"{{url('admin/order/assign-deliver')}}",
                type:"POST",
                data:formData,
                processData: false,
                contentType: false,
                success:function(response){
                    if(response.status == 200){

                        $('#deliverAssignForm')[0].reset();
                        $('#orderAssign').modal('hide');
                        toastr.success("Order Assign Successfully");
                        location.reload();
                    }
                },

                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            let inputField = $('[name="' + key + '"]');
                            inputField.after('<span class="text-danger error-message">' + value[0] + '</span>');
                        });
                    } else {
                        alert("Something went wrong!");
                    }
                }

            });


      });



       $(document).on('change','.courier_service',function(){
        let courier_service = $(this).val();
        if(courier_service ==='SteadFast'){
           $('#steadfast_courier_info').fadeIn();
        }
       });



        $(document).on('change','.assign_type',function(){
             let assign_type = $(this).val();
             if(assign_type ==='third-party'){
                $('#delivery_man').fadeOut();
                $('#courier').fadeIn();
             }

             else{

                $('#courier').fadeOut();
                $('#delivery_man').fadeIn();
             }
        });

        $(document).on('click','.send_data_id',function(){
            let order_id = $(this).data('id');
            // $('.order_id').val(order_id);

            $.ajax({
                url:"{{url('admin/order/get-order-details')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    order_id:order_id
                },
                success:function(response){
                    if(response.status == 200){
                        $('#order_id').val(response.order.id);
                        $('#invoice_number').val(response.order.invoice_number);
                        $('#cod_amount').val(response.order.grand_total);
                        $('#recipient_name').val(response.userInfo.full_name);
                        $('#recipient_phone').val(response.userInfo.phone_number);
                        $('#recipient_address').val(response.userInfo.address);

                    }
                }
            });
        });






  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("steadfastCourierForm");

    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Get input values
        let invoice = document.querySelector("input[name='invoice']");
        let recipientName = document.querySelector("input[name='recipient_name']");
        let recipientPhone = document.querySelector("input[name='recipient_phone']");
        let codAmount = document.querySelector("input[name='cod_amount']");
        let recipientAddress = document.querySelector("textarea[name='recipient_address']");

        // Function to check if a field is empty and show error
        function validateField(field) {
            if (!field.value.trim()) {
                field.classList.add("is-invalid");
                isValid = false;
            } else {
                field.classList.remove("is-invalid");
            }
        }

        // Apply validation to required fields
        validateField(invoice);
        validateField(recipientName);
        validateField(recipientPhone);
        validateField(codAmount);
        validateField(recipientAddress);

        // Prevent form submission if invalid
        if (!isValid) {
            event.preventDefault();
        }
    });
});


    </script>
@endsection
