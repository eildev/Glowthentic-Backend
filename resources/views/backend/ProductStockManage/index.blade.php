@extends('backend.master')
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="card border-top border-0 border-3 border-info col-md-12 ">

                        <h4 class="mt-3">Product Stock Management</h4>
                        <hr>
                        <div class="row m-4">

                            <div class="col-md-3 position-relative">
                                <label for="validationTooltip04" class="form-label"> Select Product Name</label>
                                <select class="form-select product" id="validationTooltip04" required>
                                    <option selected disabled value="">Choose...</option>
                                    @foreach ($product as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">Please select a Product.</div>
                            </div>
                            <div class="col-md-3 position-relative">
                                <label for="validationTooltip04" class="form-label">Select Variant Name</label>
                                <select class="form-select variant" id="validationTooltip04" required>

                                </select>
                                <div class="invalid-tooltip">Please select a Variant Name.</div>
                            </div>
                            <div class="mt-5 stock-table" style="display: none">
                                <h4>Product Stock Update</h4>
                                <hr>
                                <form id="stockUpdateForm">
                             <table class="table table-striped table-bordered">

                               <thead class="text-center">
                                <th></th>
                                  <th>Product Name</th>
                                  <th>Variant Name</th>
                                  <th>Current Stock</th>
                                  <th>Add Stock</th>
                                  <th>Action</th>
                               </thead>
                               <tbody class="newVariant">

                               </tbody>
                               <tfoot>
                                <tr>
                                    <td colspan="6" class="text-end">
                                        <a  class="btn btn-primary updateMultipleStock">Update Stock</a>
                                    </td>
                                </tr>
                               </tfoot>
                             </table>
                            </form>
                            </div>
                        </div>
        </div>
    </div>
</div>
<script>


/////////////////////////////stock validation start//////////////////







/////////////////////////////stock validation end//////////////////
$(document).on('change','.product',function(){
  var id = $(this).val();
  var url = "{{ url('get/stock/product/variant') }}/" + id;

     $.ajax({
        url:url,
        type: 'GET',
        success:function(data){
            console.log(data);
            if(data.status ==200){
                let variant = data.variant;
                let VariantOption =`<option>choose.....</option>`;
                variant.forEach(function(variant){
                    VariantOption += `<option value="${variant.id}">${variant.variant_name}</option>`;
                });
                $('.variant').html(VariantOption);
            }
        }
     });
});


$(document).on('change','.variant',function(){
    var id = $(this).val();
    $('.stock-table').fadeIn(1000);
    var url = "{{ url('variant/stock/product/row/') }}/" + id;
    $.ajax({
        url:url,
        type: 'GET',
        success:function(data){
            console.log(data);
            if(data.status == 200){

                let variant = data.variant;
                let stockQuantity =data.stockQuantity;
                console.log(stockQuantity);
                $('.newVariant').append(`
                  <tr data-id="${id}" class="align-middle">
                    <td>
                        <input type="hidden" name="variant_id[]" value="${variant.id}">
                        <input type="hidden" name="product_id[]" value="${variant.product_id}">
                    </td>
                    <td class="fw-bold text-primary">${variant.product.product_name}</td>
                    <td class="fw-bold text-primary">${variant.variant_name}</td>
                    <td class="text-center">
                        <span class="badge  bg-primary fs-6 px-3 py-2 stock-update">${stockQuantity}</span>
                    </td>
                    <td>
                        <input type="number" name="quantity[]" class="form-control text-center fw-semibold border-primary" style="width: 100px;">
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>

                `);

                      setTimeout(function () {
                    $('.product').val('').off('change');
                    $('.variant').val('').off('change');


                    setTimeout(function () {
                        $('.product').on('change');
                        $('.variant').on('change');
                    }, 500);
                }, 300);
            }
        },
    });
});


$(document).on('click', '.remove-row', function () {
    $(this).closest('tr').remove();
});


    $(document).on('click','.updateMultipleStock',function(){


        let isValid = true;
        $(".error-message").remove();

        $('input[name="quantity[]"]').each(function () {
            let value = ($(this).val() || '').trim();

            if (value === '') {
                $(this).addClass('is-invalid');
                $(this).after('<span class="text-danger error-message">Quantity is required</span>');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            return;
        }






        let formData=new FormData($('#stockUpdateForm')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            url: "{{url('update/multiple/stock')}}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.status == 200){
                    let updateStock=response.updatestock;
                    toastr.success("Stock Updated Successfully");
                     window.location.href = "{{ route('stock.view') }}";
                    updateStock.forEach(function(stock){
                        $('.stock-update').text(stock.stock_quantity);
                    })


                }
            },
        });

    });



</script>
@endsection
