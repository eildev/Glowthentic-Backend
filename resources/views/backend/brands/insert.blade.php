@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('brand.store') }}" method="POST" enctype="multipart/form-data" id="brandForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Add Brand</h5>

                                    <a href="{{ route('brand.view') }}" class="btn btn-info btn-sm text-light ">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Brand Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="BrandName"
                                            class="form-control @error('BrandName') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Brand Name">
                                        @error('BrandName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Brand Thumbnail </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image"
                                            class="form-control @error('image') is-invalid  @enderror" name="image">
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
                                                src="{{ asset('uploads/productempty.jpg') }}" alt="category image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <a href="" class="btn btn-info px-5" id="submitBtn">Add Brand</a>
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

                let form = $("#brandForm");
                let BrandName = $("input[name='BrandName']").val().trim();

                let imageInput = $("input[name='image']")[0].files[0];


                $(".text-danger").text("");

                let errors = {};


                if (BrandName === "") {
                    errors.BrandName = "Brand Name name is required!";
                }


                if (!imageInput) {
                    errors.image = "Brand  thumbnail is required!";
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
                    if (errors.BrandName) {
                        $("input[name='BrandName']").after(`<span class="text-danger">${errors.BrandName}</span>`);
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
