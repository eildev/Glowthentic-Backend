@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('popupMessage.update', $popupMessage->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-info">Update Popup Message</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Popup Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="form-control @error('title') is-invalid  @enderror" id="inputEnterYourName"
                                            placeholder="Enter Popup Title" value="{{ $popupMessage->title }}">
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Popup Link</label>
                                    <div class="col-sm-9">
                                        <input type="url" name="link" class="form-control @error('link') is-invalid  @enderror" id=""
                                            placeholder="Enter Popup Link" value="{{ $popupMessage->link }}">
                                            @error('link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Popup
                                        Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('description') is-invalid  @enderror" name="description" placeholder="" style="resize: none; height: 150px;">{{ $popupMessage->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Popup Thumbnail </label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control @error('image') is-invalid  @enderror" name="image"
                                            value="{{ $popupMessage->image }}">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-3">
                                            <img id="showImage" class="" height="150" width="200"
                                                src="{{ asset('uploads/popupMessage/'.$popupMessage->image) }}" alt="category image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5">Update Popup Message</button>
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
