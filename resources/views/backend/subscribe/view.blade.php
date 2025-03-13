@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-0 border-top border-3 border-info col-md-8 offset-md-2">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Subscribers list</h5>

                        <a href="{{ route('brand') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Subscriber Emails</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($subscribers->count() > 0)
                                    @foreach ($subscribers as $subscriber)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $subscriber->email }}</td>

                                            <td>{{ $subscriber->status }}</td>
                                            <td>
                                                <a href="{{ route('subscribe.delete', $subscriber->id) }}" class="btn btn-danger"
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
