@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Company Details</h5>

                        <a href="{{ route('company-details') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Company Name</th>
                                    <th>Manager Name</th>
                                    <th>Company Details</th>
                                    <th>Status</th>
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
                                            <td>{{ Illuminate\Support\Str::limit($item->company_name ?? '', 15) }}</td>
                                            <td>{{ Illuminate\Support\Str::limit($item->manager_name ?? '', 15) }}</td>
                                            <td>
                                                <div class="d-flex justify-items-center align-items-center">
                                                    <div class="ms-3">
                                                        <p class="text-muted mb-0">
                                                            {{ Illuminate\Support\Str::limit($item->address ?? '', 15) }}
                                                        </p>
                                                        <p class="text-muted mb-0">
                                                            {{ Illuminate\Support\Str::limit($item->email ?? '', 15) }}</p>
                                                        <p class="text-muted mb-0">
                                                            {{ Illuminate\Support\Str::limit($item->phone ?? '', 15) }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{{ route('company-details.status', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @if ($item->status == 0)
                                                        <button class="btn btn-sm btn-danger status_inactive"
                                                            value="{{ $item->id }}">Inactive</button>
                                                    @else
                                                        <button class="btn btn-sm btn-success status_active"
                                                            value="{{ $item->id }}">Active</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <ul class="dropdown-menu" data-popper-placement="bottom-start"
                                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">
                                                        <li> <a href="{{ route('company-details.edit', $item->id) }}"
                                                                class="dropdown-item">Edit</a></li>
                                                        <li><a href="{{ route('company-details.delete', $item->id) }}"
                                                                class="dropdown-item" id="delete">Delete</a>
                                                        </li>
                                                    </ul>
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
        </div>
        <!--end row-->
    </div>
@endsection
