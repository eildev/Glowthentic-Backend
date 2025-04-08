@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-8 offset-md-2">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Coupon</h5>

                        {{-- <a href="{{ route('category') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a> --}}

                        <a href="#" class="btn btn-info btn-sm text-light get_product_and_combo" data-bs-toggle="modal"
                        data-bs-target="#couponAddModal">
                        <i class='bx bx-plus'></i>
                    </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Promotion Name</th>
                                    <th>Coupon Code</th>
                                     <th>Discount Type</th>
                                     <th>Discount Value</th>
                                     <th>Apply All Product(Is Global)</th>

                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="couponShowTable">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>


    <div class="modal fade" id="couponAddModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="couponErrorMessages" class="alert alert-danger d-none"></div>
                    <form id="couponAddForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <hr>

                                <!-- Promotion Name -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Promotion Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="promotion_name" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Coupon Code -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Coupon Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="coupon_code" class="form-control" maxlength="50" required>
                                    </div>
                                </div>

                                <!-- Discount Type -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Discount Type</label>
                                    <div class="col-sm-9">
                                        <select name="discount_type" class="form-select" required>
                                            <option value="">Choose...</option>
                                            <option value="percentage">Percentage</option>
                                            <option value="fixed">Fixed Amount</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Discount Value -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Discount Value</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="discount_value" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="type" class="form-select" required>
                                            <option value="">Choose...</option>
                                            <option value="coupon">Coupon</option>
                                            <option value="promotion">Promotion</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Is Global -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Is Global</label>
                                    <div class="col-sm-9">
                                        <select name="is_global" class="form-select" required>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Start Date -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Start Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                </div>

                                <!-- End Date -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">End Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="end_date" class="form-control" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_coupon">Save changes</button>
                </div>
            </div>
        </div>
    </div>









    <div class="modal fade" id="CuponEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="couponEditForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <hr>

                                <!-- Promotion Name -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Promotion Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="promotion_name" id="promotion_name" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Coupon Code -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Coupon Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="coupon_code" id="coupon_code" class="form-control" maxlength="50" required>
                                    </div>
                                </div>

                                <!-- Discount Type -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Discount Type</label>
                                    <div class="col-sm-9">
                                        <select name="discount_type" class="form-select" required id="discount_type">
                                            <option value="">Choose...</option>
                                            <option value="percentage">Percentage</option>
                                            <option value="fixed">Fixed Amount</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Discount Value -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Discount Value</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="discount_value" class="form-control" required id="discount_value">
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Coupon Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" class="form-select" required id="type">
                                            <option value="">Choose...</option>
                                            <option value="coupon">Coupon</option>
                                            <option value="promotion">Promotion</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Is Global -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Is Global</label>
                                    <div class="col-sm-9">
                                        <select name="is_global" class="form-select" required>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Coupon Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-select" required id="status">
                                            <option value="">Choose...</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Expire">Expired</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Start Date -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Start Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="start_date" class="form-control" required id="start_date">
                                    </div>
                                </div>

                                <!-- End Date -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">End Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="end_date" class="form-control" required id="end_date">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary Edit_Coupon">Update</button>
                </div>
            </div>
        </div>
    </div>






    <script>


function validationError(){
    $(".error-message").remove(); // Remove previous error messages
    $("input, select").removeClass("is-invalid"); // Reset invalid styles

    let isValid = true;
    let promotion_name= $("input[name='promotion_name']").val().trim();
    let discount_type=$("select[name='discount_type']").val().trim();
    let discount_value=$("input[name='discount_value']").val().trim();
    let type=$("select[name='type']").val().trim();
    let  start_date=$("input[name='start_date']").val().trim();
    let end_date=$("input[name='end_date']").val().trim();
    let status=$("select[name='status']").val().trim();

    if (promotion_name=== '') {
        $("input[name='promotion_name']").addClass("is-invalid")
            .after('<span class="text-danger error-message">Promotion name is required</span>');
        isValid = false;
    }

    if (discount_type=== '') {
        $("select[name='discount_type']").addClass("is-invalid")
        .after('<span class="text-danger error-message">Discount type is required</span>');
        isValid = false;
    }
    if (discount_value=== '') {
        $("input[name='discount_value']").addClass("is-invalid")
        .after('<span class="text-danger error-message">Discount value is required</span>');
        isValid = false;
    }
    if (type=== '') {
        $("select[name='type']").addClass("is-invalid")
        .after('<span class="text-danger error-message">Type is required</span>');
        isValid = false;
    }
    if (start_date=== '') {
        $("input[name='start_date']").addClass("is-invalid")
        .after('<span class="text-danger error-message">Start date is required</span>');
        isValid = false;
    }
    if (end_date=== '') {
        $("input[name='end_date']").addClass("is-invalid")
        .after('<span class="text-danger error-message">End date is required</span>');
        isValid = false;
    }

    return isValid;
}



function validationEditError(){
    $(".error-message").remove(); // Remove previous error messages
    $("input, select").removeClass("is-invalid"); // Reset invalid styles

    let isValid = true;
    let promotion_name=document.getElementById("promotion_name").value.trim();
    let discount_type=document.getElementById("discount_type").value.trim();
    let discount_value=document.getElementById("discount_value").value.trim();
    let type=document.getElementById("type").value.trim();
    let  start_date=document.getElementById("start_date").value.trim();
    let end_date=document.getElementById("end_date").value.trim();
    let status=document.getElementById("status").value.trim();

    if (promotion_name=== '') {
        $("input[name='promotion_name']").addClass("is-invalid")
            .after('<span class="text-danger error-message">Promotion name is required</span>');
        isValid = false;
    }

    if (discount_type=== '') {
        $("select[name='discount_type']").addClass("is-invalid")
        .after('<span class="text-danger error-message">Discount type is required</span>');
        isValid = false;
    }
    if (discount_value=== '') {
        $("input[name='discount_value']").addClass("is-invalid")
        .after('<span class="text-danger error-message">Discount value is required</span>');
        isValid = false;
    }
    if (type=== '') {
        $("select[name='type']").addClass("is-invalid")
        .after('<span class="text-danger error-message">Type is required</span>');
        isValid = false;
    }
    if (start_date=== '') {
        $("input[name='start_date']").addClass("is-invalid")
        .after('<span class="text-danger error-message">Start date is required</span>');
        isValid = false;
    }
    if (end_date=== '') {
        $("input[name='end_date']").addClass("is-invalid")
        .after('<span class="text-danger error-message">End date is required</span>');
        isValid = false;
    }

    return isValid;
}






//////////////add coupon/////////////
$(document).on('click', '.save_coupon', function () {


   if(!validationError()) return;
    let formData = new FormData($('#couponAddForm')[0]);


    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('.error-message').remove();
    // $('.is-invalid').removeClass('is-invalid');

    $.ajax({
        url: '/coupon/store',
        type: 'POST',
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status === 200) {
                $('#couponAddForm')[0].reset();
                $('#couponAddModal').modal('hide');
                toastr.success("Coupon Added Successfully");
                showCupon();
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




 $(document).on('click','.edit',function(){
    let id = $(this).data('id');
    $.ajax({
         url: '/coupon/edit/' + id,
         type: 'GET',
         success: function(response){

            if(response.status===200){
                $('#couponEditForm input[name="promotion_name"]').val(response.coupon.promotion_name);
                $('#couponEditForm input[name="coupon_code"]').val(response.coupon.cupon_code);
                $('#couponEditForm select[name="discount_type"]').val(response.coupon.discount_type);
                $('#couponEditForm input[name="discount_value"]').val(response.coupon.discount_value);
                $('#couponEditForm select[name="type"]').val(response.coupon.type);
                $('#couponEditForm select[name="is_global"]').val(response.coupon.is_global);
                $('#couponEditForm select[name="status"]').val(response.coupon.status);
                $('#couponEditForm input[name="start_date"]').val(response.coupon.start_date);
                $('#couponEditForm input[name="end_date"]').val(response.coupon.end_date);
                $('#couponEditForm').append(`<input type="hidden" name="coupon_id" value="${response.coupon.id}">`);
            }
         },


    });
 });




$(document).on('click', '.Edit_Coupon', function () {

    if(!validationEditError()) return;
    let formData = new FormData($('#couponEditForm')[0]);
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
        url: '/coupon/update',
        type: 'POST',
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status === 200) {
                $('#couponEditForm')[0].reset();
                $('#CuponEditModal').modal('hide');
                toastr.success("Coupon Updated Successfully");
                showCupon();
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

$(document).on('click', '.delete', function () {
    let id = $(this).data('id');

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
        url: '/coupon/delete',
        type: 'POST',
        data:{
            id:id,
        },

        success: function (response) {
            if (response.status === 200) {
                $('#couponEditForm')[0].reset();
                $('#CuponEditModal').modal('hide');
                toastr.success("Coupon Deleted Successfully");
                showCupon();
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






function showCupon() {
    $.ajax({
        url: '/coupon/view',
        type: 'GET',
        success: function(response) {

            if (response.status === 200) {
                let coupon = response.coupon;
                 console.log(coupon);
                $('#couponShowTable').empty();

                coupon.forEach(function(coupon, i) {
                    $('#couponShowTable').append(`
                        <tr>
                            <td>${i + 1}</td>
                            <td>${coupon.promotion_name ? coupon.promotion_name : ''}</td>
                            <td>${coupon.cupon_code ? coupon.cupon_code : ''}</td>
                            <td>${coupon.discount_type ? coupon.discount_type : ''}</td>
                            <td>${coupon.discount_value ? coupon.discount_value : ''}</td>
                             <td>${coupon.is_global ? 'Applicable' : 'Not Applicable'}</td>
                            <td>${coupon.start_date ? coupon.start_date : ''}</td>
                            <td>${coupon.end_date ? coupon.end_date : ''}</td>
                            <td>${coupon.status ? coupon.status : ''}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="dropdown-item edit" data-id="${coupon.id}"
                                            data-bs-toggle="modal" data-bs-target="#CuponEditModal">Edit</a></li>
                                        <li><a href="#" class="dropdown-item delete" data-id="${coupon.id}">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    `);
                });
            } else {
                console.log("Unexpected status:", response.status);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            console.error("Server response:", xhr.responseText);
        }
    });
}



    showCupon();





    </script>
@endsection
