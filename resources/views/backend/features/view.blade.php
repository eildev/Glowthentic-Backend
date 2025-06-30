@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-0 border-top border-3 border-info col-md-8 offset-md-2">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Feature</h5>

                        <a href="{{ route('product.feature.index') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Feature Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($features->count() > 0)
                                    @foreach ($features as $feature)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $feature->feature_name ?? '' }}</td>
                                            <td>
                                                <img src="{{ asset($feature->image) }}"
                                                    style="height: 80px; object-fit: contain;" class="img-fluid"
                                                    alt="">
                                            </td>
                                            <td>
                                                <form action="{{ route('feature.status', $feature->id) }}" method="POST">
                                                    @csrf
                                                    @if ($feature->status == 0)
                                                        <button class="btn btn-sm btn-danger status_inactive"
                                                            value="{{ $feature->id }}">Inactive</button>
                                                    @else
                                                        <button class="btn btn-sm btn-success status_active"
                                                            value="{{ $feature->id }}">Active</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('feature.edit', $feature->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('feature.delete', $feature->id) }}" class="btn btn-danger"
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
