@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12 ">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Visitors</h5>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Country</th>
                                    <th>IP</th>
                                    <th>URL</th>
                                    <th>Browser</th>
                                    <th>System user name</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($visitors->count() > 0)
                                    @foreach ($visitors as $visitor)
                                        {{-- @dd($visitor); --}}
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $visitor->country }}</td>
                                            <td class="url-column">{{ $visitor->user_ip }}</td>
                                            <td class="url-column">{{ $visitor->url }}</td>
                                            <td>{{ $visitor->browser_name }}</td>
                                            <td>{{ $visitor->system_user_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($visitor->created_at)->format('F j, Y h:i A') }}
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

    <style>
        .url-column {
            word-wrap: break-word;
            /* Ensures long words break to the next line */
            max-width: 200px;
            /* Adjust this value based on your layout */
            white-space: normal;
            /* Allows text to wrap */
        }
    </style>
@endsection
