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
                    <form action="{{ Route('concern.store') }}" method="POST" enctype="multipart/form-data" id="tagForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Add Concern</h5>

                                    <a href="{{ route('concern.view') }}" class="btn-info btn-sm text-light ">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Concern Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" id="inputEnterYourName"
                                            value="{{ old('name') }}" placeholder="Enter Concern Name">
                                        @if (isset($errors) && $errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                </div>


                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Concern Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image" class="form-control " name="image">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 300 X 180 size
                                                image
                                            </i>
                                        </div>
                                        @if (isset($errors) && $errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                        <div class="mt-3">
                                            <img src="/uploads/productempty.jpg" id="showImage" class="showImage"
                                                height="150" alt="Tag image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <a href="" class="btn btn-info px-5" id="submitBtn">Save Concern</a>
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
                let name = $("input[name='name']").val().trim();
                let imageInput = $("input[name='image']")[0].files[0];


                $(".text-danger").text("");

                let errors = {};


                if (name === "") {
                    errors.name = "Concern name is required!";
                }


                if (!imageInput) {
                    errors.image = "Concern Image is required!";
                } else {
                    let fileSize = imageInput.size / 1024;
                    let fileType = imageInput.type;


                    let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

                    if (!allowedTypes.includes(fileType)) {
                        errors.image = "Only JPG, JPEG, and PNG files are allowed!";
                    } else if (fileSize > 2048) {
                        errors.image = "Image size must be less than 2MB!";
                    }
                }


                if (!$.isEmptyObject(errors)) {
                    if (errors.name) {
                        $("input[name='name']").after(
                            `<span class="text-danger">${errors.name}</span>`);
                    }
                    if (errors.image) {
                        $("input[name='image']").after(`<span class="text-danger">${errors.image}</span>`);
                    }
                    return false;
                }


                form.submit();
            });
        });
    </script>
@endsection
