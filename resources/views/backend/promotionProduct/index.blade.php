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

                        <a href="{{ route('product.promotion.create') }}" class="btn btn-info btn-sm text-light get_product_and_promotion" >
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @foreach ($productPromotion as $key => $promotionProduct)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $promotionProduct->coupon->promotion_name }}</td>

                                  
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('admin.product.promotion.edit', $promotionProduct->promotion_id) }}" class="dropdown-item edit">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li><a href="#" class="dropdown-item delete">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
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
