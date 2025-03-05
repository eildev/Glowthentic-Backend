@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('blog.post.update', $blogPost->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">

                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Edit Blog post</h5>

                                    <a href="{{ route('blog.all.post.view') }}" class="btn btn-info btn-sm text-light ">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Select Category
                                        Name</label>
                                    <div class="col-sm-9 form-group text-secondary">
                                        <select class="form-select @error('category') is-invalid  @enderror"
                                            name ="category" aria-label="Default select example">
                                            <option selected="" value=""> Select Category</option>
                                            @foreach ($cate as $Category)
                                                <option
                                                    value="{{ $Category->id }}"{{ $Category->id == $blogPost->cat_id ? 'selected' : '' }}>
                                                    {{ $Category->cat_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Blog Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid  @enderror"
                                            id="inputEnterYourName" value="{{ $blogPost->title }}"
                                            placeholder="Enter Blog Title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('description') is-invalid  @enderror" name="description" placeholder=""
                                            style="resize: none; height: 150px;" id="product_descriptions">{{ $blogPost->desc }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Enter Tag Name</label>
                                    <div class="col-sm-9">
                                        <div class="mb-3">
                                            <label class="form-label">Tags</label>
                                            <input type="text" class="form-control" data-role="tagsinput"
                                                value="{{ $blogPost->tags }}" name="tags">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Post Image </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image"
                                            class="form-control  @error('image') is-invalid  @enderror" name="image">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 1410 × 882 size
                                                image
                                            </i>
                                        </div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-3">
                                            <img id="showImage" class="" height="150" width="200"
                                                src="{{ asset('uploads/blog/blog_post/' . $blogPost->image) }}"
                                                alt="category image">
                                        </div>
                                    </div>

                                </div>

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
        <!--end row-->
    </div>
@endsection
