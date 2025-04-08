@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 border-info col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Combos</h5>

                        <a href="#" class="btn btn-info btn-sm text-light " data-bs-toggle="modal"
                            data-bs-target="#comboAddModal">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Combo Name</th>
                                    <th>Combo Price</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="showTableData">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="comboAddModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Combo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="comboAddForm" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">Combo Name</label>
                            <input type="text" class="form-control" id="inputFirstName" name="combo_name">
                        </div>
                        <div class="col-md-6">
                            <label for="inputLastName" class="form-label">Combo Price</label>
                            <input type="number" class="form-control" id="inputLastName" name="combo_price">
                        </div>
                        <div class="col-md-6">
                            <label for="imageInput" class="form-label">Image</label>
                            <input type="file" class="form-control" id="imageInput" name="image[]" multiple>
                            <small id="imageCount" class="text-danger ">No images selected</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_combo">Save changes</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="comboUpdateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Combo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="comboUpdateForm" enctype="multipart/form-data">
                        <input type="hidden" id="combo_id" name="combo_id">
                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">Combo Name</label>
                            <input type="text" class="form-control" id="combo_name" name="combo_name">
                        </div>
                        <div class="col-md-6">
                            <label for="inputLastName" class="form-label">Combo Price</label>
                            <input type="number" class="form-control" id="combo_price" name="combo_price">
                        </div>
                        <div class="col-md-6">
                            <label for="imageInput" class="form-label">Image</label>
                            <input type="file" class="form-control" id="imageInputedit" name="image[]" multiple>
                            <small id="imageCountedit" class="text-danger ">No images selected</small>
                        </div>

                        <div class="img-show d-flex flex-wrap gap-2"></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_combo">Update changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{ asset('backend/main-js/combo.js') }}"></script> --}}

    <script>



         ///////////////////////validation//////////////////////



function validateForm() {
    $(".error-message").remove(); // Remove previous error messages
    $("input, select").removeClass("is-invalid"); // Remove previous invalid class

    let isValid = true;

    let ComboName = $("input[name='combo_name']").val().trim();
    let ComboPrice = $("input[name='combo_price']").val().trim();
    let imageCount = $("input[name='image[]']").get(0).files.length; // Get selected files
    let galleryImages = $("input[name='image[]']").get(0).files; // Get image files for size validation

    if (ComboName === "") {
        $("input[name='combo_name']").addClass("is-invalid")
            .after('<span class="text-danger error-message">Combo name is required</span>');
        isValid = false;
    }

    if (ComboPrice === "") {
        $("input[name='combo_price']").addClass("is-invalid")
            .after('<span class="text-danger error-message">Combo Price is required</span>');
        isValid = false;
    }

    if (imageCount === 0) { // Check if any image is selected
        $("input[name='image[]']").addClass("is-invalid")
            .after('<span class="text-danger error-message">Please select at least one image</span>');
        isValid = false;
    } else {
        let maxImageSize = 2 * 1024 * 1024; // 2MB in bytes

        // Validate each image file's size
        for (let i = 0; i < galleryImages.length; i++) {
            let imageFile = galleryImages[i];

            if (imageFile.size > maxImageSize) {
                $("input[name='image[]']").addClass("is-invalid")
                    .after('<span class="text-danger error-message">Each image must be less than 2MB</span>');
                isValid = false;
                break; // No need to check further images if one exceeds the size limit
            }
        }
    }

    return isValid;
}










        $(document).on('click', '.save_combo', function() {


            if (!validateForm()) return;
            let formData = new FormData($('#comboAddForm')[0]);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/combo/store',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#comboAddForm')[0].reset();
                    $('#comboAddModal').modal('hide');
                    toastr.success('Combo Added Successfully');
                    showData();
                },
            });
        });


        document.getElementById("imageInput").addEventListener("change", function() {
            let count = this.files.length; // Get number of selected files
            let imageCountText = count > 0 ? `${count} images selected` : "No images selected";
            document.getElementById("imageCount").textContent = imageCountText;
        });

        document.getElementById("imageInputedit").addEventListener("change", function() {
            let count = this.files.length; // Get number of selected files
            let imageCountText = count > 0 ? `${count} images selected` : "No images selected";
            document.getElementById("imageCountedit").textContent = imageCountText;
        });









        function validateEditForm() {
    $(".error-message").remove();
    $("input, select").removeClass("is-invalid"); 

    let isValid = true;

    // Retrieve modal field values
    let ComboName = $("#combo_name").val().trim();
    let ComboPrice = $("#combo_price").val().trim();
    let imageCount = $("#imageInputedit")[0].files.length;
    let galleryImages = $("#imageInputedit")[0].files;

    if (ComboName === "") {
        $("#combo_name").addClass("is-invalid")
            .after('<span class="text-danger error-message">Combo name is required</span>');
        isValid = false;
    }

    if (ComboPrice === "") {
        $("#combo_price").addClass("is-invalid")
            .after('<span class="text-danger error-message">Combo Price is required</span>');
        isValid = false;
    }

    if (imageCount === 0) { // Check if any image is selected
        $("#imageInputedit").addClass("is-invalid")
            .after('<span class="text-danger error-message">Please select at least one image</span>');
        isValid = false;
    } else {
        let maxImageSize = 2 * 1024 * 1024; // 2MB in bytes

        // Validate each image file's size
        for (let i = 0; i < galleryImages.length; i++) {
            let imageFile = galleryImages[i];

            if (imageFile.size > maxImageSize) {
                $("#imageInputedit").addClass("is-invalid")
                    .after('<span class="text-danger error-message">Each image must be less than 2MB</span>');
                isValid = false;
                break; // No need to check further images if one exceeds the size limit
            }
        }
    }

    return isValid;
}













        // update combo
        $(document).on('click', '.update_combo', function () {

            if (!validateEditForm()) return;

            // if (!validateForm()) return;
                let formData= new FormData($('#comboUpdateForm')[0])

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/combo/update',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log('Success:', data);
                        $('#comboUpdateForm')[0].reset();
                        $('#comboUpdateModal').modal('hide');
                        toastr.success('Combo updated successfully');
                        showData();
                    },
                    error: function (xhr, status, error) {
                        console.log('AJAX Error:', error);
                    }
                });
            });



        // Deleted Combo
          $(document).on('click','.delete',function(){

            let id = $(this).data("id");
            console.log(id);
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

             $.ajax({
                url:'/combo/delete',
                type:'POST',
                data:{
                    id:id
                },
                success:function(data){

                    console.log(data);
                   toastr.success("Combo Delete Successfully");
                    showData();
                },
             });

          });

        // change Status
         $(document).on('click','.status_inactive',function(){

            let status_id=$(this).data("id");
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
               url:'/combo/status/change',
               type:'post',
               data:{
                status_id:status_id
               },
               success:function(data){

                   console.log(data);
                   toastr.success("Combo Status Change Successfully");
                    showData();

               }

            });

         });

          // show all data
        function showData() {
            // alert('ok');
            $.ajax({
                url: '/combo/view',
                type: 'GET',
                success: function(data) {
                    if (data.status == 200) {

                        const combos = data.combos;
                        // Clear existing table rows if needed
                        $('#showTableData').empty();

                        // Loop through the combos array and append each item
                        combos.forEach(function(combo) {
                            $('#showTableData').append(`
                            <tr>
                                <td>${combo.id}</td>
                                <td>${combo.name ?? ""}</td>
                                <td>${combo.offerd_price}</td>

                                <td>
                                    <button class="btn btn-sm btn-danger status_inactive" value="${combo.status}" data-id="${combo.id}">${combo.status}</button>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="dropdown-item edit"  data-id="${combo.id}" data-bs-toggle="modal"
                                        data-bs-target="#comboUpdateModal">Edit</a></li>
                                            <li><a href="#" class="dropdown-item delete" data-id="${combo.id}">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                `);
                        });

                    }
                },
            });
        }

        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            // alert('Ok');
            let id = $(this).attr('data-id');
            $.ajax({
                url: '/combo/view/' + id,
                type: 'GET',
                success: function(data) {
                    if (data.status == 200) {
                        let combo = data.combo;
                        let comboImages = data.combo_image;
                        //  console.log(comboImages);
                        $("#combo_id").val(combo.id??'');
                        $("#combo_name").val(combo.name ?? '');
                        $("#combo_price").val(combo.offerd_price ?? '');
                        $(".img-show").empty();


                            comboImages.forEach(image => {
                                $(".img-show").append(`
                                    <div class="image-item position-relative" data-image-id="${image.id}">
                                        <img src="${image.image}" class="img-thumbnail" width="100" height="100">
                                        <a class="btn btn-danger btn-sm delete-image" style="position:absolute; top:0; right:0;">X</a>
                                    </div>
                                `);
                            });

                    }
                }
            });
        });



            $(document).on('click', '.delete-image', function () {
                let imageDiv = $(this).closest('.image-item');

                let imageId = imageDiv.data('image-id');

                $.ajax({
                    url: '/combo/delete-image/',
                    type: 'POST',
                    data: {
                        image_id: imageId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status == 200) {
                            imageDiv.remove();
                        } else {
                            alert('Error deleting image.');
                        }
                    }
                });
            });

        showData();
    </script>
@endsection
