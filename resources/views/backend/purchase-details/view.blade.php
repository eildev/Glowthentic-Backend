@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Purchase Details</h5>

                        <a href="{{ route('purchase') }}" class="btn btn-info btn-sm text-light ">
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
                                    <th>Company Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Grand Total</th>
                                    <th>Action</th>
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
                                            <td>
                                                <p>{{ Illuminate\Support\Str::limit($item->product->product_name ?? '', 30) }}</p>
                                            </td>
                                            <td>{{ Illuminate\Support\Str::limit($item->company->company_name ?? '', 15) }}
                                            </td>
                                            <td>{{ $item->quantity ?? '' }}</td>
                                            <td>{{ $item->unit_price ?? '' }}</td>
                                            <td>{{ $item->grand_total ?? '' }}</td>
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
