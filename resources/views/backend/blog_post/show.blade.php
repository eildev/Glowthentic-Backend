@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">All Blog List</h5>

                        <a href="{{ route('blog.post.add.view') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Tags</th>
                                    <th>image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @if ($blogPost->count() > 0)
                                    @foreach ($blogPost as $blog)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $blog['category']['cat_name'] }}</td>
                                            <td>{{ Illuminate\Support\Str::limit($blog->title, 20) }}</td>
                                            <td>
                                                <?php
                                                    $text = $blog->desc;
                                                    $strippedText = strip_tags($text, '<br>');
                                                    $trimmedText = mb_substr($strippedText, 0, 30);
                                                    $trimmedTextWithTags = nl2br($trimmedText);
                                                    echo $trimmedTextWithTags;
                                                ?>..
                                                 </td>
                                            <td> {{ $blog->tags }}  </td>

                                            <td>
                                                <img src="{{ asset('/uploads/blog/blog_post/'.$blog->image) }}"
                                                    style="height: 50px;width:50px;" class="img-fluid" alt="banner Image">
                                            </td>
                                            <td>
                                                @if( $blog->status == 0)
                                                <a href="{{route('blog.post.inactive',$blog->id)}}"class="btn btn-warning btn-sm" title="Edit Data">Inactive</a>
                                                @else
                                                    <a href="{{route('blog.post.active',$blog->id)}}"class="btn btn-success btn-sm" title="Edit Data">Active</a>
                                                @endif

                                                <a href="{{route('blog.post.edit',$blog->id)}}"class="btn btn-info btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <a href="{{route('blog.post.delete',$blog->id)}}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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
