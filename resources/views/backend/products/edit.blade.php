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
                                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addFieldModal">
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
                                                                <option {{ $product->category_id==$category->id?"selected":'' }} value="{{ $category->id }}">
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
                                                    @php
                                                        $subcategories = App\Models\Category::where('id', $product->subcategory_id)->first();
                                                    @endphp
                                                    <label class="form-label col-12">Select Subcategory</label>
                                                    <div class="col-12">
                                                        <select class="form-select subcategory_select @error('subcategory_id') is-invalid  @enderror" name="subcategory_id">
                                                            <option value="{{$subcategories->id }}">{{ $subcategories->categoryName??'' }}</option>
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
                                                                <option {{ $product->brand_id==$brand->id?"selected":'' }} value="{{ $brand->id }}">
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
                                                            <option value="{{ $product->unit_id }}">{{$product->unit_id}}</option>
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
                                                        <label class="form-label col-12">Select Gender</label>
                                                        <div class="col-12">
                                                            <select class="form-select @error('gender') is-invalid  @enderror" name="gender">
                                                                <option value="{{ $product->productdetails->first()->gender}}">{{$product->productdetails->first()->gender}}</option>
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
                                                            value="{{ $product->product_name }}">
                                                         @error('product_name')
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
                                                        <textarea class="form-control product_descriptions @error('description') is-invalid @enderror"
                                                                  name="description"
                                                                  style="resize: none; height: 70px;">{!! $product->productdetails->first()->description ?? '' !!}</textarea>

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
                                                            style="resize: none; height: 100px;" id="product_description" >{!! $product->productdetails->first()->ingredients??'' !!}</textarea>


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
                                                            style="resize: none; height: 100px;" id="">{!! $product->productdetails->first()->ingredients??'' !!}</textarea>


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
                                                        value="{{ $product->sku }}" name="sku">
                                                    @error('sku')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>











                                            <div class="col-12">
                                                <div class="mb-3">
                                                    @php
                                                        $selectedFeatures= json_decode($product->product_feature, true) ?? [];
                                                    @endphp
                                                    <label class="form-label col-12">Select Feature</label>
                                                    <div class="col-12 ">
                                                        <select class="form-select @error('product_feature') is-invalid @enderror"
                                                                id="multiple-select-field"
                                                                name="product_feature[]"
                                                                data-placeholder="Choose anything"
                                                                multiple>

                                                            @php
                                                                $features = [
                                                                    "feature" => "Feature",
                                                                    "new-arrival" => "New Arrival",
                                                                    "trending" => "Trending",
                                                                    "best-rate" => "Best Rate",
                                                                    "weekend-deals" => "Weekend Deals",
                                                                    "top-seller" => "Top Seller",
                                                                    "top-offers" => "Top Offers"
                                                                ];
                                                            @endphp

                                                            @foreach($features as $key => $value)
                                                                <option value="{{ $key }}"
                                                                    {{ in_array($key, $selectedFeatures) ? 'selected' : '' }}>
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('product_feature')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                            @php
                                            use App\Models\TagName;
                                            use App\Models\Product_Tags;


                                            $allTags = TagName::all();


                                            $selectedTagIds = Product_Tags::where('product_id', $product->id)
                                                                ->pluck('tag_id')
                                                                ->toArray();
                                        @endphp

                                    <div class="mb-3">
                                        <label class="form-label">Select Product Tag</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="tag[]">
                                            @foreach($allTags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    {{ in_array($tag->id, $selectedTagIds) ? 'selected' : '' }}>
                                                    {{ $tag->tagName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>





                                            <div class="mb-3 col-12">
                                                <label for="" class="mb-2">Extra Field Add</label>
                                                <select class="form-select extra_field" name="extra_field" >

                                                </select>
                                            </div>
                                     <div id="extra_info_field">



                                        @foreach ($extraFields as $extraField)
                                            @php
                                                $attribute = App\Models\Attribute::where('id', $extraField->attribute_id)->first();
                                                $savedValue = $extraField->value; // Assuming this contains saved data
                                            @endphp

                                            @if ($attribute)
                                                <div class="mb-3 col-md-6 extra-field-container">
                                                    <label for="name" class="form-label">{{ $attribute->field_name }}</label>

                                                    @if ($attribute->data_type === "text")
                                                        <input class="form-control" type="text" name="extra_field[{{ $attribute->id }}]"
                                                            value="{{ old("extra_field.$attribute->id", $savedValue) }}">

                                                    @elseif ($attribute->data_type === "decimal" || $attribute->data_type === "int" || $attribute->data_type === "double")
                                                        <input class="form-control" type="number" name="extra_field[{{ $attribute->id }}]"
                                                            value="{{ old("extra_field.$attribute->id", $savedValue) }}">

                                                    @elseif ($attribute->data_type === "date")
                                                        <input class="form-control" type="date" name="extra_field[{{ $attribute->id }}]"
                                                            value="{{ old("extra_field.$attribute->id", $savedValue) }}">

                                                    @elseif ($attribute->data_type === "json")
                                                        @php
                                                            $options = json_decode($attribute->options, true) ?? [];
                                                            $selectedValues = json_decode($savedValue, true) ?? [];
                                                        @endphp
                                                        @foreach ($options as $option)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="extra_field[{{ $attribute->id }}][]"
                                                                    value="{{ $option }}" id="checkbox_{{ $attribute->id }}_{{ $option }}"
                                                                    {{ in_array($option, $selectedValues) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="checkbox_{{ $attribute->id }}_{{ $option }}">{{ $option }}</label>
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
                                                    <a type="" class="btn btn-primary update_product" data-product_id="{{ $product->id }}">Update
                                                        Product</a>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>




                        <div class="row" style="" id="variant_form">

                            <form id="variant_form_submit"  enctype="multipart/form-data">
                                <div class="col-md-12 col-sm-12">
                                  <h5 class="mb-3 fw-bold  text-primary border-bottom pb-2">Variation Product Name:{{$product->product_name}}</h5>

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
                                            @foreach ( $variants as $variant)


                                             <tr>
                                                <input type="text" name="variant_id[]" value="{{ $variant->id }}" hidden>
                                                 <td><input type="hidden" name="product_id" value="{{$variant->product_id }}"></td>

                                                  <td><input type="text" class="form-control" name="variant_name[{{$variant->id}}]" value="{{ $variant->variant_name??'' }}"></td>
                                                 <td><input type="number" class="form-control" name="price[{{$variant->id}}]" value="{{ $variant->regular_price??0 }}"></td>
                                                 <td>
                                                     <select class="form-select @error('size') is-invalid @enderror size" name="size[{{ $variant->id }}]">
                                                         <option value="">Select Size</option>
                                                         <option value="s" {{ $variant->size=="s"?"selected":'' }}>Small (S)</option>
                                                         <option value="m" {{ $variant->size=="m"?"selected":'' }}>Medium (M)</option>
                                                         <option value="l" {{ $variant->size=="l"?"selected":'' }}>Large (L)</option>
                                                         <option value="xl" {{ $variant->size=="xl"?"selected":'' }}>X-Large (XL)</option>
                                                         <option value="xxl" {{ $variant->size=="xxl"?"selected":'' }}>XX-Large (XXL)</option>
                                                         <option value="6" {{ $variant->size=="6"?"selected":'' }}>Size 6</option>
                                                         <option value="7" {{ $variant->size=="7"?"selected":'' }}>Size 7</option>
                                                         <option value="8" {{ $variant->size=="8"?"selected":'' }}>Size 8</option>
                                                         <option value="9" {{ $variant->size=="9"?"selected":'' }}>Size 9</option>
                                                         <option value="10" {{ $variant->size=="10"?"selected":'' }}>Size 10</option>
                                                         <option value="500g" {{ $variant->size=="500g"?"selected":'' }}>500g</option>
                                                         <option value="1kg" {{ $variant->size=="1kg"?"selected":'' }}>1kg</option>
                                                         <option value="500ml" {{ $variant->size=="500ml"?"selected":'' }}>500ml</option>
                                                         <option value="1l" {{ $variant->size=="11"?"selected":'' }}>1L</option>
                                                     </select>
                                                 </td>
                                                 <td>
                                                     <select class="form-select @error('color') is-invalid @enderror color" name="color[{{ $variant->id }}]">
                                                         <option value="">Select Color</option>
                                                         <option value="black"{{ $variant->color=="black"?"selected":'' }}>Black</option>
                                                         <option value="white"{{ $variant->color=="white"?"selected":'' }}>White</option>
                                                         <option value="red"{{ $variant->color=="red"?"selected":'' }}>Red</option>
                                                         <option value="blue"{{ $variant->color=="blue"?"selected":'' }}>Blue</option>
                                                         <option value="green"{{ $variant->color=="green"?"selected":'' }}>Green</option>
                                                         <option value="yellow"{{ $variant->color=="yellow"?"selected":'' }}>Yellow</option>
                                                         <option value="orange"{{ $variant->color=="orange"?"selected":'' }}>Orange</option>
                                                         <option value="purple"{{ $variant->color=="purple"?"selected":'' }}>Purple</option>
                                                         <option value="pink"{{ $variant->color=="pink"?"selected":'' }}>Pink</option>
                                                         <option value="brown"{{ $variant->color=="brown"?"selected":'' }}>Brown</option>
                                                         <option value="gray"{{ $variant->color=="gray"?"selected":'' }}>Gray</option>
                                                         <option value="silver"{{ $variant->color==""?"selected":'' }}>Silver</option>
                                                         <option value="gold"{{ $variant->color=="gold"?"selected":'' }}>Gold</option>
                                                         <option value="navy"{{ $variant->color=="navy"?"selected":'' }}>Navy</option>
                                                         <option value="maroon"{{ $variant->color=="maroon"?"selected":'' }}>Maroon</option>
                                                         <option value="beige"{{ $variant->color=="beige"?"selected":'' }}>Beige</option>
                                                         <option value="teal"{{ $variant->color=="teal"?"selected":'' }}>Teal</option>
                                                         <option value="cyan"{{ $variant->color=="cyan"?"selected":'' }}>Cyan</option>
                                                         <option value="magenta"{{ $variant->color=="magenta"?"selected":'' }}>Magenta</option>
                                                         <option value="olive"{{ $variant->color=="olive"?"selected":'' }}>Olive</option>
                                                         <option value="violet"{{ $variant->color=="violet"?"selected":'' }}>Violet</option>
                                                         <option value="indigo"{{ $variant->color=="indigo"?"selected":'' }}>Indigo</option>
                                                         <option value="turquoise"{{ $variant->color=="turquoise"?"selected":'' }}>Turquoise</option>
                                                         <option value="charcoal"{{ $variant->color=="charcoal"?"selected":'' }}>Charcoal</option>
                                                     </select>
                                                 </td>
                                                 <td><input type="text" class="form-control" name="weight[{{ $variant->id }}]" value="{{ $variant->weight??'' }}"></td>
                                                 <td><input type="text" class="form-control" name="flavor[{{ $variant->id }}]" value="{{ $variant->flavor??'' }}"></td>
                                                 <td><input type="file" class="form-control" name="image[{{$variant->id}}][]" multiple>
                                                    @foreach ($variant->variantImage as $image)
                                                    <div class="image-container position-relative d-inline-block m-2">
                                                        <img src="{{ asset($image->image) }}" alt="" width="50px" height="50px" class="border rounded">
                                                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-image position-absolute top-0 end-0 p-0 d-flex align-items-center justify-content-center" data-id="{{ $image->id }}" style="width: 20px; height: 20px;">
                                                            <span class="text-white fw-bold">×</span>
                                                        </button>
                                                    </div>
                                                @endforeach



                                                </td>
                                                 <td><input type="number" class="form-control" name="stock_quantity[{{ $variant->id }}]" value="{{ $variant->productStock->StockQuantity??0 }}"></td>
                                                 <td>

                                                     <button type="button" class="btn btn-success addRow">+</button>

                                                        <button type="button" class="btn btn-danger removeRow" data-variant_id={{ $variant->id }}>✖</button>

                                                 </td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                         <tfoot>
                                             <tr>
                                                 <td colspan="10" class="text-end">
                                                     <a  class="btn btn-primary variant_update">Variant Update</a>
                                                 </td>
                                             </tr>
                                         </tfoot>
                                     </table>
                                 </div>

                                 </div>
                                 </form>

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
    ///////////////////variant image delete///////////////////
    $(document).on('click','.remove-image',function(){
        let image_id = $(this).data('id');
           console.log(image_id);
          $.ajaxSetup({
            headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
          });
           $.ajax({
            url:"/product/variant/image/delete",
            type:"POST",
            data:{image_id:image_id},
            success:function(response){
                if(response.status == '200'){

                    toastr.success("Image Delete Successfully");
                }
            }
           })

    });
    $(document).on('click','.remove-image',function(){
        $(this).parent().remove();

    });


////////////////////////////////////////variant Update ////////////////////////////////////////

$(document).on("click",".variant_update",function(e){
    e.preventDefault();




    let formdata = new FormData($('#variant_form_submit')[0]);

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url:"/product/variant/update",
                type:"POST",
                data:formdata,
                contentType: false,
                processData:false,
                success:function(res){

                    console.log(res);
                    toastr.success(res.message);
                    $('#variant_form_submit')[0].reset();
                     location.reload();
                }
            });
  });

$(document).on("click", ".addRow", function () {
          let rowCount = $("#productTableBody tr").length;
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
            <td><input type="file" class="form-control" name="image[][]" multiple></td>
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
//////////////////////////////////////////////////////variant Delete ////////////////////////////////////////
    $(document).on('click','.removeRow',function(){
         let variant_id = $(this).data('variant_id');
     
         $.ajaxSetup({
            headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
         });
        $.ajax({
            url:"/product/variant/delete",
            type:"POST",
            data:{variant_id:variant_id},
            success:function(res){
               if(res.status == 200){
                  toastr.success("Variant Delete Successfully");
               }
            }

        });

    });
//////////////////////////////////update product //////////////////////////////////////////////////////
    $(document).on("click", ".update_product", function () {
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
                success:function(res){

                    if(res.status == 200){
                        $('#productForm')[0].reset();
                    toastr.success("Product Updated Successfully");
                 
                    }
               else{
                toastr.error("Something Went Wrong");
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

/////////////////////////////////extra field show in product page///////////////////////

function showExtraField() {
    $.ajax({
        url: "{{ url('get-extra-field/info/product/page/show') }}",
        type: "GET",
        dataType: "json",
        success: function (data) {
            // console.log("Response Data:", data);

            if (data.status === 200) {
                $('.extra_field').empty();
                let extraField = data.extraField;
                console.log(extraField);
                let option = `<option value="" selected disabled>Select Extra Field</option>`;

                extraField.forEach(function (field) {
                    option += `<option value="${field.id}" data-id="${field.id}">${field.field_name}</option>`;
                });

                $('.extra_field').append(option);
            }
        },
        error: function (xhr, status, error) {
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
