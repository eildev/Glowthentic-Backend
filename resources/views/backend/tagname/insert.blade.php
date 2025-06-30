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
                                        <input type="text" name="tagname" class="form-control" id="inputEnterYourName"
                                            value="{{ old('tagname') }}" placeholder="Enter Tag Name">
                                        @if (isset($errors) && $errors->has('tagname'))
                                            <span class="text-danger">{{ $errors->first('tagname') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <a href="" class="btn btn-info px-5" id="submitBtn">Save Tagname</a>
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
        $(document).ready(function() {
            $("#submitBtn").on("click", function(e) {
                e.preventDefault();

                let form = $("#tagForm");
                let tagname = $("input[name='tagname']").val().trim();

                $(".text-danger").text("");

                let errors = {};

                if (tagname === "") {
                    errors.tagname = "Tag name is required!";
                }


                if (!$.isEmptyObject(errors)) {
                    if (errors.tagname) {
                        $("input[name='tagname']").after(
                            `<span class="text-danger">${errors.tagname}</span>`);
                    }

                    return false;
                }


                form.submit();
            });
        });
    </script>
@endsection
