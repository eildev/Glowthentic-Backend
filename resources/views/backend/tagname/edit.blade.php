@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('tagname.update', $tagname->id) }}" method="POST" enctype="multipart/form-data"
                        id="tagForm">
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
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5" id="submitBtn">Update
                                            Tag</button>
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
                let tagname = $("input[name='tagname']").val().trim();


                $(".text-danger").text("");

                let errors = {};


                if (tagname === "") {
                    errors.tagname = "Tag name is required!";
                }


                if (!$.isEmptyObject(errors)) {
                    if (errors.tagname) {
                        $("input[name='tagname']").after(
                            `<span class="text-danger">${errors.tagname}</span>`);
                    }
                    return false;
                }


                form.submit();
            });
        });
    </script>
@endsection
