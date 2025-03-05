@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">All Pending Comment</h5>

                        <a href="{{ route('blog.all.approved.comment') }}" class="btn btn-info btn-sm text-light ">
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
                                    @if($comments->status == 0)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $comments['user']['fullName']}}</td>
                                            <td>{{Illuminate\Support\Str::limit($comments->comment, 20) }}
                                            </td>
                                            <td> {{ $comments['blog']['title']}}  </td>
                                            @if( $comments->status == 0)
                                            <td> <span class="badge rounded-pill bg-warning">Pending</span> </td>
                                            @endif
                                            <td>
                                                {{-- //Approve modal--}}

                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$comments->id}}">
                                                Approve
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$comments->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Full Comment</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="overflow:auto">
                                                        {{ $comments->comment }}
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                    <a href="{{route('blog.comment.approve',$comments->id)}}" class="btn btn-success btn-sm" title="Approve Comment" >Approve</a>

                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            {{-- //Approve modal--}}
                                    <a href="{{route('comment.delete',$comments->id)}}" class="btn btn-danger btn-sm" title="Delete Comment" id="delete"><i class="fas fa-trash-alt"></i></a>
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


    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

@endsection
