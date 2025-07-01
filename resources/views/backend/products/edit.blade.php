@extends('backend.master')
@section('admin')
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <div class="page-content">
        <div class="row">
            <div class="card">
                <div class="card-body p-4">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Edit Product</h5>

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
                        <form action="" enctype="multipart/form-data" id="productForm">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <input type="text" name="product_id" value="{{ $product->id }}" hidden>
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
                                                                    <option value="{{ $category->id }}"
                                                                        {{ in_array($category->id, $selectedCategoryIds) ? 'selected' : '' }}>
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
                                                                @foreach ($subcategories as $subcategory)
                                                                    <option value="{{ $subcategory->id }}"
                                                                        {{ in_array($subcategory->id, $selectedSubcategoryIds) ? 'selected' : '' }}>
                                                                        {{ $subcategory->categoryName ?? '' }}
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
                                                    <label class="form-label col-12">Select Brand</label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('brand_id') is-invalid  @enderror"
                                                            name="brand_id">
                                                            <option value="">Select Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option
                                                                    {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                                    value="{{ $brand->id }}">
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
                                                    <label class="form-label col-12">Select Unit</label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('unit_id') is-invalid  @enderror"
                                                            name="unit_id">
                                                            <option value="{{ $product->unit_id }}">
                                                                {{ $product->unit_id }}</option>
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
                                                        <label for="" class="form-label">Product Name</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" name="product_name"
                                                            class="form-control product_sku @error('product_name') is-invalid  @enderror"
                                                            id="inputEnterYourName"
                                                            value="{{ $product->product_name ?? '' }}">
                                                        @error('product_name')
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
                                                            id="" cols="30" rows="3">{{ $product->productdetails->short_description ?? '' }}</textarea>
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
                                                            cols="30" rows="3">{{ $product->productdetails->product_policy ?? '' }}</textarea>
                                                        @error('product_policy')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="form-label">Description</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control no-bg product_descriptions_onedit @error('description') is-invalid @enderror"
                                                            name="description" style="resize: none; height: 70px;">{!! $product->productdetails->description ?? '' !!}</textarea>

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
                                                        <textarea class="form-control no-bg ingrediantsedit @error('ingredients') is-invalid @enderror" name="ingredients"
                                                            placeholder="Enter Ingredients" style="resize: none; height: 100px;" id="ingrediants">{!! $product->productdetails->ingredients ?? '' !!}</textarea>

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
                                                        <textarea class="form-control no-bg usage_instructionedit @error('usage_instruction') is-invalid @enderror"
                                                            name="usage_instruction" placeholder="Enter Usage Instruction" style="resize: none; height: 100px;">{!! $product->productdetails->usage_instruction ?? '' !!}</textarea>

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
                                                        value="{{ $product->sku ?? '' }}" name="sku">
                                                    @error('sku')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <label class="form-label col-12">Select Gender</label>
                                                    <div class="col-12">
                                                        <select class="form-select @error('gender') is-invalid  @enderror"
                                                            name="gender">
                                                            <option value="{{ $product->productdetails->gender }}">
                                                                {{ $product->productdetails->gender ?? '' }}</option>
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
                                                            <option
                                                                {{ $product->shipping_charge == 'free' ? 'selected' : '' }}
                                                                value="free">Free</option>
                                                            <option
                                                                {{ $product->shipping_charge == 'paid' ? 'selected' : '' }}
                                                                value="paid">Paid</option>
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
                                                        placeholder="https://www.youtube.com/" name="video_link"
                                                        value="{{ $product->video_link ?? '' }}">
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
                                                        <option value="{{ $promo->id }}"
                                                            {{ isset($existPromotion) && $existPromotion->promotion_id == $promo->id ? 'selected' : '' }}>
                                                            {{ $promo->promotion_name ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Select Product Feature</label>
                                                <select class="multiple-select" data-placeholder="Choose anything"
                                                    multiple="multiple" name="product_feature[]">
                                                    @foreach ($features as $feature)
                                                        <option value="{{ $feature->id }}"
                                                            {{ in_array($feature->id, $selectFeatureIds) ? 'selected' : '' }}>
                                                            {{ $feature->feature_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                            <div class="col-md-12">
                                                <label class="form-label">Select Product Concern</label>
                                                <select class="multiple-select" data-placeholder="Choose anything"
                                                    multiple="multiple" name="product_feature[]">
                                                    @foreach ($concerns as $concern)
                                                        <option value="{{ $concern->id }}"
                                                            {{ in_array($concern->id, $selectedConcernId) ? 'selected' : '' }}>
                                                            {{ $concern->name ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="" class="mb-2">Extra Field Add</label>
                                                <select class="form-select extra_field" name="extra_field">

                                                </select>
                                            </div>
                                            <div id="extra_info_field">
                                                @foreach ($extraFields as $extraField)
                                                    @php
                                                        $attribute = App\Models\Attribute::where(
                                                            'id',
                                                            $extraField->attribute_id,
                                                        )->first();
                                                        $savedValue = $extraField->value; // Assuming this contains saved data
                                                    @endphp

                                                    @if ($attribute)
                                                        <div class="mb-3 col-md-6 extra-field-container">
                                                            <label for="name"
                                                                class="form-label">{{ $attribute->field_name }}</label>

                                                            @if ($attribute->data_type === 'text')
                                                                <input class="form-control" type="text"
                                                                    name="extra_field[{{ $attribute->id }}]"
                                                                    value="{{ old("extra_field.$attribute->id", $savedValue) }}">
                                                            @elseif ($attribute->data_type === 'decimal' || $attribute->data_type === 'int' || $attribute->data_type === 'double')
                                                                <input class="form-control" type="number"
                                                                    name="extra_field[{{ $attribute->id }}]"
                                                                    value="{{ old("extra_field.$attribute->id", $savedValue) }}">
                                                            @elseif ($attribute->data_type === 'date')
                                                                <input class="form-control" type="date"
                                                                    name="extra_field[{{ $attribute->id }}]"
                                                                    value="{{ old("extra_field.$attribute->id", $savedValue) }}">
                                                            @elseif ($attribute->data_type === 'json')
                                                                @php
                                                                    $options =
                                                                        json_decode($attribute->options, true) ?? [];
                                                                    $selectedValues =
                                                                        json_decode($savedValue, true) ?? [];
                                                                @endphp
                                                                @foreach ($options as $option)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="extra_field[{{ $attribute->id }}][]"
                                                                            value="{{ $option }}"
                                                                            id="checkbox_{{ $attribute->id }}_{{ $option }}"
                                                                            {{ in_array($option, $selectedValues) ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="checkbox_{{ $attribute->id }}_{{ $option }}">{{ $option }}</label>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                            <span class="text-danger name_error"></span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a type="" class="btn btn-primary update_product"
                                                        data-product_id="{{ $product->id }}">Update
                                                        Product</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row" style="" id="variant_form">
                            <form id="variant_form_submit" enctype="multipart/form-data">
                                <div class="col-md-12 col-sm-12">
                                    <h5 class="mb-3 fw-bold  text-primary border-bottom pb-2">Variation Product
                                        Name:{{ $product->product_name }}</h5>

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
                                                @foreach ($variants as $variant)
                                                    <tr>
                                                        <input type="text" name="variant_id[]"
                                                            value="{{ $variant->id }}" hidden>
                                                        <td><input type="hidden" name="product_id"
                                                                value="{{ $variant->product_id }}"></td>

                                                        <td><input type="text" class="form-control"
                                                                name="variant_name[{{ $variant->id }}]"
                                                                value="{{ $variant->variant_name ?? '' }}"></td>
                                                        <td><input type="number" class="form-control"
                                                                name="price[{{ $variant->id }}]"
                                                                value="{{ $variant->regular_price ?? 0 }}"></td>
                                                        <td>
                                                            <select
                                                                class="form-select @error('size') is-invalid @enderror size"
                                                                name="size[{{ $variant->id }}]">
                                                                @foreach ($size as $size_name)
                                                                    <option value="{{ $size_name->size_name }}"
                                                                        {{ $variant->size == $size_name->size_name ? 'selected' : '' }}>
                                                                        {{ $size_name->size_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select
                                                                class="form-select @error('color') is-invalid @enderror color"
                                                                name="color[{{ $variant->id }}]">
                                                                @foreach ($color as $color_name)
                                                                    <option value="{{ $color_name->color_name }}"
                                                                        {{ $variant->color == $color_name->color_name ? 'selected' : '' }}>
                                                                        {{ $color_name->color_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td><input type="number" class="form-control"
                                                                name="weight[{{ $variant->id }}]"
                                                                value="{{ $variant->weight ?? '' }}"></td>
                                                        <td><input type="text" class="form-control"
                                                                name="flavor[{{ $variant->id }}]"
                                                                value="{{ $variant->flavor ?? '' }}"></td>
                                                        <td><input type="file" class="form-control"
                                                                name="image[{{ $variant->id }}][]" multiple>

                                                            @foreach ($variant->variantImage as $image)
                                                                <div
                                                                    class="image-container position-relative d-inline-block m-2">
                                                                    <img src="{{ asset($image->image) }}" alt=""
                                                                        width="50px" height="50px"
                                                                        class="border rounded">
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm rounded-circle remove-image position-absolute top-0 end-0 p-0 d-flex align-items-center justify-content-center"
                                                                        data-id="{{ $image->id }}"
                                                                        style="width: 20px; height: 20px;">
                                                                        <span class="text-white fw-bold">×</span>
                                                                    </button>
                                                                </div>
                                                            @endforeach
                                                        </td>

                                                        <td><input type="number" class="form-control"
                                                                name="stock_quantity[{{ $variant->id }}]"
                                                                value="{{ $variant->productStock->StockQuantity ?? 0 }}">
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-success addRow">+</button>

                                                            <button type="button" class="btn btn-danger removeRow"
                                                                data-variant_id={{ $variant->id }}>✖</button>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="10" class="text-end">
                                                        <a class="btn btn-primary variant_update">Variant Update</a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
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



    {{-- script start --}}
    <script>
        $(document).ready(function() {



            // প্রথম এডিটর
            $('.product_descriptions_onedit').summernote({
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
            $('.ingrediantsedit').summernote({
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
            $('.usage_instructionedit').summernote({
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
        // selectedTagIds
        const selectedTagIds = @json($selectedTagIds);

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

                            const isSelected = selectedTagIds.includes(item.id) ? 'selected' : '';
                            product_tag.append(
                                '<option value="' + item.id + '" ' + isSelected + '>' + item
                                .tagName + '</option>'
                            );
                        });

                        product_tag.val(selectedTagIds).trigger('change');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching tags:', error);
                }
            });
        }
        getProductTag();

        ////////////////////////////////////////////validation error///////////////////////////////
        const isMultipleCategory = '{{ $setting->isMultipleCategory }}'
        const categories = @json($selectedCategoryIds);
        console.log(categories);

        function validationError() {
            $(".error-message").remove();
            $("input, select, textarea").removeClass("is-invalid");
            $(".text-danger").remove(); // ensure old errors are cleared

            let isValid = true;
            let errors = {};

            let category_id = isMultipleCategory == 0 ? $('select[name="category_id"]').val() : $(
                'select[name="category_id[]"]').val();
            let brand_id = $('select[name="brand_id"]').val()?.trim() || "";
            let unit_id = $('select[name="unit_id"]').val()?.trim() || "";

            let gender = $('select[name="gender"]').val()?.trim() || "";
            // let product_name = $('input[name="product_name"]').val()?.trim() || "";
            let short_description = $('textarea[name="short_description"]').val()?.trim() || "";
            let product_policy = $('textarea[name="product_policy"]').val()?.trim() || "";

            // Validate short description and product policy length
            if (short_description.length > 220) {
                errors.short_description = "Short Description must be less than 220 characters!";
                isValid = false;
            }

            if (product_policy.length > 220) {
                errors.product_policy = "Product Policy must be less than 220 characters!";
                isValid = false;
            }

            if (isMultipleCategory == 0) {
                if (categories.length > 1) {
                    // console.log('Categories', categories);
                    // console.log(categories.length > 1);
                    if (!category_id || (Array.isArray(category_id) && category_id.length === 0)) {
                        errors.category_id = "Category id is Required";
                        isValid = false;
                    }
                }
            } else {
                if (!category_id || (Array.isArray(category_id) && category_id.length === 0)) {
                    errors.category_id = "Category id is Required";
                    isValid = false;
                }
            }
            if (brand_id === "") {
                errors.brand_id = "Brand is required!";
                isValid = false;
            }
            if (unit_id === "") {
                errors.unit_id = "Unit is required!";
                isValid = false;
            }
            if (gender === "") {
                errors.gender = "Gender is required!";
                isValid = false;
            }


            // Log errors for debugging
            console.log("Validation Errors:", errors);
            if (!$.isEmptyObject(errors)) {
                isValid = false;

                if (errors.category_id) $("select[name='category_id']").after(
                    `<span class="text-danger">${errors.category_id}</span>`);
                if (errors.brand_id) $("select[name='brand_id']").after(
                    `<span class="text-danger">${errors.brand_id}</span>`);
                if (errors.unit_id) $("select[name='unit_id']").after(`<span class="text-danger">${errors.unit_id}</span>`);

                if (errors.gender) $("select[name='gender']").after(`<span class="text-danger">${errors.gender}</span>`);
                // if (errors.product_name) $("input[name='product_name']").after(
                //     `<span class="text-danger">${errors.product_name}</span>`);
                if (errors.short_description) $("textarea[name='short_description']").after(
                    `<span class="text-danger">${errors.short_description}</span>`);
                if (errors.product_policy) $("textarea[name='product_policy']").after(
                    `<span class="text-danger">${errors.product_policy}</span>`);
            }

            return isValid;
        }

        ///////////////////tag delete///////////////////////



        ///////////////////variant image delete///////////////////
        $(document).on('click', '.remove-image', function() {
            let image_id = $(this).data('id');
            console.log(image_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/product/variant/image/delete",
                type: "POST",
                data: {
                    image_id: image_id
                },
                success: function(response) {
                    if (response.status == '200') {

                        toastr.success("Image Delete Successfully");
                    }
                }
            })

        });
        $(document).on('click', '.remove-image', function() {
            $(this).parent().remove();

        });


        ////////////////////////////////////////variant Update ////////////////////////////////////////

        $(document).on("click", ".variant_update", function(e) {
            e.preventDefault();

            let isValid = true;
            $(".text-danger").remove(); // Remove old error messages

            $('#productTableBody tr').each(function() {
                let row = $(this);

                let priceInput = row.find('input[name^="price"]');
                let sizeSelect = row.find('select[name^="size"]');
                let colorSelect = row.find('select[name^="color"]');
                let weightInput = row.find('input[name^="weight"]');
                // let galleryImages = $("input[name^='image[][]']")[0].files;



                let price = priceInput.val()?.trim();
                let size = sizeSelect.val()?.trim();
                let color = colorSelect.val()?.trim();
                let weight = weightInput.val()?.trim();

                if (!weight) {
                    weightInput.after(`<span class="text-danger">Weight is required</span>`);
                }

                if (!size) {
                    sizeSelect.after(`<span class="text-danger">Size is required</span>`);
                    isValid = false;
                }

                if (!color) {
                    colorSelect.after(`<span class="text-danger">Color is required</span>`);
                    isValid = false;
                }

                if (!price) {
                    priceInput.after(`<span class="text-danger">Price is required</span>`);
                    isValid = false;
                }

                var imageInput = row.find('input[type="file"][name^="image"]')[0];

                if (imageInput && imageInput.files.length > 0) {
                    var files = imageInput.files;

                    for (var i = 0; i < files.length; i++) {
                        if (files[i].size > 2 * 1024 * 1024) { // 2MB
                            $(imageInput).after(
                                '<div class="text-danger error-message">Each image must be less than 2MB</div>'
                            );
                            isValid = false;
                            break;
                        }
                    }
                }

            });

            if (!isValid) return;

            // Submit the form via AJAX
            let formdata = new FormData($('#variant_form_submit')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/product/variant/update",
                type: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status === 200) {
                        toastr.success(res.message);
                        $('#variant_form_submit')[0].reset();
                        window.location.href = "/product/view/" + res.product_id;
                    } else {
                        toastr.error(res.message);
                    }
                }
            });
        });


        $(document).on("click", ".addRow", function() {
            let rowCount = $("#productTableBody tr").length;

            let row = `<tr>
        <td></td>
        <td><input type="text" class="form-control" name="variant_name[${rowCount}]"></td>
        <td><input type="number" class="form-control" name="price[${rowCount}]"></td>
        <td><select class="form-select size" name="size[${rowCount}]"></select></td>
        <td><select class="form-select color" name="color[${rowCount}]"></select></td>
        <td><input type="number" class="form-control" name="weight[${rowCount}]"></td>
        <td><input type="text" class="form-control" name="flavor[${rowCount}]"></td>
        <td><input type="file" class="form-control" name="image[${rowCount}][]" multiple></td>
        <td><input type="number" class="form-control" name="stock_quantity[${rowCount}]"></td>
        <td>
            <button type="button" class="btn btn-danger removeRow">✖</button>
        </td>
    </tr>`;

            $("#productTableBody").append(row);

            // Get the latest added row's dropdowns
            let lastSize = $("#productTableBody .size").last();
            let lastColor = $("#productTableBody .color").last();

            getSize(lastSize);
            getColor(lastColor);
        });



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
                        $(targetElement).append(options);
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
                        $(targetElement).append(options);
                    }
                }
            });
        }


        // getColor();
        // getSize();



        $(document).on("click", ".removeRow", function() {
            $(this).closest("tr").remove();
        });
        //////////////////////////////////////////////////////variant Delete ////////////////////////////////////////
        $(document).on('click', '.removeRow', function() {
            let variant_id = $(this).data('variant_id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/product/variant/delete",
                type: "POST",
                data: {
                    variant_id: variant_id
                },
                success: function(res) {
                    if (res.status == 200) {
                        toastr.success("Variant Delete Successfully");
                    }
                }

            });

        });
        //////////////////////////////////update product //////////////////////////////////////////////////////
        $(document).on("click", ".update_product", function() {

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
                url: "/product/update",
                data: formdata,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == 200) {
                        $('#productForm')[0].reset();
                        toastr.success("Product Updated Successfully");


                    } else {
                        toastr.error("Something Went Wrong");
                    }
                },
                error: function(xhr) {
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
                        console.log(extraField);
                        let option = `<option value="" selected disabled>Select Extra Field</option>`;

                        extraField.forEach(function(field) {
                            option +=
                                `<option value="${field.id}" data-id="${field.id}">${field.field_name}</option>`;
                        });

                        $('.extra_field').append(option);
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
        });













        $(document).on("click", ".add_variant", function() {

            $('#variant_form').fadeIn(1000);
            this.disabled = true;
            this.innerText = "Variant Added";
            $.ajax({
                url: '/product/get_variant_data',
                type: 'Get',
                success: function(res) {
                    $('#variant_form').append(
                        `

                `
                    )
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
