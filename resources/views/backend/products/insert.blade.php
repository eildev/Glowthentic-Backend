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
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                @php
                                                    $categories = App\Models\Category::whereNull('parent_id')->get();
                                                @endphp
                                                <div class="row">
                                                    <label class="form-label col-12">Select Category<span
                                                            class="text-danger fw-bold">*</span></label>
                                                    <div class="col-12">
                                                        <select
                                                            class="form-select category_select @error('category_id') is-invalid  @enderror"
                                                            name="category_id">
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->categoryName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
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
                                                        <select
                                                            class="form-select subcategory_select @error('subcategory_id') is-invalid  @enderror"
                                                            name="subcategory_id">
                                                            <option value="">Select Subcategory</option>
                                                        </select>
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                {{-- @php
                                                    $sub_subcategories = App\Models\SubSubcategory::all();
                                                @endphp --}}
                                                <div class="row">
                                                    <label class="form-label col-12">Select Sub-Subcategory</label>
                                                    <div class="col-12">
                                                        <select class="form-select" name="sub_subcategory_id">
                                                            <option value="">Select Sub-Subcategory</option>
                                                            {{-- @foreach ($sub_subcategories as $sub_subcategory)
                                                                <option value="{{ $sub_subcategory->id }}">
                                                                    {{ $sub_subcategory->subSubcategoryName }}</option>
                                                            @endforeach --}}
                                                        </select>
                                                        <span class="sub_subcategory_id text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @php
                                                    $brands = App\Models\Brand::all();
                                                @endphp
                                                <div class="row">
                                                    <label class="form-label col-12">Select Brand <span
                                                            class="text-danger fw-bold">*</span></label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('brand_id') is-invalid  @enderror"
                                                            name="brand_id">
                                                            <option value="">Select Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}">
                                                                    {{ $brand->BrandName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>







                                        <div class="row mb-3">

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


                                            <div class="col-md-6">
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



                                        </div>







                                        <div class="row mb-3">

                                            <div class="col-md-6">
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



                                            <div class="col-md-6">

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

                                        </div>






                                        <div class="row mb-3">

                                            <div class="col-md-6">

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

                                        </div>



                                        <div class="row mb-3">

                                            <div class="col-md-6">

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


                                            <div class="col-md-6">

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




                                        </div>




                                        <div class="row mb-3">
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

                                            <div class="col-12 mt-2">
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


                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Short Description <span
                                                                class="text-danger fw-bold"></span></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea name="short_description" class="form-control @error('short_description') is-invalid  @enderror"
                                                            id="" cols="30" rows="6"></textarea>
                                                        @error('short_description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Product Policy<span
                                                                class="text-danger fw-bold"></span></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea name="product_policy" class="form-control @error('product_policy') is-invalid  @enderror" id=""
                                                            cols="30" rows="6"></textarea>
                                                        @error('product_policy')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>




                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label"> Description</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control product_descriptions_on @error('description') is-invalid  @enderror" name="description"
                                                            placeholder="Enter Product Description" style="resize: none; height: 70px;"></textarea>
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Ingredients</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control ingrediants" name="ingredients" placeholder="Enter Ingredients"
                                                            style="resize: none; height: 100px;" id="product_description"></textarea>


                                                        @error('ingredients')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Usage Instruction</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control usage_instruction" name="usage_instruction" placeholder="Enter Usage Instruction"
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







                                            <div class="col-12">
                                                @php
                                                    $features = App\Models\Features::get();
                                                @endphp

                                                <div class="mb-3">
                                                    <label class="form-label col-12">Select Feature</label>
                                                    <div class="col-12">
                                                        <select
                                                            class="multiple-select @error('product_feature') is-invalid  @enderror"
                                                            id="multiple-select-field" name="product_feature[]"
                                                            data-placeholder="Choose anything" multiple>
                                                            @foreach ($features as $feature)
                                                                <option value="{{ $feature->id }}">
                                                                    {{ $feature->feature_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('product_feature')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>




                                            @php
                                                $tag = App\Models\TagName::all();
                                            @endphp

                                            <div class="mb-3">
                                                <label class="form-label">Select Product Tag</label>
                                                <select class="multiple-select" data-placeholder="Choose anything"
                                                    multiple="multiple" name="tag[]">
                                                    {{-- <option value="" selected>Select Product Tag</option> --}}
                                                    @foreach ($tag as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->tagName }}</option>
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
                                                <a type="" class="btn btn-primary add_product">Add
                                                    Product</a>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <div class="d-grid">
                                                <a class="btn btn-danger add_variant">
                                                    <i class="fas fa-plus"></i>
                                                    Add Variant</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>




                    <div class="row" style="display: none;" id="variant_form">

                    </div>







                    {{-- style="display: none"
                        <div class="row variant_section">
                            <div class="card-title d-flex">
                                <h5 class="mb-0 text-info">Add Variants</h5>
                            </div>
                            <form method="POST" id="productVariant">
                                @csrf
                                <div class="col-12">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3 mb-4">
                                            <div class="col-lg-3 col-md-6">
                                                <label for="inputPrice" class="form-label">Regular Price</label>
                                                <input type="number" class="form-control regular_price" id="inputPrice"
                                                    placeholder="00.00" name="regular_price">
                                                <input type="hidden" class="product_id" name="product_id">
                                                <input type="hidden" class="variant_id" name="variant_id"
                                                    value="">
                                                <span class="regular_price_error text-danger"></span>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label for="inputPrice" class="form-label">Discount Price</label>
                                                <input type="number" class="form-control discount_amount"
                                                    id="inputPrice" placeholder="00.00" name="discount_amount">
                                                <span class="discount_amount_error text-danger"></span>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label class="form-label col-12">Discount</label>
                                                <select class="form-select discount" name="discount">
                                                    <option value="0">discount</option>
                                                    <option value="0">0</option>
                                                    <option value="10">10%</option>
                                                    <option value="20">20%</option>
                                                    <option value="30">30%</option>
                                                    <option value="40">40%</option>

                                                </select>
                                                <span class="discount_error text-danger"></span>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <label for="inputPrice" class="form-label">Stock Quantity</label>
                                                <input type="number" class="form-control" id="stock"
                                                    placeholder="00.00" name="stock_quantity">
                                                <span class="stock_quantity_error text-danger"></span>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label class="form-label col-12">Unit</label>
                                                <select class="form-select unit" name="unit">
                                                    <option value="">Unit</option>
                                                    <option value="kg">KG</option>
                                                    <option value="liter">Liter</option>
                                                    <option value="piece">Piece</option>
                                                    <option value="dozon">Dozon</option>
                                                    <option value="inch">Inch</option>
                                                    <option value="gm">GM</option>
                                                    <option value="ml">ML</option>
                                                    <option value="packet">Packet</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label class="form-label">Weight</label> <br>
                                                <input type="text" class="form-control weight" id="inputPrice"
                                                    placeholder="Weight" name="weight">
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label class="form-label col-12">Color</label>
                                                <select class="form-select color" name="color">
                                                    <option value="">Color</option>
                                                    <option value="black">Black</option>
                                                    <option value="white">White</option>
                                                    <option value="red">Red</option>
                                                    <option value="blue">Blue</option>
                                                    <option value="green">Green</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label class="form-label col-12">Size</label>
                                                <select class="form-select size" name="size">
                                                    <option value="">Size</option>
                                                    <option value="M">M</option>
                                                    <option value="L">L</option>
                                                    <option value="XL">XL</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label class="form-label">Barcode Generator</label> <br>
                                                <input type="text" class="form-control barcode" id="inputPrice"
                                                    placeholder="Barcode" name="barcode">
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label class="form-label">Manufacture Date</label> <br>
                                                <input type="date" class="form-control" id="inputPrice"
                                                    placeholder="" name="manufacture_date">
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label class="form-label">Expire Date</label> <br>
                                                <input type="date" class="form-control" id="inputPrice"
                                                    placeholder="" name="expire_date">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="d-flex justify-content-center align-items-center h-100">
                                                    <button type="button" class="btn btn-primary add_varient">Add
                                                        Varients</button>
                                                    <button type="button" class="btn btn-primary update_varient"
                                                        style="display: none;">Update
                                                        Varients</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Regular Price</th>
                                                    <th>Discount</th>
                                                    <th>Discount Price</th>
                                                    <th>Stock Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Weight</th>
                                                    <th>color</th>
                                                    <th>Size</th>
                                                    <th>Manufacture Date</th>
                                                    <th>Expire Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="varient_container">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div> --}}
                </div>

            </div>

            <!--end row-->
        </div>
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
            $('.ingredients').summernote({
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

        // function getColor(){
        //     $.ajax({
        //         url: "{{ route('admin.products.getColor') }}",
        //         type: "GET",
        //         success: function(response) {
        //             console.log(response);
        //             if(response.status == 200){
        //                 let color=response.color;
        //                 console.log(color);
        //                 let option='';
        //                 color.forEach(function(color){
        //                     option += '<option value="'+color.color_name+'">'+color.color_name+'</option>';
        //                 });
        //                  $('.color').append(option);
        //             }
        //         }
        //     });
        // }


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

        ////////////////////summernote//////////////////////
        $(document).ready(function() {
            // $('.product_descriptions').summernote();
            $('.ingrediants').summernote();
            $('.usage_instruction').summernote();
        });
        ////////////////////////////////////show validation error //////////////////////////////////////
        function validationError() {
            $(".error-message").remove();
            $("input, select, textarea").removeClass("is-invalid");
            $(".text-danger").remove(); // ensure old errors are cleared

            let isValid = true;
            let errors = {};

            let category_id = $('select[name="category_id"]').val()?.trim() || "";
            let brand_id = $('select[name="brand_id"]').val()?.trim() || "";
            let unit_id = $('select[name="unit_id"]').val()?.trim() || "";
            let size = $('select[name="size"]').val()?.trim() || "";
            //let color = $('select[name="color"]').val()?.trim() || "";
            let price = $('input[name="price"]').val()?.trim() || "";
            let gender = $('select[name="gender"]').val()?.trim() || "";
            let product_name = $('input[name="product_name"]').val()?.trim() || "";
            let galleryImages = $("input[name='product_main_image[]']")[0]?.files || [];
            let short_description = $('textarea[name="short_description"]').val()?.trim() || "";
            let product_policy = $('textarea[name="product_policy"]').val()?.trim() || "";
            let weight = $('input[name="weight"]').val()?.trim() || "";

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
            if (category_id === "") errors.category_id = "Category is required!";
            if (weight === "") errors.weight = "weight is required!";
            if (brand_id === "") errors.brand_id = "Brand is required!";
            if (unit_id === "") errors.unit_id = "Unit is required!";
            if (size === "") errors.size = "Size is required!";
            // if (color === "") errors.color = "Color is required!";
            if (price === "") errors.price = "Price is required!";
            if (gender === "") errors.gender = "Gender is required!";
            if (product_name === "") errors.product_name = "Product Name is required!";
            if (galleryImages.length === 0) errors.galleryimages = "Gallery Images are required!";

            // Validate gallery images
            let allowedGalleryTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif", "image/webp"];
            let maxGallerySize = 2048; // 2MB

            for (let i = 0; i < galleryImages.length; i++) {
                let galleryFile = galleryImages[i];
                let galleryFileSize = galleryFile.size / 1024;

                if (!allowedGalleryTypes.includes(galleryFile.type)) {
                    errors.galleryimages = "Only JPG, JPEG, PNG, GIF and WEBP files are allowed!";
                    isValid = false;
                    break;
                }
                if (galleryFileSize > maxGallerySize) {
                    errors.galleryimages = "Gallery image size must be less than 2MB!";
                    isValid = false;
                    break;
                }
            }

            // Show errors
            if (!$.isEmptyObject(errors)) {
                isValid = false;

                if (errors.category_id) $("select[name='category_id']").after(
                    `<span class="text-danger">${errors.category_id}</span>`);
                if (errors.brand_id) $("select[name='brand_id']").after(
                    `<span class="text-danger">${errors.brand_id}</span>`);
                if (errors.unit_id) $("select[name='unit_id']").after(`<span class="text-danger">${errors.unit_id}</span>`);

                if (errors.weight) $("input[name='weight']").after(`<span class="text-danger">${errors.weight}</span>`);

                if (errors.size) $("select[name='size']").after(`<span class="text-danger">${errors.size}</span>`);
                // if (errors.color) $("select[name='color']").after(`<span class="text-danger">${errors.color}</span>`);
                if (errors.price) $("input[name='price']").after(`<span class="text-danger">${errors.price}</span>`);
                if (errors.gender) $("select[name='gender']").after(`<span class="text-danger">${errors.gender}</span>`);
                if (errors.product_name) $("input[name='product_name']").after(
                    `<span class="text-danger">${errors.product_name}</span>`);
                if (errors.galleryimages) $("input[name='product_main_image[]']").after(
                    `<span class="text-danger">${errors.galleryimages}</span>`);
                if (errors.short_description) $("textarea[name='short_description']").after(
                    `<span class="text-danger">${errors.short_description}</span>`);
                if (errors.product_policy) $("textarea[name='product_policy']").after(
                    `<span class="text-danger">${errors.product_policy}</span>`);
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
                    $('#loader').hide();
                    if (res.status == 200) {
                        toastr.success(res.message);
                    }



                },
                error: function(xhr) {
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
                // let color = $(this).find('[name="color[]"]').val();

                // Validate size or color
                if (!size) {
                    $(this).find('[name="size[]"]').after(
                        '<div class="text-danger error-message">Size  is required</div>');
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









        // !.. add product ajax Crud
        // const add_product = document.querySelector('.add_product');
        // add_product.addEventListener('click', function(e) {
        //     e.preventDefault();
        //     document
        //         .querySelector(".pageLoader")
        //         .style.setProperty("display", "flex", "important");

        //     let allData = new FormData(jQuery("#productForm")[0]);
        //     $.ajax({
        //         url: "/product/store",
        //         type: "POST",
        //         data: allData,
        //         contentType: false,
        //         processData: false,
        //         success: function(res) {
        //             if (res.status == 200) {
        //                 $('.variant_section').show();
        //                 $('.add_product').addClass('disabled');
        //                 $('.product_id').val(res.productId);
        //                 toastr.success(res.message);
        //                 document
        //                     .querySelector(".pageLoader")
        //                     .style.setProperty("display", "none", "important");
        //             } else {
        //                 $('.category_error').text(res.error.category_id);
        //                 $('.subcategory_error').text(res.error.subcategory_id);
        //                 $('.brand_error').text(res.error.brand_id);
        //                 $('.feature_error').text(res.error.product_feature);
        //                 $('.product_name_error').text(res.error.product_name);
        //                 $('.short_desc').text(res.error.short_desc);
        //                 $('.long_desc').text(res.error.long_desc);
        //                 $('.product_image').text(res.error.product_image);
        //                 $('.sku_error').text(res.error.sku);
        //                 $('.shipping_error').text(res.error.shipping);
        //                 // $('.tag_error').text(res.error.tags);
        //                 toastr.warning(res.error);
        //                 document
        //                     .querySelector(".pageLoader")
        //                     .style.setProperty("display", "none", "important");
        //             }
        //         },
        //     });
        // });



        // // !.. add variant ajax Crud
        // const add_varient = document.querySelector('.add_varient');
        // add_varient.addEventListener('click', function(e) {
        //     e.preventDefault();
        //     document
        //         .querySelector(".pageLoader")
        //         .style.setProperty("display", "flex", "important");
        //     let regular_price = parseFloat(document.querySelector('.regular_price').value);
        //     let discount = parseFloat(document.querySelector('.discount').value);
        //     let discount_amount = parseFloat(document.querySelector('.discount_amount')
        //         .value);
        //     let stock = parseFloat(document.querySelector('#stock').value);

        //     let varientData = new FormData(jQuery("#productVariant")[0]);
        //     if (regular_price > 0 && discount >= 0 && discount_amount > 0 && stock > 0) {
        //         $.ajax({
        //             url: '/product/variant/store',
        //             type: "POST",
        //             data: varientData,
        //             contentType: false,
        //             processData: false,
        //             success: function(response) {
        //                 if (response.status == 200) {
        //                     toastr.success(response.message);
        //                     document.querySelector('.discount_amount')
        //                         .value = '';
        //                     document.querySelector('.regular_price').value = '';
        //                     document.querySelector('.discount').value = '';
        //                     document.querySelector('#stock').value = '';
        //                     document.querySelector('.unit').value = '';
        //                     document.querySelector('.weight').value = '';
        //                     document.querySelector('.color').value = '';
        //                     document.querySelector('.size').value = '';
        //                     show();
        //                     document
        //                         .querySelector(".pageLoader")
        //                         .style.setProperty("display", "none", "important");
        //                 } else {
        //                     toastr.error('Something went wrong');
        //                     document
        //                         .querySelector(".pageLoader")
        //                         .style.setProperty("display", "none", "important");
        //                 }
        //             }
        //         })

        //         document
        //             .querySelector(".pageLoader")
        //             .style.setProperty("display", "none", "important");
        //     } else {
        //         toastr.error('please provide valid input');
        //         document
        //             .querySelector(".pageLoader")
        //             .style.setProperty("display", "none", "important");
        //     }

        // })


        // // show variantData on Table
        // function show() {
        //     const productId = document.querySelector('.product_id').value;
        //     $.ajax({
        //         url: '/product/variant/show/' + productId,
        //         type: "GET",
        //         dataType: 'JSON',
        //         success: function(res) {
        //             if (res.status == 200) {
        //                 // console.log(res);
        //                 let varient_container = document.querySelector('.varient_container');
        //                 varient_container.innerHTML = "";
        //                 const allData = res.variantData;
        //                 allData.forEach(function(data) {
        //                     const tr = document.createElement('tr');
        //                     tr.innerHTML += `
    //                         <td>${data.regular_price}</td>
    //                         <td>${data.discount}</td>
    //                         <td>${data.discount_amount}</td>
    //                         <td>${data.stock_quantity}</td>
    //                         <td>${data.unit}</td>
    //                         <td>${data.weight}</td>
    //                         <td>${data.color}</td>
    //                         <td>${data.size}</td>
    //                         <td>${data.manufacture_date}</td>
    //                         <td>${data.expire_date}</td>
    //                         <td>
    //                         <button class="btn btn-sm btn-info edit_variant me-2" value="${data.id}">
    //                             Edit
    //                         </button>
    //                         <button value="${data.id}" class="btn-sm btn-danger btn delete_variant">Delete</button>
    //                                     </td>
    //                             `;
        //                     varient_container.appendChild(tr);
        //                 })
        //             } else {
        //                 toastr.warning(res.error);
        //             }
        //         }
        //     })
        // }
    </script>
@endsection
