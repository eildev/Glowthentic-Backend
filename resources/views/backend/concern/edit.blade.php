@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('concern.update', $concern->id) }}" method="POST" enctype="multipart/form-data"
                        id="tagForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-info">Update Concern</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Concern Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Concern name Name"
                                            value="{{ $concern->name ?? '' }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Concern Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image"
                                            class="form-control  @error('image') is-invalid  @enderror" name="image">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 300 X 180 size
                                                image
                                            </i>
                                        </div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-3">
                                            <img src="{{ $concern->image ? $concern->image : '/uploads/productempty.jpg' }}"
                                                id="showImage" class="showImage" height="150" alt="Tag image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5" id="submitBtn">Update
                                            Concern</button>
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
                    errors.name = "Concern is required!";
                }


                // if (!imageInput) {
                //     errors.image = "Tag thumbnail is required!";
                // }

                if (imageInput) {
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
