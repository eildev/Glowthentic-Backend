@extends('backend.master')
@section('admin')

<div class="page-content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-top border-0 border-3 border-info">
                <form id="editBlogCategoryForm" action="{{ route('blog.category.update', $blogCatEdit->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-info">Edit Blog Category</h5>

                                <a href="{{ route('blog.all.category.view') }}" class="btn btn-info btn-sm text-light">
                                    <i class='bx bx-show'></i>
                                </a>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <label for="editCategoryInput" class="col-sm-3 col-form-label">Blog Category Name</label>
                                <div class="col-sm-9 form-group">
                                    <input type="text" name="CategoryName" class="form-control @error('CategoryName') is-invalid @enderror" id="editCategoryInput" placeholder="Enter Blog Category Name" value="{{ $blogCatEdit->cat_name }}">
                                    @error('CategoryName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger d-none" id="editNameError">Please enter a category name.</span>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-info px-5">Update blog Category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Frontend Validation Script -->
<script>
    document.getElementById('editBlogCategoryForm').addEventListener('submit', function(e) {
        const categoryInput = document.getElementById('editCategoryInput');
        const errorText = document.getElementById('editNameError');

        if (categoryInput.value.trim() === '') {
            e.preventDefault(); // prevent submission
            errorText.classList.remove('d-none');
            categoryInput.classList.add('is-invalid');
        } else {
            errorText.classList.add('d-none');
            categoryInput.classList.remove('is-invalid');
        }
    });
</script>

@endsection
