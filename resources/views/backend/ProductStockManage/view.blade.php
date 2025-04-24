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
                        <h5 class="mb-0 text-info">Stock Manage</h5>

                        <a href="{{ route('product.stock.manage') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="order_table1" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Product Name</th>
                                    <th>Variant Name</th>
                                    <th>Category</th>
                                    {{-- <th>Sub Category</th> --}}
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Selling Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($productStock->count() > 0)
                                    @foreach ($productStock as $key => $productStock)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $productStock->product->product_name ?? 'N/A' }}</td>
                                            <td>{{ $productStock->variant->variant_name ?? 'N/A' }}</td>
                                            <td>{{ $productStock->product->category->categoryName ?? 'N/A' }}</td>
                                            {{-- <td>{{ $productStock->product->subcategory->name ?? 'N/A' }}</td> --}}
                                            <td>{{ $productStock->variant->size ?? 'N/A' }}</td>
                                            <td>{{ $productStock->variant->color ?? 'N/A' }}</td>

                                            @if($productStock->variant)
                                            <td>৳{{ number_format($productStock->variant->regular_price, 2)??0}}</td>

                                            @else
                                            <td>N/A</td>
                                            @endif
                                            <td>
                                                <span class="badge bg-primary fs-6">{{ $productStock->StockQuantity??'' }}</span>
                                            </td>
                                            @if($productStock->variant)
                                            @php
                                                $sellingPrice = $productStock->variant->regular_price* $productStock->StockQuantity;
                                            @endphp

                                            @if($sellingPrice)
                                            <td>
                                                <span class="badge bg-primary fs-6">৳{{ number_format($sellingPrice, 2) ??''}}</span>
                                            </td>
                                            @endif
                                            @else
                                            <td></td>
                                            <td></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center text-warning">No Data Found</td>
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



    <script>

            $(document).ready(function() {
                $('#order_table1').DataTable({
                    "paging": true, // Enable Pagination
                    "searching": true, // Enable Search
                    "ordering": true, // Enable Column Sorting
                    "info": true, // Show Info
                    "lengthMenu": [10, 25, 50, 100], // Entries per page
                });
            });


    </script>
@endsection
