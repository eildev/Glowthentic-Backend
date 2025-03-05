@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('sub.subcategory.update', $sub_subcategory->id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-info">Update Sub-Subcategory</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-12 form-label">Sub Subcategory Name</label>
                                    <div class="col-12">
                                        <input type="text" name="subSubcategoryName"
                                            class="form-control @error('subSubcategoryName') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Subcategory Name"
                                            value="{{ $sub_subcategory->subSubcategoryName }}">
                                        @error('subSubcategoryName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                @php
                                    $subcategories = App\Models\Subcategory::all();
                                @endphp
                                <div class="row mb-3">
                                    <label class="form-label col-12">Select Subategory</label>
                                    <div class="col-12">
                                        <select class="form-select" name="subcategoryId">
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}"
                                                    {{ $subcategory->id == $sub_subcategory->subcategoryId ? 'selected' : '' }}>
                                                    {{ $subcategory->subcategoryName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subcategoryId')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5">Update Sub-Subategory</button>
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
