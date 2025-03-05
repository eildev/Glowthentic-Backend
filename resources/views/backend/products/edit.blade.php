@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card">
                <div class="card-body p-4">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Update Product</h5>
                    </div>
                    <hr />
                    <div class="form-body mt-4">
                        {{-- update product section  --}}

                        <form action="{{ route('product.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                @php
                                                    $categories = App\Models\Category::all();
                                                @endphp
                                                <div class="row">
                                                    <label class="form-label col-12">Select Category</label>
                                                    <div class="col-12">
                                                        @php
                                                            $categories = App\Models\Category::all();
                                                        @endphp
                                                        <select class="form-select category_select" name="category_id">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                                    {{ $category->categoryName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="category_error text-danger"></span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @php
                                                    $subcategories = App\Models\Subcategory::all();
                                                @endphp
                                                <div class="row">
                                                    <label class="form-label col-12">Select Subcategory</label>
                                                    <div class="col-12">
                                                        <select class="form-select subcategory_select" name="subcategory_id">
                                                            @foreach ($subcategories as $subcategory)
                                                                <option value="{{ $subcategory->id }}"
                                                                    {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>
                                                                    {{ $subcategory->subcategoryName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="subcategory_error text-danger"></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @php
                                                    $sub_subcategories = App\Models\SubSubcategory::all();
                                                @endphp
                                                <div class="row">
                                                    <label class="form-label col-12">Select Sub-Subcategory</label>
                                                    <div class="col-12">
                                                        <select class="form-select" name="sub_subcategory_id">
                                                          <option value="">NaN</option>
                                                            @if ($product->sub_subcategory_id)
                                                                @foreach ($sub_subcategories as $sub_subcategory)
                                                                    <option value="{{ $sub_subcategory->id ?? '' }}"
                                                                        {{ $sub_subcategory->id == $product->sub_subcategory_id ? 'selected' : '' }}>
                                                                        {{ $sub_subcategory->subSubcategoryName }}</option>
                                                                        
                                                                @endforeach
                                                            @else
                                                                <option value="">Select Sub-Subcategory</option>
                                                                {{-- @foreach ($sub_subcategories as $sub_subcategory)
                                                                    <option value="{{ $sub_subcategory->id ?? '' }}">
                                                                        {{ $sub_subcategory->subSubcategoryName }}
                                                                    </option>
                                                                @endforeach --}}
                                                            @endif


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
                                                        <select class="form-select " name="brand_id">
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}"
                                                                    {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                                    {{ $brand->BrandName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="brand_error text-danger"></span>
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
                                                        <input type="text" name="product_name" class="form-control "
                                                            id="inputEnterYourName" value="{{ $product->product_name }}">
                                                        <span class="product_name_error text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="row mb-3">
                                                    <label for="multiple-select-field" class="form-label">Select
                                                        Feature</label>
                                                    <div class="col-12">
                                                        @php
                                                            $features = explode(',', $product->product_feature);
                                                        @endphp
                                                        <select id="multi_select" name="product_feature[]" multiple>
                                                            @foreach ($features as $feature)
                                                                <option value="{{ $feature }}"
                                                                    {{ $features ? 'selected' : '' }}>{{ $feature }}
                                                                </option>
                                                            @endforeach
                                                            <option value="new-arrival">New Arrival</option>
                                                            <option value="trending">Trending</option>
                                                            <option value="best-rate">Best Rate</option>
                                                            <option value="weekend-deals">Weekend Deals</option>
                                                            <option value="top-seller">Top Seller</option>
                                                            <option value="top-offers">Top Offers</option>
                                                        </select>
                                                        <span class="feature_error text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Short Description</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control " name="short_desc" placeholder="" style="resize: none; height: 70px;">{{ $product->short_desc }}</textarea>
                                                        <span class="short_desc text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Long Description</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control " name="long_desc" placeholder="" style="resize: none; height: 100px;"
                                                            id="product_descriptions">{{ $product->long_desc }}</textarea>
                                                        <span class="long_desc text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-flex align-items-center">
                                            <div class="col-md-6">
                                                <label for="image" class="form-label">Product Thumbnail</label>
                                                <input type="file" id="image" class="form-control  "
                                                    name="product_image">
                                                <div class="my-1">
                                                    <i>
                                                        <b>Note:</b> Please provide 600 X 600 size
                                                        image
                                                    </i>
                                                </div>
                                                <span class="product_image text-danger"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <img id="showImage" class="" height="150" width="200"
                                                    src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                    alt="product image">
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
                                                    <input type="text" class="form-control" placeholder="ASD1202"
                                                        name="sku" value="{{ $product->sku }}">
                                                    <span class="sku_error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label col-12">Select Feature</label>
                                                    <div class="col-12">
                                                        @php
                                                            $features = explode(',', $product->product_feature);
                                                        @endphp
                                                        <select class="form-select" id="multiple-select-field"
                                                            name="product_feature[]" data-placeholder="Choose anything"
                                                            multiple>
                                                            @foreach ($features as $feature)
                                                                <option value="{{ $feature }}"
                                                                    {{ $features ? 'selected' : '' }}>{{ $feature }}
                                                                </option>
                                                            @endforeach
                                                            <option value="feature">Feature</option>
                                                            <option value="new-arrival">New Arrival</option>
                                                            <option value="trending">Trending</option>
                                                            <option value="best-rate">Best Rate</option>
                                                            <option value="weekend-deals">Weekend Deals</option>
                                                            <option value="top-seller">Top Seller</option>
                                                            <option value="top-offers">Top Offers</option>
                                                        </select>
                                                        <span class="feature_error text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Tags</label>
                                                    <input type="text" class="form-control" data-role="tagsinput"
                                                        placeholder="jQuery,Net" name="tag"
                                                        value="{{ $product->tags }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="image" class="form-label">Image Gallery </label>
                                                <input type="file" id="imageGallery" class="form-control "
                                                    name="imageGallery[]" multiple>
                                                <div class="my-1"><i><b>Note:</b> Please provide 600 X 600 size
                                                        image</i></div>

                                                <div class="my-3">
                                                    <div id="preview_img">
                                                        @foreach ($product->gallary as $gallery)
                                                            <img class="img-fluid"
                                                                style="height70px; width: 70px; object-fit: contain;"
                                                                src="{{ asset('/uploads/products/gallery/' . $gallery->image) }}"
                                                                alt="Product image">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <label for="image" class="form-label">Image Gallery </label>
                                                <input type="file" id="imageGallery" class="form-control  "
                                                    name="imageGallery[]" multiple>
                                                <div class="my-1">
                                                    <i>
                                                        <b>Note:</b> Please provide 600 X 600 size
                                                        image
                                                    </i>
                                                </div>
                                                <div class="my-3">
                                                    <img id="showImage" class="img-fluid" height="150" width="150"
                                                        src="{{ asset('uploads/productempty.jpg') }}"
                                                        alt="category image">
                                                </div>
                                            </div> --}}
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary update_product">Update
                                                        Product</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- update variants section  --}}
                        {{-- <div class="row variant_section ">
                            <form method="POST" id="productVariant">
                                @csrf
                                <div class="col-12">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3 mb-4">
                                            <div class="col-lg-3 col-md-6">
                                                <label for="inputPrice" class="form-label">Regular Price</label>
                                                <input type="number" class="form-control regular_price" id="inputPrice"
                                                    placeholder="00.00" name="regular_price">
                                                <input type="hidden" class="product_id" name="product_id"
                                                    value="{{ $product->id }}">
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
                                                    <option value="">discount</option>
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
                                                    <option value="red">red</option>
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
                                                <input type="date" class="form-control manufacture_date"
                                                    id="inputPrice" placeholder="" name="manufacture_date">
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label class="form-label">Expire Date</label> <br>
                                                <input type="date" class="form-control expire_date" id="inputPrice"
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

                            variant table 
                            <div class="row">
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
                                                    <th>Size</th>
                                                    <th>Color</th>
                                                    <th>Manufacture Date</th>
                                                    <th>Expire Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="varient_container">
                                                @php
                                                    $variants = $product->varient;
                                                @endphp
                                                @if ($variants->count() > 0)
                                                    @foreach ($variants as $variant)
                                                        <tr>
                                                            <td>{{ $variant->regular_price }}</td>
                                                            <td>{{ $variant->discount }}</td>
                                                            <td>{{ $variant->discount_amount }}</td>
                                                            <td>{{ $variant->stock_quantity }}</td>
                                                            <td>{{ $variant->unit }}</td>
                                                            <td>{{ $variant->weight }}</td>
                                                            <td>{{ $variant->size }}</td>
                                                            <td>{{ $variant->color }}</td>
                                                            <td>{{ $variant->manufacture_date }}</td>
                                                            <td>{{ $variant->expire_date }}</td>
                                                            <td>
                                                                <a href="{{ route('variant.edit', $variant->id) }}"
                                                                    class="btn-sm btn-info me-2 edit_variant"
                                                                    value="{{ $variant->id ?? 0 }}">
                                                                    Edit
                                                                </a>
                                                                <a href="{{ route('variant.delete', $variant->id ?? 0) }}"
                                                                    class="btn-sm btn-danger delete_variant"
                                                                    value="{{ $variant->id ?? 0 }}">
                                                                    Delete
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="12" class="text-center text-warning">Data not Found
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="my-3">
                                <a href="{{ route('product') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    Add New Product</a>
                            </div>
                        </div> --}}
                    </div>

                </div>

                <!--end row-->
            </div>
        </div>
    </div>
    </div>
    <!--end row-->
    </div>



    <script>
        // // product Update Ajax Crud 
        // const updateProduct = document.querySelector('.update_product');
        // updateProduct.addEventListener('click', function(e) {
        //     e.preventDefault();
        //     // alert('ok');
        //     let id = "{{ $product->id }}"
        //     // alert(id);
        //     let allData = new FormData(jQuery("#productForm")[0]);
        //     $.ajax({
        //         url: "/product/update/" + id,
        //         type: "POST",
        //         data: allData,
        //         contentType: false,
        //         processData: false,
        //         success: function(res) {
        //             if (res.status == 200) {
        //                 $('.update_product').addClass('disabled');
        //                 $('.product_id').val(res.productId);
        //                 toastr.success(res.message);
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
        //         toastr.error('please provide variants');
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
