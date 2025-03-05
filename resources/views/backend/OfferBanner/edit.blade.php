@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('offerbanner.update', $bannerContent->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-info">Update Banner</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner heading</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="heading"
                                            class="form-control @error('title') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Banner heading"
                                            value="{{ $bannerContent->title }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Banner Title"
                                            value="{{ $bannerContent->title }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Short Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('short_description') is-invalid  @enderror" name="short_description" placeholder=""
                                            style="resize: none; height: 100px;">{{ $bannerContent->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Link</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="link"
                                            class="form-control @error('link') is-invalid  @enderror"
                                            id="inputEnterYourName" value="{{ $bannerContent->link }}"
                                            placeholder="Enter Banner Link">
                                        @error('link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Banner Thumbnail </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image"
                                            class="form-control  @error('image') is-invalid  @enderror" name="image">
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> Please provide 1310 X 220 size
                                                image
                                            </i>
                                        </div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-3">
                                            <img id="showImage" class="" height="150" width="200"
                                                src="{{ asset('uploads/offer_banner/' . $bannerContent->image) }}"
                                                alt="banner image">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5">Update Banner</button>
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
