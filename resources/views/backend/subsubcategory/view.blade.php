@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-8 offset-md-2">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Sub-Subcategory</h5>

                        <a href="{{ route('sub.subcategory') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Sub-subcategory Name</th>
                                    <th>Subategory Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($sub_subcategories->count() > 0)
                                    @foreach ($sub_subcategories as $sub_subcategory)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $sub_subcategory->subSubcategoryName }}</td>
                                            <td>{{ $sub_subcategory->subcategory->subcategoryName }}</td>
                                            <td>{{ $sub_subcategory->slug }}</td>
                                            <td>
                                                <a href="#"
                                                    class="btn btn-sm btn-success sub_subcat_active">Active</a>
                                                <a href="#" class="btn btn-sm btn-success sub_subcat_inactive"
                                                    style="display: none;">Inactive</a>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <ul class="dropdown-menu" data-popper-placement="bottom-start"
                                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">
                                                        <li><a href="{{ route('sub.subcategory.edit', $sub_subcategory->id) }}"
                                                                class="dropdown-item">Edit</a></li>
                                                        <li><a href="{{ route('sub.subcategory.delete', $sub_subcategory->id) }}"
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
