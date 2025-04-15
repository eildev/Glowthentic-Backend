@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ route('offerbanner.store') }}" method="POST" enctype="multipart/form-data" id="offerBannerForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Add Offer Banner</h5>
                                    <a href="{{ route('offerbanner.view') }}" class="btn btn-info btn-sm text-light">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>
                                <hr>

                                {{-- Banner Head --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Banner Head</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="heading" class="form-control" placeholder="Enter Banner Heading">
                                    </div>
                                </div>

                                {{-- Banner Title --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Banner Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="form-control" placeholder="Enter Banner Title">
                                    </div>
                                </div>

                                {{-- Short Description --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Short Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="short_description" style="resize: none; height: 100px;"></textarea>
                                    </div>
                                </div>

                                {{-- Link Button --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Link Button Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="link_button" class="form-control" placeholder="Enter Button Text">
                                    </div>
                                </div>

                                {{-- Banner Link --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Banner Link</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="link" class="form-control" placeholder="Enter Banner Link">
                                    </div>
                                </div>

                                {{-- Cart Status --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Cart Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-select selectstatus">
                                            <option value="">Choose...</option>
                                            <option value="cart1">CART 1</option>
                                            <option value="cart2">CART 2</option>
                                            <option value="cart3">CART 3</option>
                                            <option value="cart4">CART 4</option>
                                            <option value="cart5">CART 5</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Gallery Images --}}
                                <div class="row mb-3 galleryimage" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Gallery Images</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="galleryimages[]" multiple>
                                        <small class="">
                                            Note: Please provide 142x83 image for cart 1. It’s not applicable for others.
                                        </small>
                                    </div>
                                </div>

                                {{-- Thumbnail Image --}}
                                <div class="row mb-3" id="thumbnailimage">
                                    <label class="col-sm-3 col-form-label">Banner Thumbnail</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="image">
                                        <small>
                                            <b>Note:</b> Please provide 1310x220 size image
                                        </small>
                                        <div class="mt-3">
                                            <img id="showImage" height="150" width="200"
                                                src="{{ asset('uploads/productempty.jpg') }}" alt="Preview">
                                        </div>
                                    </div>
                                </div>

                                {{-- Submit --}}
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
    </div>

    {{-- Show/hide gallery --}}
    <script>
        $(document).ready(function() {
            $('.galleryimage').hide();
            $('.selectstatus').on('change', function() {
                if ($(this).val() === 'cart1') {
                    $('.galleryimage').slideDown();
                    $('#thumbnailimage').fadeOut();
                } else {

                    $('.galleryimage').slideUp();
                    $('#thumbnailimage').fadeIn();

                }
            });
        });
    </script>

    {{-- Validation Script --}}
    <script>
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
@endsection
