@extends('backend.master')
@section('admin')
<div class="page-content">
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm rounded p-3">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-white" href="#">Steadfast Parcel Tracking</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <div class="ms-auto">  <!-- Push content to the right -->
                        <a href="{{ route('Courier.steadfast') }}" class="btn btn-light text-primary fw-bold">
                            <i class="bx bx-plus"></i> Manual Courier Add
                        </a>
                    </div>
                </div>
            </div>
        </nav>


        <!-- Tabs -->
        <div class="card mt-4 shadow-sm rounded">
            <div class="card-header bg-white">
                <ul class="nav nav-tabs card-header-tabs" id="parcelTabs">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#all">All</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#pending">Pending</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#approval">Approval Pending</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#delivered">Delivered</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#cancelled">Cancelled</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="all" class="tab-pane fade show active">
                        <h5 class="mb-3">All Parcels</h5>
                        <div class="table-responsive">
                            <table id="steadfastTable" class="table table-hover table-bordered steadfastTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>SL#</th>
                                        <th>Date</th>
                                        <th>Id</th>
                                        <th>Customer Name</th>
                                        <th>Payment</th>
                                        {{-- <th>Charge</th> --}}
                                        <th>Status</th>
                                        {{-- <th>Details</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($SteadfastStatus as $key => $SteadfastStatus)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$SteadfastStatus->created_at}}</td>
                                        <td>{{  $SteadfastStatus->order->invoice_number }}</td>
                                        <td>{{$SteadfastStatus->order->user->userDetails->full_name}}</td>
                                        <td>{{$SteadfastStatus->order->grand_total}}</td>
                                        {{-- <td>৳50</td> --}}
                                        <td><span class="badge bg-warning text-dark">{{$SteadfastStatus->status}}</span></td>
                                        {{-- <td><a href="#" class="btn btn-sm btn-primary">View</a></td> --}}
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>




                    <div id="pending" class="tab-pane fade text-center py-3">
                        <table class="table table-hover table-bordered steadfastTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>SL#</th>
                                    <th>Date</th>
                                    <th>Id</th>
                                    <th>Customer Name</th>
                                    <th>Payment</th>
                                    {{-- <th>Charge</th> --}}
                                    <th>Status</th>
                                    {{-- <th>Details</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($pendingStatus as $key => $SteadfastStatus)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$SteadfastStatus->created_at}}</td>
                                    <td>{{  $SteadfastStatus->order->invoice_number }}</td>
                                    <td>{{$SteadfastStatus->order->user->userDetails->full_name}}</td>
                                    <td>{{$SteadfastStatus->order->grand_total}}</td>
                                    {{-- <td>৳50</td> --}}
                                    <td><span class="badge bg-warning text-dark">{{$SteadfastStatus->status}}</span></td>
                                    {{-- <td><a href="#" class="btn btn-sm btn-primary">View</a></td> --}}
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>






                    <div id="approval" class="tab-pane fade text-center py-3">
                        <table class="table table-hover table-bordered steadfastTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>SL#</th>
                                    <th>Date</th>
                                    <th>Id</th>
                                    <th>Customer Name</th>
                                    <th>Payment</th>
                                    {{-- <th>Charge</th> --}}
                                    <th>Status</th>
                                    {{-- <th>Details</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($ApprovelStatus as $key => $SteadfastStatus)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$SteadfastStatus->created_at}}</td>
                                    <td>{{  $SteadfastStatus->order->invoice_number }}</td>
                                    <td>{{$SteadfastStatus->order->user->userDetails->full_name}}</td>
                                    <td>{{$SteadfastStatus->order->grand_total}}</td>
                                    {{-- <td>৳50</td> --}}
                                    <td><span class="badge bg-warning text-dark">{{$SteadfastStatus->status}}</span></td>
                                    {{-- <td><a href="#" class="btn btn-sm btn-primary">View</a></td> --}}
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div id="delivered" class="tab-pane fade text-center py-3">
                        <table class="table table-hover table-bordered steadfastTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>SL#</th>
                                    <th>Date</th>
                                    <th>Id</th>
                                    <th>Customer Name</th>
                                    <th>Payment</th>
                                    {{-- <th>Charge</th> --}}
                                    <th>Status</th>
                                    {{-- <th>Details</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($deliveredStatus as $key => $SteadfastStatus)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$SteadfastStatus->created_at}}</td>
                                    <td>{{  $SteadfastStatus->order->invoice_number }}</td>
                                    <td>{{$SteadfastStatus->order->user->userDetails->full_name}}</td>
                                    <td>{{$SteadfastStatus->order->grand_total}}</td>
                                    {{-- <td>৳50</td> --}}
                                    <td><span class="badge bg-warning text-dark">{{$SteadfastStatus->status}}</span></td>
                                    {{-- <td><a href="#" class="btn btn-sm btn-primary">View</a></td> --}}
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>



                    <div id="cancelled" class="tab-pane fade text-center py-3">
                        <table class="table table-hover table-bordered steadfastTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>SL#</th>
                                    <th>Date</th>
                                    <th>Id</th>
                                    <th>Customer Name</th>
                                    <th>Payment</th>
                                    {{-- <th>Charge</th> --}}
                                    <th>Status</th>
                                    {{-- <th>Details</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($cancelStatus as $key => $SteadfastStatus)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$SteadfastStatus->created_at}}</td>
                                    <td>{{  $SteadfastStatus->order->invoice_number }}</td>
                                    <td>{{$SteadfastStatus->order->user->userDetails->full_name}}</td>
                                    <td>{{$SteadfastStatus->order->grand_total}}</td>
                                    {{-- <td>৳50</td> --}}
                                    <td><span class="badge bg-warning text-dark">{{$SteadfastStatus->status}}</span></td>
                                    {{-- <td><a href="#" class="btn btn-sm btn-primary">View</a></td> --}}
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.steadfastTable').DataTable({
            "paging": true,          // Enable pagination
            "searching": true,       // Enable search bar
            "ordering": true,        // Enable sorting
            "info": true,            // Show info (Showing X of Y entries)
            "lengthMenu": [10, 25, 50, 100], // Custom page length options
            "language": {
                "search": "Search:",   // Customize search box text
                "lengthMenu": "Show _MENU_ entries",
                "zeroRecords": "No matching records found"
            }
        });
    });
</script>

@endsection
