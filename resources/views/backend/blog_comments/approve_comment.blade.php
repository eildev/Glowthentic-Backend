@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">All Approve Comment</h5>

                        <a href="{{ route('blog.all.pending.comment') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>User Name </th>
                                    <th>Comments</th>
                                    <th>Blog title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 {{-- //{{ Illuminate\Support\Str::limit($comments->blog_id, 30) }} --}}
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($blogComment->count() > 0)
                                    @foreach ($blogComment as $comments)
                                        @if($comments->status == 1)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $comments['user']['fullName']}}</td>
                                            <td>{{Illuminate\Support\Str::limit($comments->comment, 20) }}</td>
                                            <td> {{ $comments['blog']['title']}}  </td>
                                            @if( $comments->status == 1)
                                            <td> <span class="badge rounded-pill bg-success">Approved</span> </td>
                                            @else
                                            @endif
                                            <td>
                                                <a href="{{route('comment.approve.cancel',$comments->id)}}" class="btn btn-warning btn-sm" title="Approve Cancel" >Approved Cancel</a>

                                                <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$comments->id}}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop{{$comments->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"> Full Comment</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="overflow: auto">
                                            <p>{{$comments->comment}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('comment.delete',$comments->id)}}" class="btn btn-danger btn-sm" title="Delete Comment" id="delete">Delete</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                            </td>
                                          </tr>
                                          @else

                                          @endif
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
