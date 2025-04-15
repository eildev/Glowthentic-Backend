@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-10 offset-md-1">

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Category</h5>

                        {{-- <a href="{{ route('category') }}" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a> --}}

                        <a href="#" class="btn btn-info btn-sm text-light get_parent_category " data-bs-toggle="modal"
                            data-bs-target="#categoryAddModal">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Category Name</th>
                                    <th>Parent Category Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="categoryShowTable">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>


    <div class="modal fade" id="categoryAddModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="AddCategoryForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <hr>
                                {{-- <input type="hidden" name="cat_id"> --}}
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="categoryName"
                                            class="form-control @error('categoryName') is-invalid  @enderror" id=""
                                            value="{{ old('categoryName') }}" placeholder="Enter Category Name">
                                        @error('categoryName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Parent Category
                                        Name</label>
                                    <div class="col-sm-9">
                                        <select id="" name="parent_id" class="form-select selectCategory">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                        @error('parent_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Category Thumbnail </label>
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
                                            <img id="showImage" class="" height="150" width="200"
                                                src="{{ asset('uploads/productempty.jpg') }}" alt="category image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_category">Save changes</button>
                </div>
            </div>
        </div>
    </div>








    <div class="modal fade" id="categoryEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="EditCategoryForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <hr>
                                <input type="hidden" name="cat_id" id="cat_id">
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="categoryName"
                                            class="form-control @error('categoryName') is-invalid  @enderror"
                                            id="category_name" value="{{ old('categoryName') }}"
                                            placeholder="Enter Category Name">
                                        @error('categoryName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Parent Category
                                        Name</label>
                                    <div class="col-sm-9">
                                        <select id="" name="parent_id" class="form-select selectCategory">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                        @error('parent_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Category Thumbnail </label>
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
                                            <img id="showImage" class="showImage" height="150" width="200"
                                                alt="category image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary Edit_category">Update</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).on('click', '.get_parent_category', function() {
            $.ajax({
                url: '/get/parent/category',
                type: "GET",
                success: function(response) {
                    let categories = response.categories;
                    let options = `<option selected disabled>Choose...</option>`;

                    // Loop through categories and create options
                    categories.forEach(category => {
                        options +=
                            `<option value="${category.id}">${category.categoryName}</option>`;
                    });

                    // Append options to the select box
                    $('.selectCategory').html(options);
                }
            });
        });





        function validateCategoryForm() {
    $(".error-message").remove();
    $("input, select").removeClass("is-invalid");

    let isValid = true;

    // Get form values
    let categoryName = $("input[name='categoryName']").val().trim();
    let imageInput = $("input[name='image']")[0].files[0];
    let parentId = $("select[name='parent_id']").val();

    // Validation rules
    if (categoryName === "") {
        $("input[name='categoryName']").addClass("is-invalid")
            .after('<span class="text-danger error-message">Category name is required</span>');
        isValid = false;
    }

    // Only validate image if parent_id is not selected (i.e., root category)
    if (!parentId) {
        if (!imageInput) {
            $("input[name='image']").addClass("is-invalid")
                .after('<span class="text-danger error-message">Image is required</span>');
            isValid = false;
        } else {
            let fileSize = imageInput.size / 1024;
            let fileType = imageInput.type;
            let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

            if (!allowedTypes.includes(fileType)) {
                $("input[name='image']").addClass("is-invalid")
                    .after('<span class="text-danger error-message">Only JPG, JPEG, and PNG files are allowed!</span>');
                isValid = false;
            } else if (fileSize > 2048) {
                $("input[name='image']").addClass("is-invalid")
                    .after('<span class="text-danger error-message">Image size must be less than 2MB!</span>');
                isValid = false;
            }
        }
    }

    return isValid;
}



        //Add Category
        $(document).on('click', '.save_category', function(e) {
            e.preventDefault();


            if (!validateCategoryForm()) return;


            let formData = new FormData($('#AddCategoryForm')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.error-message').remove();
            $.ajax({
                url: '/category/store',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        $('#AddCategoryForm')[0].reset();
                        // $('#showImage')[0].reset();
                        $('#categoryAddModal').modal('hide');
                        $('#showImage').attr('src', "{{ asset('uploads/productempty.jpg') }}");
                        toastr.success('Category Added Successfully');

                        dataShow();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            let inputField = $('[name="' + key + '"]');
                            inputField.after('<span class="text-danger error-message">' + value[
                                0] + '</span>');
                        });
                    } else {
                        alert("Something went wrong!");
                    }
                }
            });
        });





////////edit form validation

function validateCategoryEditForm() {
    // Clear any previous error messages
    $(".error-message").remove();
    $("input, select").removeClass("is-invalid");

    let isValid = true;

    // Get form values
    let categoryName = document.getElementById("category_name").value;
    let imageInput = $("input[name='image']")[0].files[0];


    if (categoryName === "") {
        $("input[name='categoryName']").addClass("is-invalid")
            .after('<span class="text-danger error-message">Category name is required</span>');
        isValid = false;
    }


     if (imageInput) {
        let fileSize = imageInput.size / 1024; // Convert size to KB
        let fileType = imageInput.type;
        let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

        // Check for allowed file types
        if (!allowedTypes.includes(fileType)) {
            $("#image").addClass("is-invalid")
                .after('<span class="text-danger error-message">Only JPG, JPEG, and PNG files are allowed!</span>');
            isValid = false;
        } else if (fileSize > 2048) {  // Check for file size (2MB)
            $("#image").addClass("is-invalid")
                .after('<span class="text-danger error-message">Image size must be less than 2MB!</span>');
            isValid = false;
        }
    }

    return isValid; // Return true if valid, false otherwise
}




        //edit category
        $(document).on('click', '.Edit_category', function() {



if (!validateCategoryEditForm()) return;

        let formData = new FormData($('#EditCategoryForm')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.error-message').remove();
        $.ajax({
            url: '/category/update',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $('#EditCategoryForm')[0].reset();
                $('#categoryEditModal').modal('hide');
                toastr.success('Category Updated Succesfully');

                dataShow();
            },

            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(key, value) {
                        let inputField = $('[name="' + key + '"]');
                        inputField.after('<span class="text-danger error-message">' + value[
                            0] + '</span>');
                    });
                } else {
                    alert("Something went wrong!");
                }
            }

        });

    });











        //delete category
        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/category/delete',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    toastr.success('Category Deleted Succesfully');
                    dataShow();
                },
            });
        });

        //change status
        $(document).on('click', '.change_status', function() {
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/category/status/change',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    toastr.success('Category Status Changed Succesfully');
                    dataShow();
                },
            });
        });


        // All Data Show
        function dataShow() {
            $.ajax({
                url: '/category/view',
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    if (data.status == 200) {
                        let categories = data.categories;
                        $('#categoryShowTable').empty();
                        categories.forEach(function(category, i) {
                            $('#categoryShowTable').append(`
                                    <tr>
                                        <td>${i+1}</td>
                                        <td>${category?.categoryName ?? "N/A" }</td>
                                        <td>${category?.parent_category?.categoryName ?? "N/A"}</td>
                                        <td>
                                            <img src="${category?.image}" alt="Combo Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">

                                            </td>

                                            <td>
                                                <button class="btn btn-sm ${category.status == 1 ? 'btn-success' : 'btn-danger'} status_toggle change_status"
                                                    data-id="${category.id}"

                                                    data-status="${category.status}">

                                                ${category.status == 1 ? 'Active' : 'Inactive'}
                                            </button>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="dropdown-item edit "  data-id="${category.id}" data-bs-toggle="modal"
                                                    data-bs-target="#categoryEditModal">Edit</a></li>
                                                        <li><a href="#" class="dropdown-item delete" data-id="${category.id}">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                    </tr>

                                    `)
                        });
                    }
                }
            })
        }


        //  Edit Category Show
        $(document).on('click', '.edit', function() {
            let cat_id = $(this).data("id");

            $.ajax({

                url: '/category/edit/' + cat_id,
                type: 'GET',
                success: function(data) {

                    if (data.status == 200) {
                        let category = data.category;
                        let categories = data.categories;

                        $("#cat_id").val(category.id);
                        $("#category_name").val(category.categoryName);
                        $(".showImage").attr("src", `${category.image}`);

                        let options = `<option selected disabled>Choose...</option>`;

                        // Loop through categories and create options
                        categories.forEach(cat => {
                            let selected = category.parent_id == cat.id ? "selected" : "";
                            options +=
                                `<option value="${cat.id}" ${selected}>${cat.categoryName}</option>`;
                        });

                        // Append options to the select box
                        $('.selectCategory').html(options);
                    }

                },

            });
            // Reset modal data on close
        });



        dataShow();
    </script>
@endsection
