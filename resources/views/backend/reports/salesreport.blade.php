@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Sales Report</h5>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#sl</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Product Price</th>
                                    <th>Sale Price</th>
                                    <th>T. P. Price</th>
                                    <th>T. S. Price</th>
                                    <th>Different</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($allData->count() > 0)
                                    @foreach ($allData as $item)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ Illuminate\Support\Str::limit($item->company->company_name ?? '', 15) }}
                                            </td>
                                            <td>{{ Illuminate\Support\Str::limit($item->product->product_name ?? '', 15) }}
                                            </td>
                                            <td>{{ $item->quantity ?? '' }}</td>
                                            <td>{{ $item->unit_price ?? '' }}</td>
                                            <td>{{ $item->grand_total ?? '' }}</td>
                                            <td>{{ $item->payable_amount ?? '' }}</td>
                                            <td>{{ $item->due ?? '' }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <ul class="dropdown-menu" data-popper-placement="bottom-start"
                                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">
                                                        <li> <a href="{{ route('purchase.view.details', $item->id) }}"
                                                                class="dropdown-item">View Details</a></li>
                                                        <li> <a href="{{ route('purchase.edit', $item->id) }}"
                                                                class="dropdown-item">Edit</a></li>
                                                        <li><a href="{{ route('purchase.delete', $item->id) }}"
                                                                class="dropdown-item" id="delete">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center text-warning">Data not Found</td>
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
@endsection
