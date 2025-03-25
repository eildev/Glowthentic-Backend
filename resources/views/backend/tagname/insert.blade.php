@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif




                    <form action="{{ Route('tagname.store') }}" method="POST" enctype="multipart/form-data" id="tagForm">
                        @csrf
                        <div class="card-body">

                            <div class="border p-4 rounded">

                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Add Tag</h5>

                                    <a href="{{ route('tagname.view') }}" class="btn-info btn-sm text-light ">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Tag Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tagname"
                                            class="form-control"
                                            id="inputEnterYourName" value="{{ old('tagname') }}"
                                            placeholder="Enter Tag Name">
                                         @if(isset($errors) && $errors->has('tagname'))
                                         <span class="text-danger">{{ $errors->first('tagname') }}</span>
                                         @endif
                                    </div>

                                </div>


                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Tag Thumbnail </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image"
                                            class="form-control " name="image">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 300 X 180 size
                                                image
                                            </i>
                                        </div>
                                        @if(isset($errors) && $errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                        <div class="mt-3">
                                            <img id="showImage" class="showImage" height="150" width="200"
                                                 alt="Tag image">
                                        </div>
                                    </div>

                                </div>



                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5">Add Tagname</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>

  <script>


  </script>




@endsection
