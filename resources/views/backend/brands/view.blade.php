@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-0 border-top border-3 border-info col-md-8 offset-md-2">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Brands</h5>

                        <a href="{{ route('brand') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Brand Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($Brands->count() > 0)
                                    @foreach ($Brands as $Brand)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $Brand->BrandName }}</td>
                                            <td>
                                                <img src="{{ asset('/uploads/brands/' . $Brand->image) }}"
                                                    style="height: 80px; object-fit: contain;" class="img-fluid"
                                                    alt="">
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-success brand_active">Active</a>
                                                <a href="#" class="btn btn-sm btn-success brand_inactive"
                                                    style="display: none;">Inactive</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('brand.edit', $Brand->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('brand.delete', $Brand->id) }}" class="btn btn-danger"
                                                    id="delete">Delete</a>
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
        </div>
        <!--end row-->
    </div>
@endsection
