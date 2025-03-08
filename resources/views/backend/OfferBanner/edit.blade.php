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
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Link Button Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="link_button"
                                            class="form-control @error('title') is-invalid  @enderror"
                                            id="inputEnterYourName" value="{{ $bannerContent->link_button }}"
                                            placeholder="Enter Banner Title">
                                        @error('title')
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
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Cart Status</label>
                                    <div class="col-sm-9">
                                        <select id="" name="status" class="form-select selectstatus">
                                            <option selected>Choose...</option>
                                            <option value="cart1" {{ $bannerContent->status == 'cart1' ? 'selected' : '' }}>CART 1</option>
                                            <option value="cart2" {{ $bannerContent->status == 'cart2' ? 'selected' : '' }}>CART 2</option>
                                            <option value="cart3" {{ $bannerContent->status == 'cart3' ? 'selected' : '' }}>CART 3</option>
                                            <option value="cart4" {{ $bannerContent->status == 'cart4' ? 'selected' : '' }}>CART 4</option>
                                            <option value="cart5" {{ $bannerContent->status == 'cart5' ? 'selected' : '' }}>CART 5</option>

                                        </select>
                                        @error('parent_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>


                              @if($bannerContent->status == 'cart1')
                             <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Gallery Images </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="galleryimages" class="form-control" name="galleryimages[]"
                                            multiple>
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> <span class="text-danger">Please provide 142 X 83 size image for cart 1 it's not applicable for other cart</span>

                                            </i>
                                        </div>
                                        <div>
                                            @foreach ($bannerContent->images as $image)
                                                <div style="display: inline-block; margin: 5px; position: relative;">
                                                    <img src="{{ asset($image->image) }}" height="50" width="50" alt="">

                                                    <form action="{{ route('offerBanerimage.delete', $image->id) }}" method="POST" style="display: inline;">
                                                        @csrf

                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this image?')"
                                                                style="position: absolute; top: 0; right: 0; background: red; color: white; border: none; cursor: pointer;">
                                                            &times;
                                                        </button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>

                                 @endif




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
                                                src="{{ asset($bannerContent->image) }}"
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

    <script>
        $(document).ready(function(){
            $('.galleryimage').hide();

            $(document).on('change', '.selectstatus', function(){
                var cart = $(this).val();
                console.log("Selected cart: ", cart);

                if(cart === 'cart1'){
                    $('.galleryimage').fadeIn();
                } else {
                    $('.galleryimage').fadeOut();
                }
            });
        });
    </script>
@endsection
