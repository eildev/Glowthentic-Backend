@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Products</h5>

                        <a href="#" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>User Name</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($allusers->count() > 0)
                                    @foreach ($allusers as $alluser)
                                        {{-- @dd($product->brand->BrandName); --}}

                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $alluser->userName }}</td>
                                            <td>{{ $alluser->fullName }}</td>
                                            <td>{{ $alluser->phone }}</td>
                                            <td>{{ $alluser->email}}</td>

                                            <td>
                                                @if ( $alluser->status == 'Active')
                                                    <a href="{{ route('admin.disable-user',$alluser->id) }}" class="btn btn-sm btn-warning">Inactive</a>
                                                @else
                                                    <a href="{{ route('admin.enable-user',$alluser->id) }}" class="btn btn-sm btn-success">Active</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center text-warning">Data not Found</td>
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
