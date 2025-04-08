@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('feature.update', $brand->id) }}" method="POST" enctype="multipart/form-data" id="featureForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-info">Update Feature</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Brand Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="feature_name"
                                            class="form-control  @error('feature_name') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Brand Name"
                                            value="{{ $brand->feature_name }}">
                                        @error('feature_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Brand Thumbnail </label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control @error('image') is-invalid  @enderror"
                                            id="image" name="image" value="{{ $brand->image }}">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 200 X 200 size
                                                image
                                            </i>
                                        </div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-3">
                                            <img id="showImage" class="" height="150" width="200"
                                                src="{{ asset($brand->image) }}" alt="Brand image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <a class="btn btn-info px-5" id="submitBtn">Update Brand</a>
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

                let form = $("#featureForm");
                let feature_name = $("input[name='feature_name']").val().trim(); // Fix the variable name

                let imageInput = $("input[name='image']")[0].files[0];

                $(".text-danger").text(""); // Clear existing error messages

                let errors = {}; // Initialize the errors object

                // Validate feature name
                if (feature_name === "") {
                    errors.feature_name = "Feature Name is required!";
                }

                // Validate image input
                // if (!imageInput) {
                //     errors.image = "Feature thumbnail is required!";
                // } else {

                if (imageInput) {
                    let fileSize = imageInput.size / 1024; // Convert to KB
                    let fileType = imageInput.type;

                    let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

                    if (!allowedTypes.includes(fileType)) {
                        errors.image = "Only JPG, JPEG, and PNG files are allowed!";
                    } else if (fileSize > 2048) { // 2MB
                        errors.image = "Image size must be less than 2MB!";
                    }
                }

                // Check if any validation errors exist
                if (!$.isEmptyObject(errors)) {
                    // Display errors if any
                    if (errors.feature_name) {
                        $("input[name='feature_name']").after(`<span class="text-danger">${errors.feature_name}</span>`);
                    }
                    if (errors.image) {
                        $("input[name='image']").after(`<span class="text-danger">${errors.image}</span>`);
                    }
                    return false; // Prevent form submission if there are errors
                }

                form.submit(); // Submit the form if no errors
            });
        });
    </script>
@endsection
