@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-8 offset-md-2">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Popup Messages</h5>

                        <a href="{{ route('popupMessage') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($popupMessages->count() > 0)
                                    @foreach ($popupMessages as $popupMessage)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $popupMessage->title }}</td>
                                            <td>{{ $popupMessage->description }}</td>
                                            <td>
                                                <img src="{{ asset('/uploads/popupMessage/' . $popupMessage->image) }}"
                                                    style="height: 100px;" class="img-fluid" alt="Popup message Image">
                                            </td>
                                            <td>{{ $popupMessage->status }}</td>
                                            <td>
                                                <a href="{{ route('popupMessage.edit', $popupMessage->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('popupMessage.delete', $popupMessage->id) }}"
                                                    class="btn btn-danger" id="delete">Delete</a>
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
