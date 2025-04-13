@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('offerbanner.update', $bannerContent->id) }}" method="POST"
                        enctype="multipart/form-data" id="offerBannerForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-info">Update Banner</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner heading</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="heading"
                                            class="form-control @error('title') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Banner heading"
                                            value="{{ $bannerContent->title }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Banner Title"
                                            value="{{ $bannerContent->title }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Short Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('short_description') is-invalid  @enderror" name="short_description" placeholder=""
                                            style="resize: none; height: 100px;">{{ $bannerContent->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Link Button Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="link_button"
                                            class="form-control @error('title') is-invalid  @enderror"
                                            id="inputEnterYourName" value="{{ $bannerContent->link_button }}"
                                            placeholder="Enter Banner Title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Link</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="link"
                                            class="form-control @error('link') is-invalid  @enderror"
                                            id="inputEnterYourName" value="{{ $bannerContent->link }}"
                                            placeholder="Enter Banner Link">
                                        @error('link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Cart Status</label>
                                    <div class="col-sm-9">
                                        <select id="" name="status" class="form-select selectstatus">
                                            <option selected>Choose...</option>
                                            <option value="cart1"
                                                {{ $bannerContent->status == 'cart1' ? 'selected' : '' }}>CART 1</option>
                                            <option value="cart2"
                                                {{ $bannerContent->status == 'cart2' ? 'selected' : '' }}>CART 2</option>
                                            <option value="cart3"
                                                {{ $bannerContent->status == 'cart3' ? 'selected' : '' }}>CART 3</option>
                                            <option value="cart4"
                                                {{ $bannerContent->status == 'cart4' ? 'selected' : '' }}>CART 4</option>
                                            <option value="cart5"
                                                {{ $bannerContent->status == 'cart5' ? 'selected' : '' }}>CART 5</option>

                                        </select>
                                        @error('parent_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>




                                @if ($bannerContent->status == 'cart1')
                                    <div class="row mb-3">
                                        <label for="image" class="col-sm-3 col-form-label">Gallery Images </label>
                                        <div class="col-sm-9">
                                            <input type="file" id="galleryimages" class="form-control"
                                                name="galleryimages[]" multiple>
                                            <div class="my-1">
                                                <i>
                                                    <b>Note:</b> <span class="text-danger">Please provide 142 X 83 size
                                                        image for cart 1 it's not applicable for other cart</span>

                                                </i>
                                            </div>
                                            <div>
                                                @foreach ($bannerContent->images as $image)
                                                    <div style="display: inline-block; margin: 5px; position: relative;"
                                                        id="image-{{ $image->id }}">
                                                        <img src="{{ asset($image->image) }}" height="50" width="50"
                                                            alt="">

                                                        <button class="delete-image" data-id="{{ $image->id }}"
                                                            style="position: absolute; top: 0; right: 0; background: red; color: white; border: none; cursor: pointer;">
                                                            &times;
                                                        </button>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>

                                    </div>

                                @endif

                                <div class="row mb-3 galleryimage" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Gallery Images</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="galleryimages[]" multiple>
                                        <small class="">
                                            Note: Please provide 142x83 image for cart 1. It’s not applicable for others.
                                        </small>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Banner Thumbnail </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image"
                                            class="form-control  @error('image') is-invalid  @enderror" name="image">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 1310 X 220 size
                                                image
                                            </i>
                                        </div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-3">
                                            <img id="showImage" class="" height="150" width="200"
                                                src="{{ asset($bannerContent->image) }}" alt="banner image">

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
            $('.galleryimage').hide();


            $(document).on('change', '.selectstatus', function() {
                var cart = $(this).val();
                console.log("Selected cart: ", cart);

                if (cart === 'cart1') {
                    $('.galleryimage').fadeIn();
                } else {
                    $('.galleryimage').fadeOut();
                }
            });
        });
    </script>


    <script>
        // $(document).ready(function() {
        //     $("#submitBtn").on("click", function(e) {
        //         e.preventDefault();

        //         let form = $("#offerBannerForm");
        //         let heading = $("input[name='heading']").val().trim();
        //         let title = $("input[name='title']").val().trim();
        //         let status = $("select[name='status']").val();
        //         let link = $("input[name='link']").val().trim();
        //         let short_description = $("textarea[name='short_description']").val().trim();
        //         let imageInput = $("input[name='image']")[0].files[0];
        //         let galleryImages = $("input[name='galleryimages[]']")[0].files;

        //         // Clear previous error messages
        //         $(".text-danger").remove();

        //         let errors = {};

        //         // Validation for fields

        //         if (status === "") {
        //             errors.status = "status is required!";
        //         }


        //         if (imageInput) {
        //             let fileSize = imageInput.size / 1024; // Size in KB
        //             let fileType = imageInput.type;

        //             let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

        //             if (!allowedTypes.includes(fileType)) {
        //                 errors.image = "Only JPG, JPEG, and PNG files are allowed!";
        //             } else if (fileSize > 5120) { // 5MB
        //                 errors.image = "Image size must be less than 5MB!";
        //             }
        //         }

        //         // Gallery Images Validation (if the gallery image input is used)
        //         if (galleryImages.length > 0) {
        //             let allowedGalleryTypes = ["image/jpeg", "image/png", "image/jpg"];
        //             let maxGallerySize = 5120; // 5MB

        //             for (let i = 0; i < galleryImages.length; i++) {
        //                 let galleryFile = galleryImages[i];
        //                 let galleryFileSize = galleryFile.size / 1024; // in KB

        //                 if (!allowedGalleryTypes.includes(galleryFile.type)) {
        //                     errors.galleryimages =
        //                         "Only JPG, JPEG, and PNG files are allowed in gallery images!";
        //                     break;
        //                 }
        //                 if (galleryFileSize > maxGallerySize) {
        //                     errors.galleryimages = "Gallery image size must be less than 5MB!";
        //                     break;
        //                 }
        //             }
        //         }

        //         // Show error messages if validation fails
        //         if (!$.isEmptyObject(errors)) {


        //             if (errors.status) {
        //                 $("input[name='status']").after(
        //                 `<span class="text-danger">${errors.status}</span>`);
        //             }
        //             if (errors.image) {
        //                 $("input[name='image']").after(`<span class="text-danger">${errors.image}</span>`);
        //             }
        //             if (errors.galleryimages) {
        //                 $("input[name='galleryimages[]']").after(
        //                     `<span class="text-danger">${errors.galleryimages}</span>`);
        //             }
        //             return false; // Stop form submission if errors exist
        //         }

        //         // Submit the form if no errors
        //         form.submit();
        //     });
        // });
        $(document).ready(function() {
            $("#submitBtn").on("click", function(e) {
                e.preventDefault();
                $(".text-danger").remove();

                let form = $("#offerBannerForm");
                let status = $("select[name='status']").val();
                let image = $("input[name='image']")[0].files[0];
                let galleryImages = $("input[name='galleryimages[]']")[0].files;

                let errors = {};

                if (!status) {
                    errors.status = "Status is required!";
                }

                if (image) {
                    let sizeKB = image.size / 1024;
                    let type = image.type;
                    if (!["image/jpeg", "image/png", "image/jpg"].includes(type)) {
                        errors.image = "Only JPG, JPEG, PNG allowed!";
                    } else if (sizeKB > 5120) {
                        errors.image = "Thumbnail must be under 5MB!";
                    }
                }

                if (status === "cart1" && galleryImages.length === 0) {
                    errors.gallery = "Gallery images are required for cart 1!";
                }
                if (status === "cart1" && galleryImages.length > 0) {
                    for (let img of galleryImages) {
                        if (!["image/jpeg", "image/png", "image/jpg"].includes(img.type)) {
                            errors.gallery = "Only JPG, JPEG, PNG allowed in gallery!";
                            break;
                        }
                        if (img.size / 1024 > 5120) {
                            errors.gallery = "Each gallery image must be under 5MB!";
                            break;
                        }
                    }
                }

                // Display Errors
                if (Object.keys(errors).length > 0) {
                    if (errors.status) {
                        $("select[name='status']").after(`<span class="text-danger">${errors.status}</span>`);
                    }
                    if (errors.image) {
                        $("input[name='image']").after(`<span class="text-danger">${errors.image}</span>`);
                    }
                    if (errors.gallery) {
                        $("input[name='galleryimages[]']").after(`<span class="text-danger">${errors.gallery}</span>`);
                    }
                    return;
                }

                form.submit();
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            // Handle the delete button click
            $(".delete-image").on("click", function(e) {
                e.preventDefault();

                var imageId = $(this).data("id"); // Get the image ID
                var imageDiv = $("#image-" + imageId); // Find the div to remove

                // Show confirmation prompt

                // Perform AJAX request to delete the image
                $.ajax({
                    url: '/offerbanner/delete-image/' + imageId, // The route for deleting the image
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        // Use the DELETE HTTP method
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function() {
                        alert("An error occurred. Please try again.");
                    }
                });

            });
        });
    </script>


@endsection
