@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12 ">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Edit Product Promottion</h5>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Promotion Name</label>
                            <select class="form-select promotion" id="promotion">


                            @foreach ($promotion as $promo)


                            <option
                            {{ optional($promotionProduct->first())->promotion_id == $promo->id ? 'selected' : '' }}
                            value="{{ $promo->id ?? '' }}">
                            {{ $promo->promotion_name }}
                        </option>


                            @endforeach

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select category" id="category">
                                <option selected value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option   value="{{ $category->id }}">{{ $category->categoryName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Second Row: Category -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Product</label>
                            <select class="form-select product" id="product">
                                <option selected value="">Select Product</option>
                                @foreach ($product as $product)
                                    <option  value="{{ $product->id }}" data-category-id="{{ $product->category_id }}">{{ $product->product_name }},({{$product->category->categoryName}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>

               <div class="card-body promotionTable">
                <form id="promotionForm">
                    <table class="table promotionTable">
                        <thead>
                            <tr>
                                <th>Promotion Name</th>
                                <th>Product Name</th>
                                <th>Variant</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="promotion-table-body">
                           @foreach ($promotionProduct as $promotionProduct)
                           <tr>
                            <td>
                                <input value="{{ $promotionProduct->promotion_id }}" type="hidden" name="promotion_id[]">
                                {{ $promotionProduct->coupon->promotion_name??''}}
                            </td>
                            <td>
                                <input value="{{ $promotionProduct->product_id }}" type="hidden" name="product_id[]">
                                {{ $promotionProduct->product->product_name??'--'}}
                            </td>

                            <td>
                                @php
                                    $selectedVariants = App\Models\VariantPromotion::where('product_id', $promotionProduct->product_id)
                                        ->pluck('variant_id')->toArray();
                                @endphp
                                @if($selectedVariants)
                                    <select class="form-select d-flex multiple-select variant-select"
                                            name="variant_id[{{ $promotionProduct->product_id }}][]"
                                            multiple
                                            data-product-id="{{ $promotionProduct->product_id }}"
                                            data-placeholder="Choose variants">
                                        @foreach ($promotionProduct->product->variants as $variant)
                                            <option value="{{ $variant->id }}"
                                                {{ in_array($variant->id, $selectedVariants) ? 'selected' : '' }}>
                                                {{ $variant->variant_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </td>


                            <td>

                            <input value="{{ $promotionProduct->category_id }}" type="hidden" name="catgory_id[]">
                            {{ $promotionProduct->category->categoryName??'--'}}</td>
                            <td><button class="btn btn-danger btn-sm remove-row delete_button" data-id="{{$promotionProduct->id}}">Remove</button></td>
                           </tr>

                           @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success edit_promotion" id="save-promotion">Update</button>
                </form>

               </div>






            </div>
        </div>
        <!--end row-->
    </div>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>



///////////////////////////////////////////////variant delete///////////////////////////////////////////


$(document).ready(function () {
        $(".variant-select").on("change", function () {
            let productId = $(this).data("product-id");
            let selectedVariants = $(this).val() || []; // Get selected variants
            let allVariants = $(this).find("option").map(function () { return this.value; }).get();

            // Find removed variants
            let removedVariants = allVariants.filter(v => !selectedVariants.includes(v));

            removedVariants.forEach(variantId => {
                $.ajax({
                    url: "{{ route('promotion.variant.delete') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId,
                        variant_id: variantId
                    },
                    success: function (response) {
                        if (response.status==200) {
                            toastr.success(" Variant deleted successfully.");
                        } else {
                            alert(response.message);
                        }
                    },

                });
            });
        });
    });






$(document).ready(function() {
    $('.multiple-select').each(function() {
        $(this).select2({
            placeholder: "Choose variants",
            allowClear: true,
            width: '100%'
        });
    });
});


///////////////////////////Add product variant/////////////////////////////////////


///////////////////////////////using for checking category is selected or not////////////////////////
var previous_category_ids = [];

$(document).on('change', '.category', function () {
    var selected_category_id = $(this).val();

    if (!previous_category_ids.includes(selected_category_id)) {
        previous_category_ids.push(selected_category_id);
    }


    $('.product').val('').change();
});







$(document).on('change','.product', function () {
    var product_id = $('.product').val();
    var promotion_id = $('.promotion').val();



    var category_id = $('.category').val();

        var productCategory_id = $(this).find(':selected').attr('data-category-id');

        console.log("Selected Product's Category ID:", productCategory_id);

        if (previous_category_ids.includes(productCategory_id)) {
            alert("This product's category is already selected!");
            $(this).val('');
            return;
        } else {
            console.log("Valid selection, proceeding...");
        }




    if (!product_id) {
        console.log("No Product selected.");
        return;
    }

    $.ajax({
        url: "{{ route('product.promotion.add.variant') }}",
        method: "POST",
        data: {
            product_id: product_id,

            promotion_id: promotion_id,
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            if (response.status === 200) {
                $('.promotionTable').fadeIn();

                var promotion = response.promotion;
                var product = response.product;


                // Append row for product (if selected)
                if (product_id) {
                    var variantOptions = "";
                    if (product.variants && product.variants.length > 0) {
                        product.variants.forEach(function (variant) {
                            variantOptions += `<option value="${variant.id}">${variant.variant_name}</option>`;
                        });
                    } else {
                        variantOptions = `<option disabled>No Variants Available</option>`;
                    }

                    $('.promotion-table-body').append(`
                        <tr>
                            <td>
                                 <input value="${promotion.id}" type="hidden" name="promotion_id[]">
                                ${promotion.promotion_name}

                                </td>
                            <td>
                                <input value="${product.id}" type="hidden" name="product_id[]">
                                ${product.product_name}
                            </td>
                            <td>
                                <select class="form-select d-flex variant-select" name="variant_id[${product_id}][]" multiple="multiple" data-placeholder="Choose variants">
                                    ${variantOptions}
                                </select>
                            </td>
                            <td>—</td> <!-- No category -->
                            <td><button class="btn btn-danger btn-sm remove-row">Remove</button></td>
                        </tr>
                    `);

                    // Initialize Select2 for the new dropdown
                    $('.variant-select').select2({
                        placeholder: "Choose variants",
                        allowClear: true,
                        width: '100%',
                        closeOnSelect: false,
                        dropdownAutoWidth: true,
                        minimumResultsForSearch: -1 // Hides search box (remove this if you want search)
                    });
                }
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


////////////////////////add show category/////////////////////////////////////
 $(document).on('change','.category',function(){
    var category_id =$('.category').val();
    var promotion_id = $('.promotion').val();
    if (!category_id) {
        console.log("No Product selected.");
        return;
    }

    $.ajax({
        url: "{{ route('product.promotion.add.category') }}",
        method: "POST",
        data: {
            category_id: category_id,
            promotion_id: promotion_id,
            _token: "{{ csrf_token() }}"
        },
        success:function(response){
            if(response.status === 200){
          $('.promotionTable').fadeIn();
          let promotion = response.promotion;
          let category = response.category;
                  if (category_id) {
                            $('.promotion-table-body').append(`
                                <tr>
                                    <td>
                                        <input value="${promotion.id}" type="hidden" name="promotion_id[]">
                                        ${promotion.promotion_name}
                                    </td>
                                    <td>—</td>
                                    <td>—</td> <!-- No product/variant -->
                                    <td>
                                        <input value="${category.id}" name="category_id[]" type="hidden">
                                        ${category.categoryName}
                                    </td>
                                    <td><button class="btn btn-danger btn-sm remove-row">Remove</button></td>
                                </tr>
                            `);
                        }

            }

        }

    });
 });












$(document).on('click', '.remove-row', function () {
    $(this).closest('tr').remove();
});

/////////////////////////////edit promotion/////////////////////////////////////
  $(document).on('click','.edit_promotion',function(){
    let formData = new FormData($('#promotionForm')[0]);

    console.log(formData);
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    })

    $.ajax({
        url: "{{ route('promotion.update') }}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(response.status ===200){

                $('#promotionForm')[0].reset();
                // $('.promotion-table-body').empty();
                // $('.promotionTable').fadeOut();
                location.reload();
                toastr.success('Promotion Updated Successfully');


            }
        }
    })
  })

//////////////////////////////////////////delete promotion/////////////////////////////////////

$(document).on('click','.delete_button',function(){
    let id = $(this).data('id');

    $.ajax({
        url: "{{ route('product.promotion.delete') }}",
        type: "POST",
        data: {
            id: id,
            _token: "{{ csrf_token() }}"
        },
        success: function(response){
            if(response.status === 200){
                toastr.success('Promotion Deleted Successfully');
            }
        }
    });
});


    </script>



@endsection
