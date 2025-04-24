@extends('backend.master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Product Table</li>
                    </ol>
                </nav>
            </div>


            <div class="ms-auto">
                {{-- <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                            href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div> --}}
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Products</h5>

                        <a href="{{ route('product') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                   
                                    <th>Product name</th>
                                     <th>Image</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Brand</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                    // dd($products->varient);
                                @endphp
                                @if ($products->count() > 0)
                                    @foreach ($products as $product)

                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>

                                            {{-- <td>
                                                <img src="{{ asset($product->varient[0]->image)??'' }}"
                                                    style="height: 50px; object-fit: cover;" class="img-fluid"
                                                    alt="Products Image">
                                            </td> --}}
                                            <td>{{ Illuminate\Support\Str::limit($product->product_name, 29) }}</td>
                                            <td>  @if($product->variantImage && $product->variantImage->whereNull('deleted_at')->first())
                                                <img src="{{ asset($product->variantImage->whereNull('deleted_at')->first()->image) }}" class="img-fluid" alt="product-image" style="height:80px;">
                                            @endif</td>
                                            <td>{{ $product->category->categoryName??'' }}</td>
                                            @php
                                                $subcategory=App\Models\Category::find($product->subcategory_id);
                                            @endphp
                                            <td>{{ $subcategory->categoryName ?? '' }}</td>
                                            <td>{{ $product->brand->BrandName??'' }}</td>
                                            <td>{{ $product->unit_id??'' }}</td>
                                            <td>
                                                ৳{{ $product->varient[0]->regular_price ?? 0 }}
                                            </td>
                                            @php
                                                $Total_stock = App\Models\ProductStock::where('product_id', $product->id)->sum('StockQuantity')??0;
                                            @endphp
                                            {{-- @dd($Total_stock) --}}
                                            <td>
                                                {{ $Total_stock}}
                                            </td>

                                            <td>
                                                <form action="{{ route('product.status', $product->id) }}" method="POST">
                                                    @csrf
                                                    @if ($product->status == 0)
                                                        <button class="btn btn-sm btn-danger status_inactive"
                                                            value="{{ $product->id }}">Inactive</button>
                                                    @else
                                                        <button class="btn btn-sm btn-success status_active"
                                                            value="{{ $product->id }}">Active</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                <div class="col">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <ul class="dropdown-menu" data-popper-placement="bottom-start"
                                                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('product.view.details', $product->id) }}">View
                                                                    Details</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('product.edit', $product->id) }}">Edit</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('product.delete', $product->id) }}"
                                                                    id="delete">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center text-warning">Data not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- @if ($products->count() > 9)
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                        <ul class="pagination">
                            @if ($products->onFirstPage())
                                <li class="paginate_button page-item previous disabled" id="example_previous">
                                    <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0"
                                        class="page-link">Prev</a>
                                </li>
                            @else
                                <li class="paginate_button page-item previous">
                                    <a class="page-link pt-0" href="{{ $products->previousPageUrl() }}" rel="prev"
                                        aria-label="@lang('pagination.previous')">Prev</a>
                                </li>
                            @endif

                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="example"
                                            data-dt-idx="1" tabindex="0" class="page-link">{{ $page }}</a></li>
                                @else
                                    <li class="paginate_button page-item "><a href="{{ $url }}"
                                            aria-controls="example" data-dt-idx="2" tabindex="0"
                                            class="page-link">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="2"
                                    tabindex="0" class="page-link">2</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="3"
                                    tabindex="0" class="page-link">3</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="4"
                                    tabindex="0" class="page-link">4</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example"
                                    data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="example"
                                    data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                            <li class="paginate_button page-item next" id="example_next"><a href="#"
                                    aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif --}}
        </div>
        <!--end row-->
    </div>



    <script>
        // $(document).ready(function() {
        //     // Status Update
        //     $(document).on('click', '.status_active', function(e) {
        //         e.preventDefault();
        //         // alert("ok");
        //         let id = this.value;


        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });

        //         $.ajax({
        //             url: '/product/status/' + id,
        //             type: 'POST',
        //             data: {
        //                 'status': 0,
        //             },
        //             contentType: false,
        //             processData: false,
        //             success: function(response) {
        //                 if (response.status == 200) {
        //                     toastr.success(response.message);
        //                     $(this).css('display', 'none');
        //                     $('.status_inactive').css('display', 'block');
        //                 } else {
        //                     toastr.error('status changed unsuccessful');
        //                 }
        //             }
        //         });
        //     })
        // })
    </script>
@endsection
