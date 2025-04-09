@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('tagname.update', $tagname->id) }}" method="POST" enctype="multipart/form-data" id="tagForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-info">Update Tagname</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Tagname Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tagname"
                                            class="form-control @error('tagname') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Category Name"
                                            value="{{ $tagname->tagName }}">
                                            @error('tagname')
                                            <span class="text-danger">{{ $message }}</span>
                                           @enderror
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Tag Thumbnail </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image"
                                            class="form-control  @error('image') is-invalid  @enderror" name="image">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 300 X 180 size
                                                image
                                            </i>
                                        </div>

                                        <div>
                                            <img src="{{ asset($tagname->image) }}" alt="" height="100" width="100">
                                        </div>
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                        <div class="mt-3">
                                            <img id="showImage" class="showImage" height="150" width="200"
                                                 alt="Tag image">
                                        </div>
                                    </div>

                                </div>




                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5" id="submitBtn">Update Category</button>
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

                let form = $("#tagForm");
                let tagname = $("input[name='tagname']").val().trim();
                let imageInput = $("input[name='image']")[0].files[0];


                $(".text-danger").text("");

                let errors = {};


                if (tagname === "") {
                    errors.tagname = "Tag name is required!";
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
                    if (errors.tagname) {
                        $("input[name='tagname']").after(`<span class="text-danger">${errors.tagname}</span>`);
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
