@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-6 offset-md-3">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Concern</h5>

                        <a href="{{ route('concern') }}" class="btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Concern Name</th>
                                    <th>Concern Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($concerns->count() > 0)
                                    @foreach ($concerns as $concern)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $concern->name ?? '' }}</td>
                                            <td>
                                                <img height="100"
                                                    src="/{{ $concern->image ? $concern->image : 'uploads/productempty.jpg' }}"
                                                    alt="Concern Image">
                                            </td>
                                            <td>
                                                <form action="{{ route('concern.status', $concern->id) }}" method="POST">
                                                    @csrf
                                                    @if ($concern->status == 'inactive')
                                                        <button class="btn btn-sm btn-danger status_inactive"
                                                            value="{{ $concern->id }}">Inactive</button>
                                                    @else
                                                        <button class="btn btn-sm btn-success status_active"
                                                            value="{{ $concern->id }}">Active</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('concern.edit', $concern->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('concern.delete', $concern->id) }}" class="btn btn-danger"
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
