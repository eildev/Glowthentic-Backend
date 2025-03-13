@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-8 offset-md-2">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Product Promotion</h5>

                        {{-- <a href="{{ route('category') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a> --}}

                        <a href="#" class="btn btn-info btn-sm text-light get_product_and_promotion" data-bs-toggle="modal"
                        data-bs-target="#ProductPromotionAddModal">
                        <i class='bx bx-plus'></i>
                    </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Product Name</th>
                                    <th>Promotion Name</th>
                                    <th>Variant Name</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="promotionProductTable">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>


    <div class="modal fade" id="ProductPromotionAddModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Promotion Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="promotionProductAddForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <hr>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Product Name</label>
                                    <div class="col-sm-9">
                                        <select name="product_id" class="form-select products" required id="product_id_variant">
                                            <option value="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Promotion Name</label>
                                    <div class="col-sm-9">
                                        <select name="promotion_id" class="form-select promotion" required>
                                            <option value="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Variant Name</label>
                                    <div class="col-sm-9">
                                        <select name="variant_id" class="form-select variant" required>
                                            <option value="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_product_promotion">Save changes</button>
                </div>
            </div>
        </div>
    </div>









    <div class="modal fade" id="ProductPromotionEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product Promotion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ProductPromotionEditForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <hr>
                                <input type="hidden" name="id" class="form-control promotionProduct_id" >
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Product Name</label>
                                    <div class="col-sm-9">
                                        <select name="product_id" class="form-select products" required id="product_id_variant">
                                            <option value="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Promotion Name</label>
                                    <div class="col-sm-9">
                                        <select name="promotion_id" class="form-select promotion" required>
                                            <option value="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Variant Name</label>
                                    <div class="col-sm-9">
                                        <select name="variant_id" class="form-select variant" required>
                                            <option value="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary Edit_promotion_Product">Update</button>
                </div>
            </div>
        </div>
    </div>






    <script>


  $(document).on("change","#product_id_variant",function(){
    let product_id = $(this).val();

    $.ajax({
        url:'/get/product/variant',
        type:'POST',
        data:{product_id:product_id,
            _token: "{{ csrf_token() }}"
        },
        success:function(response){
             let variant = response.variant;
             let variantOption =``;
              variant.forEach(variant=>{
                variantOption += `<option value="${variant.id}">${variant.variant_name}</option>`;
                });
                $('.variant').html(variantOption);
        }
    });
  });




   $(document).on("click",".get_product_and_promotion",function(){

      $.ajax({
         url:'/get/product/and/promotion',
         type:'GET',
         success:function(response){
            console.log(response);
            let products = response.product;
            let promotion = response.promotion;

             let productOption =`<option selected disabled>Choose...</option>`;
             let promotionOption =`<option selected disabled>Choose...</option>`;

            products.forEach(products=>{
                productOption += `<option value="${products.id}">${products.product_name}</option>`;
            });

            promotion.forEach(promotion=>{
                promotionOption += `<option value="${promotion.id}">${promotion.promotion_name}</option>`;
            });


            $('.products').html(productOption);
            $('.promotion').html(promotionOption);

         }
      });

   });



   $(document).on('click', '.save_product_promotion', function() {
    // e.preventDefault();

    let formData = new FormData($('#promotionProductAddForm')[0]);

    $.ajax({
        url: '/promotion/product/store',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        beforeSend: function() {
            $('.error-message').remove();
        },
        success: function(response) {
            if (response.status === 200) {

                $('#promotionProductAddForm')[0].reset();
                $('#ProductPromotionAddModal').modal('hide');
                showProductPromotion();
                toastr.success(response.message);
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
        url:'/promotioin/product/edit/'+id,
        type:'GET',
        success:function(response){
            if(response.status === 200){


             $('.promotionProduct_id').val(response.productPromotion.id);
             let products = response.product;
            let promotion = response.promotion;
            let variant = response.variant;
             let productOption =`<option selected disabled>Choose...</option>`;
             let promotionOption =`<option selected disabled>Choose...</option>`;
             let variantOption =``;
             products.forEach(product => {
                productOption += `<option value="${product.id}" ${product.id === response.productPromotion.product_id ? 'selected' : ''}>${product.product_name}</option>`;
            });


            promotion.forEach(promotion => {
                promotionOption += `<option value="${promotion.id}" ${promotion.id === response.productPromotion.promotion_id ? 'selected' : ''}>${promotion.promotion_name}</option>`;
            });

            variant.forEach(variant => {
                variantOption += `<option value="${variant.id}" ${variant.id === response.productPromotion.variant_id ? 'selected' : ''}>${variant.variant_name}</option>`;
                });
                $('.variant').html(variantOption);
            $('.products').html(productOption);
            $('.promotion').html(promotionOption);

            }
        }
     });

});




  $(document).on('click','.Edit_promotion_Product',function(){
      let formdata= new FormData($('#ProductPromotionEditForm')[0]);
      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

        $.ajax({
             url:'/promotion/product/update',
             type:'POST',
             data:formdata,
             processData:false,
             contentType:false,
             success:function(response){
                if(response.status === 200){
                    $('#ProductPromotionEditForm')[0].reset();
                    $('#ProductPromotionEditModal').modal('hide');
                    toastr.success("Promotion Product Updated Successfully");
                    showProductPromotion();

                }
             }





            });
  });


  $(document).on('click','.delete',function(){
     let id = $(this).data('id');
     $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

        $.ajax({
            url:'/promotion/product/delete/',
            type:'POST',
            data:{id:id},
            success:function(response){
                if(response.status === 200){
                toastr.success("Combo Product Deleted Successfully");
                showProductPromotion();
                }
            }
        });

  });











    function showProductPromotion(){

        $.ajax({
            url:'/promotion/product/view',
            type:'GET',
            success:function(response){
                //  console.log(response);
                 if(response.status ===200){

                    let productPromotion=response.productPromotion;
                    console.log(productPromotion);
                    $('#promotionProductTable').empty();
                    productPromotion.forEach(function(productPromotion,i){
                        $('#promotionProductTable').append(`
                                    <tr>
                                        <td>${i+1}</td>
                                        <td>${productPromotion.product.product_name}</td>
                                        <td>${productPromotion.coupon.promotion_name }</td>
                                        <td>${productPromotion.variant.variant_name}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="dropdown-item edit "  data-id="${productPromotion.id}" data-bs-toggle="modal"
                                                    data-bs-target="#ProductPromotionEditModal">Edit</a></li>
                                                        <li><a href="#" class="dropdown-item delete" data-id="${productPromotion.id}">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                    </tr>


                                    `);
                    });

                 }
            }

        })
    }

    showProductPromotion();
    </script>
@endsection
