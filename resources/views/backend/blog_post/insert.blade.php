@extends('backend.master')
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-top border-0 border-3 border-info">
                <form id="blogForm" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="border p-4 rounded">

                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-info">Add Blog Post</h5>
                                <a href="{{ route('blog.all.post.view') }}" class="btn btn-info btn-sm text-light">
                                    <i class='bx bx-show'></i>
                                </a>
                            </div>

                            <hr>

                            {{-- Category --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Select Category</label>
                                <div class="col-sm-9">
                                    <select name="category" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach ($category as $Cat)
                                            <option value="{{ $Cat->id }}">{{ $Cat->cat_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select a category.</div>
                                </div>
                            </div>

                            {{-- Title --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Blog Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" required maxlength="200"
                                        value="{{ old('title') }}" placeholder="Enter Blog Title">
                                    <div class="invalid-feedback">Please enter a blog title (max 200 characters).</div>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control" required minlength="10"
                                        style="resize: none; height: 150px;">{{ old('description') }}</textarea>
                                    <div class="invalid-feedback">Please provide a description (at least 10 characters).</div>
                                </div>
                            </div>

                            {{-- Tags --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tags</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tags" class="form-control" required
                                        placeholder="Add tags">
                                    <div class="invalid-feedback">Please add at least one tag.</div>
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Post Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" id="image" class="form-control" required
                                        accept="image/jpeg,image/png,image/webp">
                                    <div class="form-text">
                                        <b>Note:</b> Please upload a 1410x882 image (JPEG/PNG/WEBP, max 2MB).
                                    </div>
                                    <div class="invalid-feedback">Please upload a valid image (JPEG/PNG/WEBP, max 2MB).</div>

                                    <div class="mt-3">
                                        <img id="showImage" src="{{ asset('uploads/productempty.jpg') }}" width="200" height="150" alt="Preview">
                                    </div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-info text-white">Add Blog</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Frontend Validation + Preview --}}
<script>
    // Live Image Preview
    document.getElementById("image").addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const fileSizeMB = file.size / 1024 / 1024;
            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

            if (!allowedTypes.includes(file.type) || fileSizeMB > 2) {
                this.setCustomValidity("Invalid image. Max 2MB. JPEG, PNG, or WEBP only.");
            } else {
                this.setCustomValidity("");
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById("showImage").src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    });

    // Bootstrap-like validation
    document.getElementById("blogForm").addEventListener("submit", function (e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }

        this.classList.add("was-validated");
    });
</script>
@endsection
