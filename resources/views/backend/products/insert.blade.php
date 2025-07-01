@extends('backend.master')
@section('admin')
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <div class="page-content">

        <div class="row">
            <div class="card">
                <div class="card-body p-4">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Add Product</h5>

                        <div class="d-flex items-center">
                            <div class="my-3 me-2">
                                <a href="{{ route('product.view') }}" class="btn btn-danger">
                                    <i class='bx bx-show'></i>
                                    View All Product</a>
                            </div>
                            <div class="my-3 me-2">
                                <a href="{{ route('product') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    {{-- <i class="fas fa-rotate-right"></i> --}}
                                    Add New Product</a>
                            </div>


                            <div class="my-3 ml-2">
                                <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#addFieldModal">
                                    <i class="fas fa-plus"></i> Add Extra Field
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="form-body mt-4">


                        <!-- Loader -->
                        <div id="loader"
                            style="position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999; display:none;">

                            <div style="width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                        </div>
                        <form method="POST" enctype="multipart/form-data" id="productForm">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row mb-3 g-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="form-label col-12">Select Category<span
                                                            class="text-danger fw-bold">*</span></label>
                                                    <div class="col-12">
                                                        @if ($setting->isMultipleCategory === 0)
                                                            <select
                                                                class="form-select category_select @error('category_id') is-invalid  @enderror"
                                                                name="category_id">
                                                                <option value="">Select Category</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->categoryName ?? '' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <select
                                                                class="multiple-select category_select @error('category_id') is-invalid  @enderror"
                                                                data-placeholder="Select Category" multiple="multiple"
                                                                name="category_id[]">
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->categoryName ?? '' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="form-label col-12">Select Subcategory</label>
                                                    <div class="col-12">
                                                        @if ($setting->isMultipleCategory === 0)
                                                            <select
                                                                class="form-select subcategory_select @error('subcategory_id') is-invalid  @enderror"
                                                                name="subcategory_id">
                                                                <option value="">Select Subcategory</option>
                                                            </select>
                                                        @else
                                                            <select
                                                                class="multiple-select subcategory_select @error('subcategory_id') is-invalid  @enderror"
                                                                data-placeholder="Select Subcategory" multiple="multiple"
                                                                name="subcategory_id[]">

                                                            </select>
                                                        @endif
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                               
                                                <div class="row">
                                                    <label class="form-label col-12">Select Sub-Subcategory</label>
                                                    <div class="col-12">
                                                        <select class="form-select" name="sub_subcategory_id">
                                                            <option value="">Select Sub-Subcategory</option>
                                                          
                                                        </select>
                                                        <span class="sub_subcategory_id text-danger"></span>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="form-label col-12">Select Brand <span
                                                            class="text-danger fw-bold">*</span></label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('brand_id') is-invalid  @enderror"
                                                            name="brand_id">
                                                            <option value="">Select Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}">
                                                                    {{ $brand->BrandName ?? '' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="form-label col-12">Select Unit <span
                                                            class="text-danger fw-bold">*</span></label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('unit_id') is-invalid  @enderror"
                                                            name="unit_id">
                                                            <option value="">Select Unit</option>
                                                            <option value="pcs">Piece</option>
                                                            <option value="set">Set</option>
                                                            <option value="pair">Pair</option>
                                                            <option value="dozen">Dozen</option>
                                                            <option value="kg">Kilogram (kg)</option>
                                                            <option value="g">Gram (g)</option>
                                                            <option value="mg">Milligram (mg)</option>
                                                            <option value="lb">Pound (lb)</option>
                                                            <option value="oz">Ounce (oz)</option>
                                                            <option value="l">Liter (L)</option>
                                                            <option value="ml">Milliliter (ml)</option>
                                                            <option value="fl_oz">Fluid Ounce (fl oz)</option>
                                                            <option value="gal">Gallon (gal)</option>
                                                            <option value="m">Meter (m)</option>
                                                            <option value="cm">Centimeter (cm)</option>
                                                            <option value="inch">Inch (in)</option>
                                                            <option value="ft">Foot (ft)</option>
                                                            <option value="yd">Yard (yd)</option>
                                                            <option value="pack">Pack</option>
                                                            <option value="box">Box</option>
                                                        </select>
                                                        @error('unit_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Product Name <span
                                                                class="text-danger fw-bold">*</span></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" name="product_name"
                                                            class="form-control product_sku @error('product_name') is-invalid  @enderror"
                                                            id="inputEnterYourName" placeholder="Enter Product Name">
                                                        @error('product_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Product Price <span
                                                                class="text-danger fw-bold">*</span></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" name="price"
                                                            class="form-control @error('price') is-invalid  @enderror"
                                                            id="inputEnterYourName" placeholder="Enter Product Weight"
                                                            min="0" value="0">
                                                        @error('price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Variant Name</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" name="variant_name"
                                                            class="form-control  @error('variant_name') is-invalid  @enderror"
                                                            id="inputEnterYourName" placeholder="Enter Variant Name">
                                                        @error('variant_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Short Description <span
                                                                class="text-danger fw-bold"></span></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea name="short_description" class="form-control @error('short_description') is-invalid  @enderror"
                                                            id="" cols="30" rows="3"></textarea>
                                                        @error('short_description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Product Policy<span
                                                                class="text-danger fw-bold"></span></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea name="product_policy" class="form-control @error('product_policy') is-invalid  @enderror" id=""
                                                            cols="30" rows="3"></textarea>
                                                        @error('product_policy')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label"> Description</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control product_descriptions_on no-bg @error('description') is-invalid  @enderror"
                                                            name="description" placeholder="Enter Product Description" style="resize: none; height: 70px;"></textarea>
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Ingredients</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control ingrediants no-bg" name="ingredients" placeholder="Enter Ingredients"
                                                            style="resize: none; height: 100px;" id=""></textarea>


                                                        @error('ingredients')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Usage Instruction</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control usage_instruction no-bg" name="usage_instruction" placeholder="Enter Usage Instruction"
                                                            style="resize: none; height: 100px;" id=""></textarea>


                                                        @error('usage_instruction')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">SKU</label>
                                                    <input type="text"
                                                        class="form-control sku_generate @error('sku') is-invalid  @enderror"
                                                        placeholder="ASD1202" name="sku">
                                                    @error('sku')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label"> Stock Quantity</label>
                                                    <input type="number"
                                                        class="form-control  @error('stock_quantity') is-invalid  @enderror"
                                                        placeholder="Enter Stock Quantity" name="stock_quantity"
                                                        min="0" value="0">
                                                    @error('stock_quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Product Weight (is for
                                                            Shipping) <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" name="weight"
                                                            class="form-control @error('weight') is-invalid  @enderror"
                                                            id="inputEnterYourName" placeholder="Enter Product Weight">
                                                        @error('weight')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Flavor</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" name="flavor"
                                                            class="form-control @error('flavor') is-invalid  @enderror"
                                                            id="inputEnterYourName" placeholder="Enter Product flavor">
                                                        @error('flavor')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <label class="form-label col-12">
                                                        Select Size
                                                        <span class="text-danger fw-bold">*</span>
                                                    </label>
                                                    <div class="col-10">
                                                        <select
                                                            class="form-select @error('size') is-invalid @enderror size"
                                                            name="size" id="size-select">

                                                        </select>
                                                        @error('size')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-2 p-0">
                                                        <button type="button" class="btn btn-outline-primary w-100"
                                                            data-bs-toggle="modal" data-bs-target="#addSizeModal">
                                                            +
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <label class="form-label col-12">
                                                        Select Color
                                                    </label>
                                                    <div class="col-10">
                                                        <select
                                                            class="form-select @error('color') is-invalid @enderror color"
                                                            name="color" id="color-select">
                                                            <option value="">Select Color</option>

                                                        </select>
                                                        @error('color')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-2 p-0">
                                                        <button type="button" class="btn btn-outline-primary w-100"
                                                            data-bs-toggle="modal" data-bs-target="#addColorModal">
                                                            +
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <label class="form-label col-12">Select Gender <span
                                                            class="text-danger fw-bold">*</span></label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('gender') is-invalid  @enderror"
                                                            name="gender">
                                                            <option value="">Select Gender</option>
                                                            <option value="unisex">Unisex</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>

                                                        </select>
                                                        @error('gender')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <label class="form-label col-12">Shipping Charge <span
                                                            class="text-danger fw-bold"></span></label>
                                                    <div class="col-12">
                                                        <select
                                                            class="form-select @error('shipping_charge') is-invalid  @enderror"
                                                            name="shipping_charge">
                                                            <option value="">Select Charge</option>
                                                            <option value="free">Free</option>
                                                            <option value="paid">Paid</option>


                                                        </select>
                                                        @error('shipping_charge')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Video Link</label>
                                                    <input type="url"
                                                        class="form-control video_link @error('video_link') is-invalid  @enderror"
                                                        placeholder="https://www.youtube.com/" name="video_link">
                                                    @error('video_link')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="category" class="form-label">Promotion Name</label>
                                                <select class="form-select promotion" id="promotion" name="promotion_id">
                                                    <option value="">Select Promotion</option>
                                                    @foreach ($promotion as $promo)
                                                        <option value="{{ $promo->id }}">
                                                            {{ $promo->promotion_name ?? '' }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label col-12">Select Feature</label>
                                                    <div class="col-12">
                                                        <select
                                                            class="multiple-select @error('product_feature') is-invalid  @enderror"
                                                            name="product_feature[]" data-placeholder="Choose anything"
                                                            multiple="multiple">
                                                            @foreach ($features as $feature)
                                                                <option value="{{ $feature->id }}">
                                                                    {{ $feature->feature_name ?? '' }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('product_feature')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <label class="form-label col-12">
                                                        Select Product Tag
                                                    </label>
                                                    <div class="col-10">
                                                        <select class="multiple-select product_tag"
                                                            data-placeholder="Choose anything" multiple="multiple"
                                                            name="tag[]">

                                                        </select>
                                                        @error('tag')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-2 p-0">
                                                        <button type="button" class="btn btn-outline-primary w-100"
                                                            data-bs-toggle="modal" data-bs-target="#addTagModal">
                                                            +
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Select Product Concerns</label>
                                                <select class="multiple-select" data-placeholder="Choose anything"
                                                    multiple="multiple" name="concerns[]">
                                                    @foreach ($concerns as $concern)
                                                        <option value="{{ $concern->id }}">{{ $concern->name ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 col-12 data" style="display:none">
                                                <label for="" class="mb-2">Extra Field Add</label>
                                                <select class="form-select extra_field" name="extra_field">

                                                </select>
                                            </div>
                                            <div id="extra_info_field"></div>
                                        </div>
                                        {{--
                                            <div class="col-12">
                                                <label for="image" class="form-label">Image Gallery </label>
                                                <input type="file" id="imageGallery" class="form-control "
                                                    name="imageGallery[]" multiple>
                                                <div class="my-1"><i><b>Note:</b>Please provide 600 X 600 size
                                                        image</i></div>

                                                <div class="my-3">
                                                    <div id="preview_img">
                                                        <img class="img-fluid"
                                                            style="height:100px; width: 100px; object-fit: contain;"
                                                            src="{{ asset('uploads/productempty.jpg') }}"
                                                            alt="Product image">
                                                    </div>

                                                </div>
                                            </div> --}}
                                        <div class="row mb-3 d-flex align-items-center">
                                            <div class="col-md-6">
                                                <label for="image" class="form-label">Product Thumbnail <span
                                                        class="text-danger fw-bold">*</span></label>
                                                <input type="file" id="image"
                                                    class="form-control @error('product_main_image') is-invalid @enderror"
                                                    name="product_main_image[]" multiple required>

                                                <div class="my-1">
                                                    <i><b>Note:</b> Please provide a 600 X 600 size image</i>
                                                </div>
                                                <div id="imageCount" class="text-primary mt-1"></div>
                                                <!-- Display image count here -->

                                                <!-- Error message for the main image field -->
                                                @error('product_main_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <!-- Error messages for each uploaded image -->
                                                @foreach ($errors->get('product_main_image.*') as $messages)
                                                    @foreach ($messages as $message)
                                                        <span class="text-danger d-block">{{ $message }}</span>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <a type="" class="btn btn-primary add_product">Save
                                                    Product</a>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <div class="d-grid">
                                                <a class="btn btn-success add_variant">
                                                    <i class="fas fa-plus"></i>
                                                    Add Variant</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row" style="display: none;" id="variant_form"></div>

                </div>

            </div>

            <!--end row-->
        </div>
    </div>
    {{-- //////////////////////////////////size modal//////////////////////////////////// --}}

    <!-- Modal -->
    <div class="modal fade" id="addSizeModal" tabindex="-1" aria-labelledby="addSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addsizeform">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Size</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="new-size" class="form-label">Size Name</label>
                        <input type="text" id="new-size" name="size_name" class="form-control"
                            placeholder="e.g., 3XL, 2kg, etc.">
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary addSize">Add Size</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- //////////////////////////////////////////////////////add color modal////////////////////////// --}}
    <!-- Modal for Adding New Color -->
    <div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addcolorform">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="new-color" class="form-label">Color Name</label>
                        <input type="text" name="color_name"id="new-color" class="form-control"
                            placeholder="e.g., Peach, Sky Blue">
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary addColor">Add Color</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- //////////////////////////////////////////////// add extra field modal //////////////////////////////////////////////////////// --}}


    {{-- //////////////////////////////////////////////////////add color modal////////////////////////// --}}
    <!-- Modal for Adding Product Tag -->
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addTagform">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product Tag</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="new-tag" class="form-label">Tag Name</label>
                        <input type="text" name="tagName" id="new-tag" class="form-control"
                            placeholder="Enter Tag Name">
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary addTag">Add Tag</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- //////////////////////////////////////////////// add extra field modal //////////////////////////////////////////////////////// --}}


    <div class="modal fade" id="addFieldModal" tabindex="-1" aria-labelledby="addFieldModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFieldModalLabel">Add New Field</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addFieldForm">
                        <!-- Field Name -->
                        <div class="mb-3">
                            <label for="field_name" class="form-label">Field Name</label>
                            <input type="text" class="form-control" id="field_name" name="field_name" required>
                        </div>



                        <div class="mb-3">
                            <label for="data_type" class="form-label">Data Type</label>
                            <select class="form-select p-2" id="data_type" name="data_type" required>
                                <option value="">Select Data Type</option>

                                <option value="longText">Text</option>
                                <option value="text">String</option>
                                <option value="int">Integer</option>

                                <option value="decimal">Decimal</option>
                                <option value="double">Double</option>
                                <option value="date">Date</option>
                                <option value="json">MultiSelect</option>
                            </select>
                        </div>
                        <div class="mb-3 multiInput" style="display: none;">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-success addFieldForm" form="addFieldForm" id="">Save
                        Field</a>
                </div>
            </div>

            <!--end row-->
        </div>
    </div>


    {{-- script start --}}
    <script>
        $(document).ready(function() {
            // প্রথম এডিটর
            $('.product_descriptions_on').summernote({
                height: 300,
                callbacks: {
                    onPaste: function(e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                            .getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });

            // দ্বিতীয় এডিটর
            $('.ingrediants').summernote({
                height: 300,
                callbacks: {
                    onPaste: function(e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                            .getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });

            // তৃতীয় এডিটর
            $('.usage_instruction').summernote({
                height: 300,
                callbacks: {
                    onPaste: function(e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                            .getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });



        //////////////////////////////////////// addSizeSave ////////////////////////
        $(document).on('click', '.addSize', function() {

            let size = $('input[name="size_name"]').val();
            $('input[name="size_name"]').next('.text-danger').remove();
            if (size == '') {
                $('input[name="size_name"]').after('<span class="text-danger">Size Name is required</span>');
                return;
            }
            let formdata = new FormData($('#addsizeform')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.products.addSize') }}",
                type: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 200) {
                        $('#addsizeform')[0].reset();
                        $('#addSizeModal').modal('hide');
                        toastr.success("Size Added Successfully");
                        getSize();
                    } else {
                        toastr.error("Something Went Wrong");
                    }
                },
            });
        });

        ///////////////////////////////////////get size/////////////////////
        function getSize(targetElement = '.size') {
            $.ajax({
                url: "{{ route('admin.products.getSize') }}",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        let size = response.size;
                        let options = '<option value="">Select Size</option>';
                        size.forEach(function(s) {
                            options += '<option value="' + s.size_name + '">' + s.size_name +
                                '</option>';
                        });
                        // Apply only to the given element(s)
                        $(targetElement).html(options);
                    }
                }
            });
        }

        //////////////////////////////////////// colorSave ////////////////////////
        $(document).on('click', '.addColor', function() {

            let color = $('input[name="color_name"]').val();
            $('input[name="color_name"]').next('.text-danger').remove();
            if (color == '') {
                $('input[name="color_name"]').after('<span class="text-danger">Color Name is required</span>');
                return;
            }
            let formdata = new FormData($('#addcolorform')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.products.addColor') }}",
                type: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 200) {
                        $('#addcolorform')[0].reset();
                        $('#addColorModal').modal('hide');
                        toastr.success("Color Added Successfully");
                        getColor();
                    } else {
                        toastr.error("Something Went Wrong");
                    }
                },
            });
        });

        ///////////////////////////////////////get color/////////////////////
        function getColor(targetElement = '.color') {
            $.ajax({
                url: "{{ route('admin.products.getColor') }}",
                type: "GET",
                success: function(response) {
                    if (response.status == 200) {
                        let color = response.color;
                        let options = '<option value="">Select Color</option>';
                        color.forEach(function(c) {
                            options += '<option value="' + c.color_name + '">' + c.color_name +
                                '</option>';
                        });

                        // Apply only to the given element(s)
                        $(targetElement).html(options);
                    }
                }
            });
        }


        //////////////////////////////////////// Product Tag Save ////////////////////////
        $(document).on('click', '.addTag', function() {
            let tagName = $('input[name="tagName"]').val();
            $('input[name="tagName"]').next('.text-danger').remove();

            if (tagName == '') {
                $('input[name="tagName"]').after('<span class="text-danger">Tag Name is required</span>');
                return;
            }

            let formdata = new FormData($('#addTagform')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/tagname/create",
                type: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 200) {
                        $('#addTagform')[0].reset();
                        $('#addTagModal').modal('hide');
                        toastr.success(response.message);
                        getProductTag();
                    } else {
                        toastr.error(response.message || "Something Went Wrong");
                    }
                },
                error: function(xhr) {
                    let response = xhr.responseJSON;
                    if (response && response.status == 422) {
                        // Validation error
                        $.each(response.errors, function(field, errors) {
                            toastr.error(errors.join(', '));
                        });
                    } else if (response && response.status == 500) {
                        // Server error
                        toastr.error(response.message);
                    } else {
                        // Other errors
                        toastr.error("An unexpected error occurred");
                    }
                }
            });
        });

        //////////////////////////////////////// get Product Tag Function ////////////////////////
        function getProductTag() {
            let product_tag = $('.product_tag');
            $.ajax({
                url: "/tagname/show",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        product_tag.empty();
                        let tagNames = response.data;
                        $.each(tagNames, function(key, item) {
                            product_tag.append(
                                '<option myid="' + item.id + '" value="' +
                                item.id + '">' + item.tagName +
                                '</option>'
                            );
                        });
                    }
                }
            });
        }
        getProductTag();



        //////////////////// summernote //////////////////////

        //////////////////////////////////// show validation error //////////////////////////////////////
        const isMultipleCategory = '{{ $setting->isMultipleCategory }}'


        function validationError() {
            $(".error-message").remove();
            $("input, select, textarea").removeClass("is-invalid");
            $(".text-danger").remove();

            let isValid = true;
            let errors = {};

            // Handle single and multiple select
            let category_id = isMultipleCategory == 0 ? $('select[name="category_id"]').val() : $(
                'select[name="category_id[]"]').val();
            let brand_id = $('select[name="brand_id"]').val()?.trim() || "";
            let unit_id = $('select[name="unit_id"]').val()?.trim() || "";
            let size = $('select[name="size"]').val()?.trim() || "";
            let price = $('input[name="price"]').val()?.trim() || "";
            let gender = $('select[name="gender"]').val()?.trim() || "";
            let product_name = $('input[name="product_name"]').val()?.trim() || "";
            let galleryImages = $("input[name='product_main_image[]']")[0]?.files || [];
            let short_description = $('textarea[name="short_description"]').val()?.trim() || "";
            let product_policy = $('textarea[name="product_policy"]').val()?.trim() || "";
            let weight = $('input[name="weight"]').val()?.trim() || "";

            // console.log("Field Values:", {
            //     category_id,
            //     brand_id,
            //     unit_id,
            //     size,
            //     price,
            //     gender,
            //     product_name,
            //     galleryImages: galleryImages.length,
            //     short_description,
            //     product_policy,
            //     weight
            // });

            // Validate short description and product policy length
            if (short_description.length > 220) {
                errors.short_description = "Short Description must be less than 220 characters!";
                isValid = false;
            }

            if (product_policy.length > 220) {
                errors.product_policy = "Product Policy must be less than 220 characters!";
                isValid = false;
            }

            // Validate required fields
            if (!category_id || (Array.isArray(category_id) && category_id.length === 0)) {
                errors.category_id = "Category id is Required";
                isValid = false;
            }
            if (weight === "") {
                errors.weight = "Weight is required!";
                isValid = false;
            }
            if (brand_id === "") {
                errors.brand_id = "Brand is required!";
                isValid = false;
            }
            if (unit_id === "") {
                errors.unit_id = "Unit is required!";
                isValid = false;
            }
            if (size === "") {
                errors.size = "Size is required!";
                isValid = false;
            }
            if (price === "") {
                errors.price = "Price is required!";
                isValid = false;
            }
            if (gender === "") {
                errors.gender = "Gender is required!";
                isValid = false;
            }
            if (product_name === "") {
                errors.product_name = "Product Name is required!";
                isValid = false;
            }
            if (galleryImages.length === 0) {
                errors.galleryimages = "Gallery Images are required!";
                isValid = false;
            }

            // Validate gallery images
            let allowedGalleryTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif", "image/webp"];
            let maxGallerySize = 2048; // 2MB

            for (let i = 0; i < galleryImages.length; i++) {
                let galleryFile = galleryImages[i];
                let galleryFileSize = galleryFile.size / 1024;

                if (!allowedGalleryTypes.includes(galleryFile.type)) {
                    errors.galleryimages = "Only JPG, JPEG, PNG, GIF, and WEBP files are allowed!";
                    isValid = false;
                    break;
                }
                if (galleryFileSize > maxGallerySize) {
                    errors.galleryimages = "Gallery image size must be less than 2MB!";
                    isValid = false;
                    break;
                }
            }

            // Log errors for debugging
            // console.log("Validation Errors:", errors);

            // Show errors
            if (!$.isEmptyObject(errors)) {
                isValid = false;

                if (errors.category_id) {
                    $("select[name='category_id']").after(
                        `<span class="text-danger error-message">${errors.category_id}</span>`
                    );
                    toastr.error(errors.category_id);
                }
                if (errors.weight) {
                    $("input[name='weight']").after(
                        `<span class="text-danger error-message">${errors.weight}</span>`
                    );
                    toastr.error(errors.weight);
                }
                if (errors.brand_id) {
                    $("select[name='brand_id']").after(
                        `<span class="text-danger error-message">${errors.brand_id}</span>`
                    );
                    toastr.error(errors.brand_id);
                }
                if (errors.unit_id) {
                    $("select[name='unit_id']").after(
                        `<span class="text-danger error-message">${errors.unit_id}</span>`
                    );
                    toastr.error(errors.unit_id);
                }
                if (errors.size) {
                    $("select[name='size']").after(
                        `<span class="text-danger error-message">${errors.size}</span>`
                    );
                    toastr.error(errors.size);
                }
                if (errors.price) {
                    $("input[name='price']").after(
                        `<span class="text-danger error-message">${errors.price}</span>`
                    );
                    toastr.error(errors.price);
                }
                if (errors.gender) {
                    $("select[name='gender']").after(
                        `<span class="text-danger error-message">${errors.gender}</span>`
                    );
                    toastr.error(errors.gender);
                }
                if (errors.product_name) {
                    $("input[name='product_name']").after(
                        `<span class="text-danger error-message">${errors.product_name}</span>`
                    );
                    toastr.error(errors.product_name);
                }
                if (errors.galleryimages) {
                    $("input[name='product_main_image[]']").after(
                        `<span class="text-danger error-message">${errors.galleryimages}</span>`
                    );
                    toastr.error(errors.galleryimages);
                }
                if (errors.short_description) {
                    $("textarea[name='short_description']").after(
                        `<span class="text-danger error-message">${errors.short_description}</span>`
                    );
                    toastr.error(errors.short_description);
                }
                if (errors.product_policy) {
                    $("textarea[name='product_policy']").after(
                        `<span class="text-danger error-message">${errors.product_policy}</span>`
                    );
                    toastr.error(errors.product_policy);
                }
            }

            return isValid;
        }



        /////////////////////////////////extra field show in product page///////////////////////

        function showExtraField() {
            $.ajax({
                url: "{{ url('get-extra-field/info/product/page/show') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // console.log("Response Data:", data);

                    if (data.status === 200) {
                        $('.extra_field').empty();
                        let extraField = data.extraField;
                        if (extraField.length > 3) {
                            // Show dropdown and hide auto-fields
                            $('.data').fadeIn(); // Show the dropdown container
                            $('#extra_info_field').empty(); // Clear previously added fields if any

                            let option = `<option value="" selected disabled>Select Extra Field</option>`;

                            extraField.forEach(function(field) {
                                option +=
                                    `<option value="${field.id}" data-id="${field.id}">${field.field_name}</option>`;
                            });

                            $('.extra_field').html(option).prop('disabled', false); // Populate dropdown
                        } else {
                            // Hide dropdown and auto-render input fields
                            $('.data').fadeOut();
                            $('.extra_field').prop('disabled', true); // Optional: disable dropdown

                            $('#extra_info_field').empty(); // Clear any old input

                            extraField.forEach(function(extraData) {
                                let id = extraData.id;

                                // Hidden input for tracking
                                let hiddenInput = $('<input>')
                                    .attr('type', 'hidden')
                                    .attr('name', `extra_field_id[${id}]`)
                                    .val(id);

                                $('#extra_info_field').append(hiddenInput);

                                // Now render inputs by type
                                if (extraData.data_type === "longtext") {
                                    $('#extra_info_field').append(`
                <div class="mb-3 col-md-6 extra-field-container">
                    <label class="form-label">${extraData.field_name}</label>
                    <textarea class="form-control" name="extra_field[${id}]" rows="3"
                        onkeyup="errorRemove(this);" onchange="errorRemove(this);"></textarea>
                    <span class="text-danger name_error"></span>
                    <button type="button" class="btn btn-danger btn-sm remove-field mt-2">-</button>
                </div>
            `);
                                } else if (["decimal", "int", "double"].includes(extraData.data_type)) {
                                    $('#extra_info_field').append(`
                <div class="mb-3 col-md-6 extra-field-container">
                    <label class="form-label">${extraData.field_name}</label>
                    <input class="form-control" type="number" name="extra_field[${id}]"
                        onkeyup="errorRemove(this);" onchange="errorRemove(this);">
                    <span class="text-danger name_error"></span>
                    <button type="button" class="btn btn-danger btn-sm remove-field mt-2">-</button>
                </div>
            `);
                                } else if (extraData.data_type === "text") {
                                    $('#extra_info_field').append(`
                <div class="mb-3 col-md-6 extra-field-container">
                    <label class="form-label">${extraData.field_name}</label>
                    <input class="form-control" type="text" name="extra_field[${id}]"
                        onkeyup="errorRemove(this);" onchange="errorRemove(this);">
                    <span class="text-danger name_error"></span>
                    <button type="button" class="btn btn-danger btn-sm remove-field mt-2">-</button>
                </div>
            `);
                                } else if (extraData.data_type === "date") {
                                    $('#extra_info_field').append(`
                <div class="mb-3 col-md-6 extra-field-container">
                    <label class="form-label">${extraData.field_name}</label>
                    <input class="form-control" type="date" name="extra_field[${id}]"
                        onkeyup="errorRemove(this);" onchange="errorRemove(this);">
                    <span class="text-danger name_error"></span>
                    <button type="button" class="btn btn-danger btn-sm remove-field mt-2">-</button>
                </div>
            `);
                                } else if (extraData.data_type === "json") {
                                    let options = JSON.parse(extraData.options);
                                    let checkboxes = options.map(option => `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="extra_field[${id}][]" value="${option}" id="checkbox_${id}_${option}">
                    <label class="form-check-label" for="checkbox_${id}_${option}">${option}</label>
                </div>
            `).join('');

                                    $('#extra_info_field').append(`
                <div class="mb-3 col-md-6 extra-field-container">
                    <label class="form-label">${extraData.field_name}</label>
                    ${checkboxes}
                    <span class="text-danger name_error"></span>
                    <button type="button" class="btn btn-danger btn-sm remove-field mt-2">-</button>
                </div>
            `);
                                }
                            });
                        }

                    }

                },
                error: function(xhr, status, error) {
                    console.error("Error fetching extra fields:", error);
                }
            });
        }



        showExtraField(); // Ensure the function runs after the DOM is fully loaded


        //////////////////////////////////////////////extra field multiple input show ////////////////////////////
        $(document).on('change', '#data_type', function() {
            let container = $('.multiInput');
            if ($(this).val() == 'json') {
                container.fadeIn();
                container.html(`
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="multi_input[]" placeholder="Enter Multi Input">
                                <button type="button" class="btn btn-success addInput">+</button>
                            </div>
                        `);
            } else {
                container.fadeOut().empty();
            }
        });
        $(document).on('click', '.addInput', function() {
            $('.multiInput').append(`
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="multi_input[]" placeholder="Enter Multi Input">
                            <button type="button" class="btn btn-danger removeInput">-</button>
                        </div>
                    `);
        });
        $(document).on('click', '.removeInput', function() {
            $(this).closest('.input-group').remove();

        });
        //////////////////////////////////////extra field multiple input show end ////////////////////////////

        /////////////////////extra field insert modal ////////////////////////////
        $(document).on('click', '.addFieldForm', function() {
            let fieldName = $('#field_name').val().trim();
            let dataType = $('#data_type').val();
            $('.error-message').remove();
            if (fieldName === '') {
                $('#field_name').after('<small class="text-danger error-message">Field Name is required.</small>');
                return;
            }

            if (dataType === '') {
                $('#data_type').after(
                    '<small class="text-danger error-message">Please select a Data Type.</small>');
                return;
            }
            let fieldForm = new FormData($('#addFieldForm')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/store/extra/datatype/field') }}",
                type: "POST",
                data: fieldForm,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 200) {
                        $('#addFieldForm')[0].reset();
                        $('#addFieldModal').modal('hide');
                        toastr.success("Extra Field Added Successfully");
                        showExtraField();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.error-message').remove(); // Remove previous errors

                        $.each(errors, function(key, value) {
                            let inputField = $('[name="' + key + '"]');
                            inputField.after('<div class="text-danger error-message">' + value[
                                0] + '</div>');
                        });
                    }
                }
            });
        });


        /////////////////////////////////extra field insert modal end///////////////////////////



        ///////////////////////////Extra field show in product insert page//////////////////////////

        $(document).on('change', '.extra_field', function() {
            let selectedOption = $(this).find(':selected');
            console.log(selectedOption);
            let id = selectedOption.data('id');

            if (id) {
                $.ajax({
                    url: "{{ url('/get/extra/info/field/') }}" + "/" + id,
                    type: "GET",
                    success: function(response) {
                        if (response.status == 200) {
                            let extraData = response.extraField;
                            let container = $('#extra_info_field');

                            let hiddenInput = $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', `extra_field_id[${id}]`)
                                .val(id);

                            container.append(hiddenInput);

                            if (extraData.data_type === "longtext") {
                                container.append(`
                         <div class="mb-3 col-md-6 extra-field-container">
                            <label for="name" class="form-label">${extraData.field_name}<span class="text-danger"></span></label>

                            <textarea class="form-control name" name="extra_field[${id}]" rows="3"
                                onkeyup="errorRemove(this);" onchange="errorRemove(this);">{{ old('field_name') }}</textarea>
                            <span class="text-danger name_error"></span>
                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;">-</button>

                        </div>
                    `);
                            } else if (extraData.data_type === "decimal" || extraData.data_type ===
                                "int" || extraData.data_type === "double") {
                                container.append(`
                        <div class="mb-3 col-md-6 extra-field-container">
                            <label for="name" class="form-label">${extraData.field_name}<span class="text-danger"></span></label>

                            <input class="form-control" type="number" name="extra_field[${id}]" rows="3"
                                onkeyup="errorRemove(this);" onchange="errorRemove(this);">
                            <span class="text-danger name_error"></span>
                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;">-</button>

                        </div>
                    `)
                            } else if (extraData.data_type === "text") {
                                container.append(`
                        <div class="mb-3 col-md-6 extra-field-container">
                            <label for="name" class="form-label">${extraData.field_name}<span class="text-danger"></span></label>

                            <input class="form-control" type="text" name="extra_field[${id}]" rows="3"
                                onkeyup="errorRemove(this);" onchange="errorRemove(this);">
                            <span class="text-danger name_error"></span>
                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;">-</button>

                        </div>
                    `)
                            } else if (extraData.data_type === "date") {
                                container.append(`
                        <div class="mb-3 col-md-6 extra-field-container">
                            <label for="name" class="form-label">${extraData.field_name}<span class="text-danger"></span></label>

                            <input class="form-control" type="date" name="extra_field[${id}]" rows="3"
                                onkeyup="errorRemove(this);" onchange="errorRemove(this);">
                            <span class="text-danger name_error"></span>
                            <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;">-</button>

                        </div>
                    `)
                            } else if (extraData.data_type === "json") {
                                let options = JSON.parse(extraData
                                    .options); // Convert JSON string to array

                                let checkboxes = options.map(option => `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="extra_field[${id}][]" value="${option}" id="checkbox_${id}_${option}">
                                <label class="form-check-label" for="checkbox_${id}_${option}">${option}</label>
                            </div>
                        `).join('');

                                container.append(`
                            <div class="mb-3 col-md-6 extra-field-container">
                                <label for="name" class="form-label">${extraData.field_name}<span class="text-danger"></span></label>
                                ${checkboxes}
                                <span class="text-danger name_error"></span>
                                <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;">-</button>
                            </div>
                        `);
                            }
                        }
                    },

                });
            }
        });

        $(document).on("click", ".remove-field", function() {
            $(this).closest(".extra-field-container").remove();

            // Reset the extra_field dropdown
            $(".extra_field").val("").trigger("change");
        });

        /////////////////extra field show end////////////////////
        document.getElementById('image').addEventListener('change', function() {
            let count = this.files.length;
            let message = count > 0 ? count + " image(s) selected" : "No images selected";
            document.getElementById('imageCount').innerText = message;
        });


        // sku Generator
        function generateProductSKU(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let sku = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                sku += characters.charAt(randomIndex);
            }
            return sku;
        }
        document.querySelector(".product_sku").addEventListener('blur', function() {
            const skuGenerate = document.querySelector(".sku_generate");
            const productNameValue = this.value;
            //  console.log(productNameValue);

            if (productNameValue.trim() !== '') {
                skuGenerate.value = generateProductSKU(10);
            }
        })











        $(document).on("click", ".addRow", function() {
            let rowCount = $("#productTableBody tr").length; // Get current row count
            let row = `<tr>
            <td></td>
            <td><input type="text" class="form-control" name="variant_name[]"></td>
            <td><input type="number" class="form-control" name="price[]"></td>
            <td>
                <select class="form-select size" name="size[]">

                </select>
            </td>
            <td>
                <select class="form-select color" name="color[]">

                </select>
            </td>
            <td><input type="number" class="form-control" name="weight[]"></td>
            <td><input type="text" class="form-control" name="flavor[]"></td>
            <td><input type="file" class="form-control" name="image[${rowCount}][]" multiple></td>
            <td><input type="number" class="form-control" name="stock_quantity[]"></td>
            <td>
                <button type="button" class="btn btn-danger removeRow">✖</button>
            </td>
        </tr>`;
            $("#productTableBody").append(row);
            // Call the function after form is added
            getSize();
            getColor();
        });

        $(document).on("click", ".removeRow", function() {
            $(this).closest("tr").remove();
        });





        $(document).on("click", ".add_variant", function() {
            $('#variant_form').fadeIn(1000);
            this.disabled = true;
            this.innerText = "Variant Added";

            $.ajax({
                url: '/product/get_variant_data',
                type: 'GET',
                success: function(res) {
                    $('#variant_form').append(`
                <form id="variant_form_submit" enctype="multipart/form-data">
                    <div class="col-md-12 col-sm-12">
                        <h5 class="mb-3 fw-bold text-primary border-bottom pb-2">Variation Product Name:  ${res.product_name}</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Variant Name</th>
                                        <th>Price</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Weight</th>
                                        <th>Flavor</th>
                                        <th>Image</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="productTableBody">
                                    <tr>
                                        <td><input type="hidden" name="product_id" value="${res.product_id}"></td>
                                        <td><input type="text" class="form-control" name="variant_name[]"></td>
                                        <td><input type="number" class="form-control" name="price[]"></td>
                                        <td>
                                            <select class="form-select size" name="size[]">

                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select color" name="color[]"></select>
                                        </td>
                                        <td><input type="number" class="form-control" name="weight[]"></td>
                                        <td><input type="text" class="form-control" name="flavor[]"></td>
                                        <td><input type="file" class="form-control" name="image[0][]" multiple></td>
                                        <td><input type="number" class="form-control" name="stock_quantity[]"></td>
                                        <td>
                                            <button type="button" class="btn btn-success addRow">+</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10" class="text-end">
                                            <button type="submit" class="btn btn-primary variant_save">Save</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </form>
            `);

                    // Call the function after form is added
                    getSize();
                    getColor();
                }
            });
        });





        $(document).on("click", ".add_product", function() {

            if (!validationError()) {
                console.log("Validation failed");
                return;
            }


            let formdata = new FormData($('#productForm')[0]); // Corrected FormData
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/product/store",
                data: formdata,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loader').show(); // Show loader
                },
                success: function(res) {
                    console.log(res);
                    $('#loader').hide();
                    if (res.status == 200) {
                        toastr.success(res.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                    $('#loader').hide();
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.error-message').remove(); // Remove previous errors
                        console.log(errors);
                        $.each(errors, function(key, value) {
                            let inputField = $('[name="' + key + '"]');
                            inputField.after('<div class="text-danger error-message">' + value[
                                0] + '</div>');
                        });
                    }
                }
            })
        });








        $(document).on("click", ".variant_save", function(e) {
            e.preventDefault();

            let isValid = true;
            $(".error-message").remove(); // Clear existing errors

            $("#productTableBody tr").each(function(index) {
                let size = $(this).find('[name="size[]"]').val();
                let color = $(this).find('[name="color[]"]').val();

                // Validate size or color
                if (!size && !color) {
                    $(this).find('[name="size[]"]').after(
                        '<div class="text-danger error-message">Size or Color is required</div>');
                    isValid = false;
                }

                // Dynamically find the image input by index
                let imageInput = $(this).find(`input[name="image[${index}][]"]`)[0];

                if (!imageInput) {
                    $(this).find('[name="size[]"]').after(
                        '<div class="text-danger error-message">Image input not found</div>');
                    isValid = false;
                    return true; // continue to next row
                }

                let files = imageInput.files;

                // if (files.length < 1) {
                //     $(imageInput).after('<div class="text-danger error-message">Image is required</div>');
                //     isValid = false;
                // } else {
                if (files.length > 1) {
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].size > 2 * 1024 * 1024) { // 2MB limit
                            $(imageInput).after(
                                '<div class="text-danger error-message">Each image must be less than 2MB</div>'
                            );
                            isValid = false;
                            break;
                        }
                    }
                }
            });

            // Stop if invalid
            if (!isValid) {
                toastr.error("Please select at least one size, one color, and a valid image before saving.");
                return;
            }

            // Submit via AJAX
            let formdata = new FormData($('#variant_form_submit')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/product/variant/store",
                type: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loader').show(); // Show loader
                },
                success: function(res) {
                    $('#loader').hide();
                    console.log(res);
                    toastr.success(res.message);
                    $('#variant_form_submit')[0].reset();
                    $('#productForm')[0].reset();
                    location.reload();
                }
            });
        });

        // Call it
        getColor();
        getSize();
    </script>
@endsection
