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
                                @foreach ($productPromotion as $key => $promotionGroup)
                                @php
                                    $promotionProduct = $promotionGroup->first(); // Get the first item in the group
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td><a href="{{ route('product.promotion.view',$promotionProduct->promotion_id ) }}" class="text-dark">{{ $promotionProduct->coupon->promotion_name ?? 'N/A' }}</a></td>

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
                                                <li><a href="#" class="dropdown-item delete" data-id={{$promotionProduct->promotion_id}}>Delete</a></li>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).on('click', '.delete', function() {
    var promotion_id = $(this).data('id');
    alert(promotion_id);

    $.ajax({
        url: "{{ route('promotion.delete') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            promotion_id: promotion_id
        },
        success: function(response) {

            if (response.status==200) {
                toastr.success("Promotion deleted successfully!");
                location.reload();
            } else {
                alert("Failed to delete promotion.");
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert("Something went wrong!");
        }
    });
});
</script>

    </script>
@endsection
