@extends('backend.master')
@section('admin')

<div class="page-content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-top border-0 border-3 border-info">
                <form id="blogCategoryForm" action="{{ route('blog.category.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-info">Add Blog Category</h5>
                                <a href="{{ route('blog.all.category.view') }}" class="btn btn-info btn-sm text-light">
                                    <i class='bx bx-show'></i>
                                </a>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Blog Category Name</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" name="CategoryName" class="form-control @error('CategoryName') is-invalid @enderror" id="CategoryName" placeholder="Enter Blog Category Name">
                                    @error('CategoryName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger d-none" id="nameError">Please enter a category name.</span>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-info px-5">Add blog Category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Frontend validation script -->
<script>
    document.getElementById('blogCategoryForm').addEventListener('submit', function(e) {
        const categoryName = document.getElementById('CategoryName');
        const errorText = document.getElementById('nameError');

        if (categoryName.value.trim() === '') {
            e.preventDefault(); // stop form from submitting
            errorText.classList.remove('d-none');
            categoryName.classList.add('is-invalid');
        } else {
            errorText.classList.add('d-none');
            categoryName.classList.remove('is-invalid');
        }
    });
</script>

@endsection
