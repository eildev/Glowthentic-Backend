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
                            <div class="my-3">
                                <a href="{{ route('product') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    Add New Product</a>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="form-body mt-4">
                        <form method="POST" action="" enctype="multipart/form-data" id="productForm">
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
                                                    <label class="form-label col-12">Select Category</label>
                                                    <div class="col-12">
                                                        <select class="form-select category_select @error('category_id') is-invalid  @enderror" name="category_id">
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
                                                        <select class="form-select subcategory_select @error('subcategory_id') is-invalid  @enderror" name="subcategory_id">
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
                                                    <label class="form-label col-12">Select Brand</label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('brand_id') is-invalid  @enderror" name="brand_id">
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
                                                    <label class="form-label col-12">Select Unit</label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('unit_id') is-invalid  @enderror" name="unit_id">
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
                                                    <label class="form-label col-12">Select Size</label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('size') is-invalid  @enderror" name="size">
                                                            <option value="">Select Size</option>
                                                            <option value="s">Small (S)</option>
                                                            <option value="m">Medium (M)</option>
                                                            <option value="l">Large (L)</option>
                                                            <option value="xl">X-Large (XL)</option>
                                                            <option value="xxl">XX-Large (XXL)</option>
                                                            <option value="6">Size 6</option>
                                                            <option value="7">Size 7</option>
                                                            <option value="8">Size 8</option>
                                                            <option value="9">Size 9</option>
                                                            <option value="10">Size 10</option>
                                                            <option value="500g">500g</option>
                                                            <option value="1kg">1kg</option>
                                                            <option value="500ml">500ml</option>
                                                            <option value="1l">1L</option>
                                                        </select>
                                                        @error('size')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>







                                        <div class="row mb-3">

                                            <div class="col-md-6">

                                                <div class="row">
                                                    <label class="form-label col-12">Select Color</label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('color') is-invalid  @enderror" name="color">
                                                            <option value="">Select Color</option>
                                                            <option value="black">Black</option>
                                                            <option value="white">White</option>
                                                            <option value="red">Red</option>
                                                            <option value="blue">Blue</option>
                                                            <option value="green">Green</option>
                                                            <option value="yellow">Yellow</option>
                                                            <option value="orange">Orange</option>
                                                            <option value="purple">Purple</option>
                                                            <option value="pink">Pink</option>
                                                            <option value="brown">Brown</option>
                                                            <option value="gray">Gray</option>
                                                            <option value="silver">Silver</option>
                                                            <option value="gold">Gold</option>
                                                            <option value="navy">Navy</option>
                                                            <option value="maroon">Maroon</option>
                                                            <option value="beige">Beige</option>
                                                            <option value="teal">Teal</option>
                                                            <option value="cyan">Cyan</option>
                                                            <option value="magenta">Magenta</option>
                                                            <option value="olive">Olive</option>
                                                            <option value="violet">Violet</option>
                                                            <option value="indigo">Indigo</option>
                                                            <option value="turquoise">Turquoise</option>
                                                            <option value="charcoal">Charcoal</option>

                                                        </select>
                                                        @error('color')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Product Weight</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" name="weight"
                                                            class="form-control @error('weight') is-invalid  @enderror" id="inputEnterYourName"
                                                            placeholder="Enter Product Weight">
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
                                                            class="form-control @error('flavor') is-invalid  @enderror" id="inputEnterYourName"
                                                            placeholder="Enter Product flavor">
                                                         @error('flavor')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Product Price</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" name="price"
                                                            class="form-control @error('price') is-invalid  @enderror" id="inputEnterYourName"
                                                            placeholder="Enter Product Weight">
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
                                                    <label class="form-label col-12">Select Gender</label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('gender') is-invalid  @enderror" name="gender">
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


                                        </div>




                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Product Name</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" name="product_name"
                                                            class="form-control product_sku @error('product_name') is-invalid  @enderror" id="inputEnterYourName"
                                                            placeholder="Enter Product Name">
                                                         @error('product_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Variant Name</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" name="variant_name"
                                                            class="form-control  @error('variant_name') is-invalid  @enderror" id="inputEnterYourName"
                                                            placeholder="Enter Variant Name">
                                                         @error('variant_name')
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
                                                        <textarea class="form-control  product_descriptions @error('description') is-invalid  @enderror" name="description" placeholder="Enter Product Description" style="resize: none; height: 70px;"></textarea>
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
                                                        <textarea class="form-control product_descriptions" name="ingredients" placeholder="Enter Ingredients"
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
                                                        <textarea class="form-control product_descriptions" name="usage_instruction" placeholder="Enter Usage Instruction"
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
                                                    <input type="text" class="form-control sku_generate @error('sku') is-invalid  @enderror"
                                                        placeholder="ASD1202" name="sku">
                                                    @error('sku')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label"> Stock Quantity</label>
                                                    <input type="text" class="form-control  @error('stock_quantity') is-invalid  @enderror"
                                                        placeholder="Enter Stock Quantity" name="stock_quantity">
                                                    @error('stock_quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>







                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label col-12">Select Feature</label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('product_feature') is-invalid  @enderror" id="multiple-select-field"
                                                            name="product_feature[]" data-placeholder="Choose anything"
                                                            multiple>
                                                            <option value="feature">Feature</option>
                                                            <option value="new-arrival">New Arrival</option>
                                                            <option value="trending">Trending</option>
                                                            <option value="best-rate">Best Rate</option>
                                                            <option value="weekend-deals">Weekend Deals</option>
                                                            <option value="top-seller">Top Seller</option>
                                                            <option value="top-offers">Top Offers</option>
                                                        </select>
                                                         @error('product_feature')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>




                                            @php
                                              $tag=App\Models\TagName::all();
                                            @endphp

                                            <div class="mb-3">
                                                <label class="form-label">Select Product Tag</label>
                                                <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="tag[]">
                                                    {{-- <option value="" selected>Select Product Tag</option> --}}
                                                    @foreach($tag as $tag)
                                                       <option value="{{$tag->id}}">{{$tag->tagName}}</option>
                                                    @endforeach

                                                </select>
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
                                                    <label for="image" class="form-label">Product Thumbnail</label>
                                                    <input type="file" id="image" class="form-control @error('product_main_image') is-invalid @enderror"
                                                        name="product_main_image[]" multiple>
                                                    <div class="my-1">
                                                        <i><b>Note:</b> Please provide 600 X 600 size image</i>
                                                    </div>
                                                    <div id="imageCount" class="text-primary mt-1"></div> <!-- Display image count here -->
                                                    @error('product_main_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a type="" class="btn btn-primary add_product">Add
                                                        Product</a>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a  class="btn btn-primary add_variant">Add
                                                        Variant</a>
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



    <script>

   document.getElementById('image').addEventListener('change', function () {
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











        $(document).on("click", ".addRow", function () {
          let rowCount = $("#productTableBody tr").length; // Get current row count
        let row = `<tr>
            <td></td>
            <td><input type="text" class="form-control" name="variant_name[]"></td>
            <td><input type="number" class="form-control" name="price[]"></td>
            <td>
                <select class="form-select" name="size[]">
                    <option value="">Select Size</option>
                    <option value="s">Small (S)</option>
                    <option value="m">Medium (M)</option>
                    <option value="l">Large (L)</option>
                    <option value="xl">X-Large (XL)</option>
                    <option value="xxl">XX-Large (XXL)</option>
                    <option value="6">Size 6</option>
                    <option value="7">Size 7</option>
                    <option value="8">Size 8</option>
                    <option value="9">Size 9</option>
                    <option value="10">Size 10</option>
                    <option value="500g">500g</option>
                    <option value="1kg">1kg</option>
                    <option value="500ml">500ml</option>
                    <option value="1l">1L</option>
                </select>
            </td>
            <td>
                <select class="form-select" name="color[]">
                    <option value="">Select Color</option>
                    <option value="black">Black</option>
                    <option value="white">White</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="yellow">Yellow</option>
                    <option value="orange">Orange</option>
                    <option value="purple">Purple</option>
                    <option value="pink">Pink</option>
                    <option value="brown">Brown</option>
                    <option value="gray">Gray</option>
                    <option value="silver">Silver</option>
                    <option value="gold">Gold</option>
                    <option value="navy">Navy</option>
                    <option value="maroon">Maroon</option>
                    <option value="beige">Beige</option>
                    <option value="teal">Teal</option>
                    <option value="cyan">Cyan</option>
                    <option value="magenta">Magenta</option>
                    <option value="olive">Olive</option>
                    <option value="violet">Violet</option>
                    <option value="indigo">Indigo</option>
                    <option value="turquoise">Turquoise</option>
                    <option value="charcoal">Charcoal</option>
                </select>
            </td>
            <td><input type="text" class="form-control" name="weight[]"></td>
            <td><input type="text" class="form-control" name="flavor[]"></td>
            <td><input type="file" class="form-control" name="image[${rowCount}][]" multiple></td>
            <td><input type="number" class="form-control" name="stock_quantity[]"></td>
            <td>
                <button type="button" class="btn btn-danger removeRow">✖</button>
            </td>
        </tr>`;
    $("#productTableBody").append(row);
});

$(document).on("click", ".removeRow", function () {
    $(this).closest("tr").remove();
});


    $(document).on("click", ".add_variant", function(){

        $('#variant_form').fadeIn(1000);
        this.disabled = true;
        this.innerText = "Variant Added";
        $.ajax({
            url:'/product/get_variant_data',
            type:'Get',
            success:function(res){
              $('#variant_form').append(
                `
                    <form id="variant_form_submit"  enctype="multipart/form-data">
                           <div class="col-md-12 col-sm-12">
                             <h5 class="mb-3 fw-bold  text-primary border-bottom pb-2">Variation Product Name:  ${res.product_name}</h5>

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
                                                <select class="form-select @error('size') is-invalid @enderror size" name="size[]">
                                                    <option value="">Select Size</option>
                                                    <option value="s">Small (S)</option>
                                                    <option value="m">Medium (M)</option>
                                                    <option value="l">Large (L)</option>
                                                    <option value="xl">X-Large (XL)</option>
                                                    <option value="xxl">XX-Large (XXL)</option>
                                                    <option value="6">Size 6</option>
                                                    <option value="7">Size 7</option>
                                                    <option value="8">Size 8</option>
                                                    <option value="9">Size 9</option>
                                                    <option value="10">Size 10</option>
                                                    <option value="500g">500g</option>
                                                    <option value="1kg">1kg</option>
                                                    <option value="500ml">500ml</option>
                                                    <option value="1l">1L</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select @error('color') is-invalid @enderror color" name="color[]">
                                                    <option value="">Select Color</option>
                                                    <option value="black">Black</option>
                                                    <option value="white">White</option>
                                                    <option value="red">Red</option>
                                                    <option value="blue">Blue</option>
                                                    <option value="green">Green</option>
                                                    <option value="yellow">Yellow</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="purple">Purple</option>
                                                    <option value="pink">Pink</option>
                                                    <option value="brown">Brown</option>
                                                    <option value="gray">Gray</option>
                                                    <option value="silver">Silver</option>
                                                    <option value="gold">Gold</option>
                                                    <option value="navy">Navy</option>
                                                    <option value="maroon">Maroon</option>
                                                    <option value="beige">Beige</option>
                                                    <option value="teal">Teal</option>
                                                    <option value="cyan">Cyan</option>
                                                    <option value="magenta">Magenta</option>
                                                    <option value="olive">Olive</option>
                                                    <option value="violet">Violet</option>
                                                    <option value="indigo">Indigo</option>
                                                    <option value="turquoise">Turquoise</option>
                                                    <option value="charcoal">Charcoal</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="weight[]"></td>
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
                `
              )
            }


        });
    });




            $(document).on("click", ".add_product", function () {
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
                        success:function(res){
                            if(res.status == 200){
                            toastr.success(res.message);
                            }



                        },
                        error: function (xhr) {
                                if (xhr.status === 422) {
                                    let errors = xhr.responseJSON.errors;
                                    $('.error-message').remove(); // Remove previous errors
                                    console.log(errors);
                                    $.each(errors, function (key, value) {
                                        let inputField = $('[name="' + key + '"]');
                                        inputField.after('<div class="text-danger error-message">' + value[0] + '</div>');
                                    });
                                }
                            }
                    })
            });


  $(document).on("click",".variant_save",function(e){
    e.preventDefault();

    let isValid = true;
    $(".error-message").remove();
    $("#productTableBody tr").each(function () {
        let size = $(this).find('[name="size[]"]').val();
        let color = $(this).find('[name="color[]"]').val();

        if (!size && !color) {
        $(this).find('[name="size[]"]').after('<div class="text-danger error-message">Size or Color is required</div>');
        isValid = false;
    }
    });

    if (!isValid) {
        toastr.error("Please select at least one size and one color before saving.");
        return;
    }


    let formdata = new FormData($('#variant_form_submit')[0]);

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url:"/product/variant/store",
                type:"POST",
                data:formdata,
                contentType: false,
                processData:false,
                success:function(res){

                    console.log(res);
                    toastr.success(res.message);
                    $('#variant_form_submit')[0].reset();
                    // location.reload();
                }
            });
  });




















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
