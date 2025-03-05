@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('subcategory.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-info">Update Subcategory</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-12 form-label">Subcategory Name</label>
                                    <div class="col-12">
                                        <input type="text" name="subcategoryName" class="form-control @error('subcategoryName') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Subcategory Name"
                                            value="{{ $subcategory->subcategoryName }}">
                                            @error('subcategoryName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                @php
                                    $categories = App\Models\Category::all();
                                @endphp
                                <div class="row mb-3">
                                    <label class="form-label col-12">Select Category</label>
                                    <div class="col-12">
                                        <select class="form-select" name="categoryId">
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ ($category->id == $subcategory->categoryId) ? 'selected' : '' }}>
                                                {{ $category->categoryName }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('categoryId')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Sub-Category Thumbnail </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image"
                                            class="form-control" name="image">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 300 X 180 size
                                                image
                                            </i>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <img id="showImage" class="" height="150" width="200"
                                                src="{{ $subcategory->image ? asset('uploads/subcategory/' . $subcategory->image) : '' }}" alt="Sub category image">
                                        </div>
                                    </div> </br>
                                
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5">Update Subategory</button>
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
