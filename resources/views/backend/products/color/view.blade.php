@extends('backend.master')
@section('admin')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 text-info fw-semibold">Manage Color</h5>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addColorModal">
                            <i class="bi bi-plus-lg"></i> Add Color
                        </button>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-bordered text-center">
                            <thead class="table-info">
                                <tr>
                                    <th>SI</th>
                                    <th>Color Name</th>
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

<!-- Modal for Adding New Color -->
<div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="addcolorform">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Add New Color</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <label for="new-color" class="form-label">Color Name</label>
                  <input type="text" name="color_name"id="new-color" class="form-control" placeholder="e.g., Peach, Sky Blue">
              </div>
              <div class="modal-footer">
                  <a  class="btn btn-primary addColor">Add Color</a>
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
                    <h5 class="modal-title" id="addSizeModalLabel">Edit Color</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id" name="id" class="form-control" hidden>
                    <label for="new-size" class="form-label">color Name</label>
                    <input type="text" id="size" name="color_name" class="form-control" placeholder="e.g., 3XL, 2kg, etc.">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary updateColor">Update</a>
                </div>
            </div>
        </form>
    </div>
</div>






<!-- JavaScript -->
<script>
 //////////////////////////////////////// colorSave ////////////////////////
 $(document).on('click', '.addColor', function () {

let color = $('input[name="color_name"]').val();
$('input[name="color_name"]').next('.text-danger').remove();
if (color == '') {
    $('input[name="color_name"]').after('<span class="text-danger">Color Name is required</span>');
    return;
}
let formdata = new FormData($('#addcolorform')[0]);
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

$.ajax({
    url: "{{ route('admin.products.addColor') }}",
    type: "POST",
    data: formdata,
    contentType: false,
    processData: false,
    success: function (response) {
        if (response.status == 200) {
            $('#addcolorform')[0].reset();
            $('#addColorModal').modal('hide');
            toastr.success("Color Added Successfully");
            getColor();
        } else {
            toastr.error("Something Went Wrong");
        }
    },
});
});



function getColor() {
    $.ajax({
        url: "{{ route('admin.products.getColor') }}",
        type: "GET",
        success: function(response) {
            if (response.status == 200) {
                let color = response.color;
                $('.data').empty();

                color.forEach(function (color, index) {
                    $('.data').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${color.color_name}</td>
                            <td>


                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-info editcolor" data-bs-toggle="modal" data-bs-target="#addEditModal" data-id="${color.id}" data-color="${color.color_name}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger deletecolor" data-id="${color.id}">
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










$(document).on('click','.deletecolor',function(){
  let id=$(this).data('id');
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });
  $.ajax({
    url:"{{ route('admin.products.deleteColor') }}",
    type:"POST",
    data:{id:id},
    success:function(response){
        if(response.status==200){
            toastr.success("Size Deleted Successfully");
            getColor();
        }
        else{

            toastr.error("Something Went Wrong");
        }
    }
  })
});


$(document).on('click','.editcolor',function(){


    let id=$(this).data('id');
    let color=$(this).data('color');
    $('#id').val(id);
    $('#size').val(color);

});


$(document).on('click', '.updateColor', function() {


    let formdata = new FormData($('#Editsizeform')[0]);
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
        url: "{{ route('admin.products.updateColor') }}",
        type: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.status == 200) {
                toastr.success("Size Updated Successfully");
                $('#addEditModal').modal('hide');
                $('#Editsizeform')[0].reset();
                getColor();
            } else {
                toastr.error("Something Went Wrong");
            }
        }
    });
});

getColor();
</script>
@endsection
