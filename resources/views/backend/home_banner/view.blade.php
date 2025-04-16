@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Home Banner</h5>

                        <a href="{{ route('banner') }}" class="btn btn-info btn-sm text-light ">
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
                                    <th>Short Description</th>
                                    <th>Long Description</th>
                                    <th>Small Image</th>
                                    <th>Medium Image</th>
                                    <th>Large Image</th>
                                    <th>Extra Large Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($all_banner->count() > 0)
                                    @foreach ($all_banner as $banner)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ Illuminate\Support\Str::limit($banner->title, 15) }}</td>
                                            <td>{{ Illuminate\Support\Str::limit($banner->short_description, 20) }}</td>
                                            <td>{{ Illuminate\Support\Str::limit($banner->long_description, 20) }}</td>

                                            <td>
                                                <img src="{{ asset($banner->small_image) }}"
                                                    style="height: 100px; object-fit: contain;" class="img-fluid"
                                                    alt="banner Image">
                                            </td>
                                            <td>
                                                <img src="{{ asset($banner->medium_image) }}"
                                                    style="height: 100px; object-fit: contain;" class="img-fluid"
                                                    alt="banner Image">
                                            </td>
                                            <td>
                                                <img src="{{ asset($banner->large_image) }}"
                                                    style="height: 100px; object-fit: contain;" class="img-fluid"
                                                    alt="banner Image">
                                            </td>
                                            <td>
                                                <img src="{{ asset($banner->extra_large_image) }}"
                                                    style="height: 100px; object-fit: contain;" class="img-fluid"
                                                    alt="banner Image">
                                            </td>
                                            <td>
                                                <form action="{{ route('banner.status', $banner->id) }}" method="POST">
                                                    @csrf
                                                    @if ($banner->status == 0)
                                                        <button class="btn btn-sm btn-danger status_inactive"
                                                            value="{{ $banner->id }}">Inactive</button>
                                                    @else
                                                        <button class="btn btn-sm btn-success status_active"
                                                            value="{{ $banner->id }}">Active</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('banner.edit', $banner->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('banner.delete', $banner->id) }}" class="btn btn-danger"
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


    <script>
        // $(document).ready(function() {
        //     // let csrfToken = $('meta[name="csrf-token"]').attr('content');
        //     $('.home_banner_active').on('click', function(e) {
        //         e.preventDefault();
        //         // alert('ok')

        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //         let id = this.getAttribute('value');
        //         $.ajax({
        //             url: '/banner/status/' + id,
        //             type: "POST",
        //             data: {
        //                 status: 0
        //             },
        //             contentType: false,
        //             processData: false,
        //             // headers: {
        //             //     'X-CSRF-TOKEN': csrfToken
        //             // },
        //             suuccess: function(response) {
        //                 console.log(response);
        //             }
        //             // error: function(xhr, status, error) {
        //             //     console.error(xhr.responseText);
        //             // }
        //         })

        //     });
        // });
    </script>
@endsection
