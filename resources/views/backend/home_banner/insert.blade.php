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
                                        <input type="text" name="title" class="form-control" id="inputEnterYourName"
                                            placeholder="Enter Banner Title">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Short Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control " name="short_description" placeholder="" style="resize: none; height: 100px;"></textarea>
                                        @if ($errors->has('short_description'))
                                            <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Long Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="long_description" placeholder="" style="resize: none; height: 150px;"></textarea>
                                        @if ($errors->has('long_description'))
                                            <span class="text-danger">{{ $errors->first('long_description') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Link</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="link" class="form-control" id="inputEnterYourName"
                                            value="{{ old('link') }}" placeholder="Enter Banner Link">
                                        @if ($errors->has('link'))
                                            <span class="text-danger">{{ $errors->first('link') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Banner Thumbnail </label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6 g-4">
                                                <span>Small Device</span>
                                                <input type="file" class="form-control image-input" name="small_image"
                                                    data-preview="smallImagePreview">
                                                <div class="my-1">
                                                    <i>
                                                        <b>Note:</b> Please provide 654 X 713 size
                                                        image
                                                    </i>
                                                </div>
                                                @if ($errors->has('small_image'))
                                                    <span class="text-danger">{{ $errors->first('small_image') }}</span>
                                                @endif
                                                <div class="mt-3">
                                                    <img id="smallImagePreview" class="image-preview" height="150"
                                                        width="200" src="{{ asset('uploads/productempty.jpg') }}"
                                                        alt="Baner image">
                                                </div>
                                            </div>
                                            <div class="col-md-6 g-4">
                                                <span>Medium Device</span>
                                                <input type="file" class="form-control image-input" name="medium_image"
                                                    data-preview="mediumImagePreview">
                                                <div class="my-1">
                                                    <i>
                                                        <b>Note:</b> Please provide 1024 X 713 size
                                                        image
                                                    </i>
                                                </div>
                                                @if ($errors->has('medium_image'))
                                                    <span class="text-danger">{{ $errors->first('medium_image') }}</span>
                                                @endif
                                                <div class="mt-3">
                                                    <img id="mediumImagePreview" class="image-preview" height="150"
                                                        width="200" src="{{ asset('uploads/productempty.jpg') }}"
                                                        alt="Baner image">
                                                </div>
                                            </div>
                                            <div class="col-md-6 g-4">
                                                <span>Large Device</span>
                                                <input type="file" class=" form-control image-input" name="large_image"
                                                    data-preview="largeImagePreview">
                                                <div class="my-1">
                                                    <i>
                                                        <b>Note:</b> Please provide 1440 X 713 size
                                                        image
                                                    </i>
                                                </div>
                                                @if ($errors->has('large_image'))
                                                    <span class="text-danger">{{ $errors->first('large_image') }}</span>
                                                @endif
                                                <div class="mt-3">
                                                    <img id="largeImagePreview" class="image-preview"height="150"
                                                        width="200" src="{{ asset('uploads/productempty.jpg') }}"
                                                        alt="Baner image">
                                                </div>
                                            </div>
                                            <div class="col-md-6 g-4">
                                                <span>Extra Large Device</span>
                                                <input type="file" class="form-control image-input"
                                                    name="extra_large_image" data-preview="extraLargeImagePreview">
                                                <div class="my-1">
                                                    <i>
                                                        <b>Note:</b> Please provide 1920 X 713 size
                                                        image
                                                    </i>
                                                </div>
                                                @if ($errors->has('extra_large_image'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('extra_large_image') }}</span>
                                                @endif
                                                <div class="mt-3">
                                                    <img id="extraLargeImagePreview" height="150" width="200"
                                                        src="{{ asset('uploads/productempty.jpg') }}" alt="Baner image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        $(document).ready(function() {

            $('.image-input').each(function() {
                const $input = $(this);
                const previewId = '#' + $input.data('preview');

                $input.change(function() {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            $(previewId).attr('src', event.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });




            $("#submitBtn").on("click", function(e) {
                e.preventDefault();

                let form = $("#homeBanerForm");
                let title = $("input[name='title']").val().trim();
                let short_description = $("textarea[name='short_description']").val().trim();
                let long_description = $("textarea[name='long_description']").val().trim();
                let link = $("input[name='link']").val().trim();
                let small_image = $("input[name='small_image']")[0].files[0];
                let medium_image = $("input[name='medium_image']")[0].files[0];
                let large_image = $("input[name='large_image']")[0].files[0];
                let extra_large_image = $("input[name='extra_large_image']")[0].files[0];

                // Clear previous error messages
                $(".text-danger").remove();

                let errors = {};

                if (title === "") {
                    errors.title = "Title is required!";
                }


                function validateImage(file, fieldName, errors) {
                    if (!file) {
                        errors[fieldName] = `${fieldName.replace('_', ' ').toUpperCase()} is required!`;
                    } else {
                        let fileSize = file.size / 1024; // Size in KB
                        let fileType = file.type;
                        let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
                        let maxSizeKB = 5120; // 5MB

                        if (!allowedTypes.includes(fileType)) {
                            errors[fieldName] = "Only JPG, JPEG, and PNG files are allowed!";
                        } else if (fileSize > maxSizeKB) {
                            errors[fieldName] = "Image size must be less than 5MB!";
                        }
                    }
                }

                // Validate each image
                validateImage(small_image, "small_image", errors);
                validateImage(medium_image, "medium_image", errors);
                validateImage(large_image, "large_image", errors);
                validateImage(extra_large_image, "extra_large_image", errors);

                // Show error messages if validation fails
                if (!$.isEmptyObject(errors)) {
                    if (errors.title) {
                        $("input[name='title']").after(`<span class="text-danger">${errors.title}</span>`);
                    }
                    if (errors.small_image) {
                        $("input[name='small_image']").after(
                            `<span class="text-danger">${errors.small_image}</span>`);
                    }
                    if (errors.medium_image) {
                        $("input[name='medium_image']").after(
                            `<span class="text-danger">${errors.medium_image}</span>`);
                    }
                    if (errors.large_image) {
                        $("input[name='large_image']").after(
                            `<span class="text-danger">${errors.large_image}</span>`);
                    }
                    if (errors.extra_large_image) {
                        $("input[name='extra_large_image']").after(
                            `<span class="text-danger">${errors.extra_large_image}</span>`);
                    }
                    return false; // Stop form submission if errors exist
                }

                // Submit the form if no errors
                form.submit();
            });
        });
    </script>
@endsection
