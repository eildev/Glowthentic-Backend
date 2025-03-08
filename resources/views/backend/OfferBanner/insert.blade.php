@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('offerbanner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">

                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Add Offer Banner</h5>

                                    <a href="{{ route('offerbanner.view') }}" class="btn btn-info btn-sm text-light ">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Banner Head</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="heading"
                                            class="form-control @error('title') is-invalid  @enderror"
                                            id="inputEnterYourName" value="{{ old('title') }}"
                                            placeholder="Enter Banner Heading">
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
                                            id="inputEnterYourName" value="{{ old('title') }}"
                                            placeholder="Enter Banner Title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Short Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('short_description') is-invalid  @enderror" name="short_description" placeholder=""
                                            style="resize: none; height: 100px;"></textarea>
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
                                            id="inputEnterYourName" value="{{ old('title') }}"
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
                                            id="inputEnterYourName" value="{{ old('link') }}"
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
                                            <option value="cart1">CART 1</option>
                                            <option value="cart2">CART 2</option>
                                            <option value="cart3">CART 3</option>
                                            <option value="cart4">CART 4</option>
                                            <option value="cart5">CART 5</option>
                                        </select>
                                        @error('parent_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>



                             <div class="row mb-3 galleryimage" style="display: none;">
                                    <label for="image" class="col-sm-3 col-form-label">Gallery Images </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="galleryimages" class="form-control" name="galleryimages[]"
                                            multiple>
                                        <div class="my-1">
                                            <i>
                                                <b>Note:</b> <span class="text-danger">Please provide 142 X 83 size image for cart 1 it's not applicable for other cart</span>

                                            </i>
                                        </div>
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
                                                src="{{ asset('uploads/productempty.jpg') }}" alt="category image">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5 text-white">Add Banner</button>
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
