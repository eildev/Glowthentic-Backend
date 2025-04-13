@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data"
                        id="homeBanerForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-info">Update Banner</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Banner Title"
                                            value="{{ $banner->title }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Short Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('short_description') is-invalid  @enderror" name="short_description" placeholder=""
                                            style="resize: none; height: 100px;">{{ $banner->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Long Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('long_description') is-invalid  @enderror" name="long_description" placeholder=""
                                            style="resize: none; height: 150px;">{{ $banner->long_description }}</textarea>
                                        @error('long_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Link</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="link"
                                            class="form-control @error('link') is-invalid  @enderror"
                                            id="inputEnterYourName" value="{{ $banner->link }}"
                                            placeholder="Enter Banner Link">
                                        @error('link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                                        width="200" src="{{ asset($banner->small_image) }}"
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
                                                        width="200" src="{{ asset($banner->medium_image) }}"
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
                                                        width="200" src="{{ asset($banner->large_image) }}"
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
                                                        src="{{ asset($banner->extra_large_image) }}" alt="Baner image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <a class="btn btn-info px-5" id="submitBtn">Update Banner</a>
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

                // Get image files (optional since they are not required for update)
                let smallImage = $("input[name='small_image']")[0].files[0];
                let mediumImage = $("input[name='medium_image']")[0].files[0];
                let largeImage = $("input[name='large_image']")[0].files[0];
                let extraLargeImage = $("input[name='extra_large_image']")[0].files[0];

                // Clear previous error messages
                $(".text-danger").remove();

                let errors = {};

                // Validate text fields
                if (title === "") {
                    errors.title = "Title is required!";
                }



                // Reusable function to validate image
                function validateImage(file, fieldName, errors) {
                    if (file) { // Only validate if an image is provided
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

                // Validate each image if provided
                validateImage(smallImage, "small_image", errors);
                validateImage(mediumImage, "medium_image", errors);
                validateImage(largeImage, "large_image", errors);
                validateImage(extraLargeImage, "extra_large_image", errors);

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
        })
    </script>
@endsection
