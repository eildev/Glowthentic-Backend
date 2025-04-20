@extends('backend.master')
@section('admin')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 text-info fw-semibold">Manage Sizes</h5>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSizeModal">
                            <i class="bi bi-plus-lg"></i> Add Size
                        </button>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-bordered text-center">
                            <thead class="table-info">
                                <tr>
                                    <th>SI</th>
                                    <th>Size Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="data">
                                <!-- Data will be loaded via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Size Modal -->
<div class="modal fade" id="addSizeModal" tabindex="-1" aria-labelledby="addSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addsizeform">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="addSizeModalLabel">Add New Size</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="new-size" class="form-label">Size Name</label>
                    <input type="text" id="new-size" name="size_name" class="form-control" placeholder="e.g., 3XL, 2kg, etc.">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary addSize">Add Size</a>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- Size Modal -->
<div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="addSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="Editsizeform">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="addSizeModalLabel">Edit Size</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id" name="id" class="form-control" hidden>
                    <label for="new-size" class="form-label">Size Name</label>
                    <input type="text" id="size" name="size_name" class="form-control" placeholder="e.g., 3XL, 2kg, etc.">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary updateSize">Update</a>
                </div>
            </div>
        </form>
    </div>
</div>







<!-- JavaScript -->
<script>
$(document).on('click', '.addSize', function () {
    let size = $('input[name="size_name"]').val();
    $('input[name="size_name"]').next('.text-danger').remove();

    if (size == '') {
        $('input[name="size_name"]').after('<span class="text-danger">Size Name is required</span>');
        return;
    }

    let formdata = new FormData($('#addsizeform')[0]);
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
        url: "{{ route('admin.products.addSize') }}",
        type: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                $('#addsizeform')[0].reset();
                $('#addSizeModal').modal('hide');
                toastr.success("Size Added Successfully");
                getSize();
            } else {
                toastr.error("Something Went Wrong");
            }
        },
    });
});

function getSize() {
    $.ajax({
        url: "{{ route('admin.products.getSize') }}",
        type: "GET",
        success: function (response) {
            if (response.status == 200) {
                let p_size = response.size;
                $('.data').empty();

                p_size.forEach(function (size, index) {
                    $('.data').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${size.size_name}</td>
                            <td>


                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-info editSize" data-bs-toggle="modal" data-bs-target="#addEditModal" data-id="${size.id}" data-size="${size.size_name}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger deleteSize" data-id="${size.id}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    `);
                });
            }
        }
    });
}

$(document).on('click','.deleteSize',function(){
  let id=$(this).data('id');
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });
  $.ajax({
    url:"{{ route('admin.products.deleteSize') }}",
    type:"POST",
    data:{id:id},
    success:function(response){
        if(response.status==200){
            toastr.success("Size Deleted Successfully");
            getSize();
        }
        else{

            toastr.error("Something Went Wrong");
        }
    }
  })
});


$(document).on('click','.editSize',function(){

    let id=$(this).data('id');
    let size=$(this).data('size');
    $('#id').val(id);
    $('#size').val(size);

});


$(document).on('click', '.updateSize', function() {


    let formdata = new FormData($('#Editsizeform')[0]);
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
        url: "{{ route('admin.products.updateSize') }}",
        type: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.status == 200) {
                toastr.success("Size Updated Successfully");
                $('#addEditModal').modal('hide');
                $('#Editsizeform')[0].reset();
                getSize();
            } else {
                toastr.error("Something Went Wrong");
            }
        }
    });
});

getSize();
</script>
@endsection
