@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">


                <p>{{ session('test') }}</p>
                <div class="card border-top border-0 border-3 border-info">

                    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data" id="homeBanerForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">

                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Add Home Banner</h5>

                                    <a href="{{ route('banner.view') }}" class="btn btn-info btn-sm text-light ">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Title</label>
                                    <div class="col-sm-9">
                                    @if ($errors && $errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                        <input type="text" name="title"
                                            class="form-control"
                                            id="inputEnterYourName"
                                            placeholder="Enter Banner Title">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Short Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control " name="short_description" placeholder=""
                                            style="resize: none; height: 100px;"></textarea>
                                            @if ($errors->has('short_description'))
                                            <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Long Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="long_description" placeholder=""
                                            style="resize: none; height: 150px;"></textarea>
                                        @if ($errors->has('long_description'))
                                            <span class="text-danger">{{ $errors->first('long_description') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Link</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="link"
                                            class="form-control"
                                            id="inputEnterYourName" value="{{ old('link') }}"
                                            placeholder="Enter Banner Link">
                                            @if ($errors->has('link'))
                                            <span class="text-danger">{{ $errors->first('link') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Banner Thumbnail </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image"
                                            class="form-control " name="image">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 654 X 713 size
                                                image
                                            </i>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                        <div class="mt-3">
                                            <img id="showImage" class="" height="150" width="200"
                                                src="{{ asset('uploads/productempty.jpg') }}" alt="Baner image">
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Gallery Images </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image" class="form-control" name="galleryimages[]"
                                            multiple>
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 142 X 83 size
                                                image
                                            </i>
                                        </div>
                                    </div>

                                </div> --}}
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <a class="btn btn-info px-5 text-white" id="submitBtn">Add Banner</a>
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
        $(document).ready(function () {
            $("#submitBtn").on("click", function (e) {
                e.preventDefault();

                let form = $("#homeBanerForm");
                let title = $("input[name='title']").val().trim();
                let short_description = $("textarea[name='short_description']").val().trim();
                let long_description = $("textarea[name='long_description']").val().trim();
                let link = $("input[name='link']").val().trim();
                let imageInput = $("input[name='image']")[0].files[0];

                // Clear previous error messages
                $(".text-danger").remove();

                let errors = {};

                if (title === "") {
                    errors.title = "Title is required!";
                }

                if (short_description === "") {
                    errors.short_description = "Short Description is required!";
                }

                if (long_description === "") {
                    errors.long_description = "Long Description is required!";
                }

                if (link === "") {
                    errors.link = "Link is required!";
                }

                if (!imageInput) {
                    errors.image = "Banner thumbnail is required!";
                } else {
                    let fileSize = imageInput.size / 1024; // Size in KB
                    let fileType = imageInput.type;

                    let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

                    if (!allowedTypes.includes(fileType)) {
                        errors.image = "Only JPG, JPEG, and PNG files are allowed!";
                    } else if (fileSize >5120) { // 2MB
                        errors.image = "Image size must be less than 5MB!";
                    }
                }

                // Show error messages if validation fails
                if (!$.isEmptyObject(errors)) {
                    if (errors.title) {
                        $("input[name='title']").after(`<span class="text-danger">${errors.title}</span>`);
                    }
                    if (errors.short_description) {
                        $("textarea[name='short_description']").after(`<span class="text-danger">${errors.short_description}</span>`);
                    }
                    if (errors.long_description) {
                        $("textarea[name='long_description']").after(`<span class="text-danger">${errors.long_description}</span>`);
                    }
                    if (errors.link) {
                        $("input[name='link']").after(`<span class="text-danger">${errors.link}</span>`);
                    }
                    if (errors.image) {
                        $("input[name='image']").after(`<span class="text-danger">${errors.image}</span>`);
                    }
                    return false; // Stop form submission if errors exist
                }

                // Submit the form if no errors
                form.submit();
            });
        });
    </script>



@endsection
