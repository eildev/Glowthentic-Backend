@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('blog.post.update', $blogPost->id) }}" method="POST" enctype="multipart/form-data" id="blogPostForm">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">

                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Edit Blog Post</h5>
                                    <a href="{{ route('blog.all.post.view') }}" class="btn btn-info btn-sm text-light">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>

                                <hr>

                                {{-- Category --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Select Category Name</label>
                                    <div class="col-sm-9 form-group text-secondary">
                                        <select class="form-select @error('category') is-invalid @enderror" name="category" id="category">
                                            <option value="">Select Category</option>
                                            @foreach ($cate as $Category)
                                                <option value="{{ $Category->id }}" {{ $Category->id == $blogPost->cat_id ? 'selected' : '' }}>
                                                    {{ $Category->cat_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Title --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Blog Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ $blogPost->title }}"
                                            placeholder="Enter Blog Title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  name="description"
                                                  style="resize: none; height: 150px;"
                                                  id="product_descriptions">{{ $blogPost->desc }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Tags --}}
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Enter Tag Name</label>
                                    <div class="col-sm-9">
                                        <div class="mb-3">
                                            <label class="form-label">Tags</label>
                                            <input type="text" class="form-control" data-role="tagsinput"
                                                   name="tags" value="{{ $blogPost->tags }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- Image (optional) --}}
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Post Image <small class="text-muted">(optional)</small></label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image" name="image"
                                               class="form-control @error('image') is-invalid @enderror">
                                        <div class="my-1">
                                            <i><b>Note:</b> Please provide 1410 × 882 size image</i>
                                        </div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-3">
                                            <img id="showImage" height="150" width="200"
                                                 src="{{ asset($blogPost->image) }}" alt="post image">
                                        </div>
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5 text-white">Update Blog</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Frontend Validation Script --}}
    <script>
        document.getElementById('blogPostForm').addEventListener('submit', function(e) {
            // Clear previous error messages
            let errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(msg => msg.remove());

            let isValid = true;

            // Validate Category
            const category = document.getElementById('category');
            if (category.value === "") {
                isValid = false;
                displayError(category, 'Category is required!');
            }

            // Validate Title
            const title = document.getElementById('title');
            if (title.value.trim() === "") {
                isValid = false;
                displayError(title, 'Blog Title is required!');
            }

            // Validate Description
            const description = document.getElementById('product_descriptions');
            if (description.value.trim() === "") {
                isValid = false;
                displayError(description, 'Description is required!');
            }

            // If invalid, prevent form submission
            if (!isValid) {
                e.preventDefault();
            }
        });

        // Helper function to display error messages
        function displayError(element, message) {
            let errorMessage = document.createElement('span');
            errorMessage.classList.add('text-danger', 'error-message');
            errorMessage.innerText = message;
            element.parentElement.appendChild(errorMessage);
        }
    </script>
@endsection
