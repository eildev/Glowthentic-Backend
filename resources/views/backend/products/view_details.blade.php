@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-5 border-end">
                        <img src="{{ asset('/uploads/products/' . $product->product_image) }}" class="img-fluid"
                            alt="product-image">
                        <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                            @foreach ($product->gallary as $gallery)
                                <div class="col"><img src="{{ asset('uploads/products/gallery/' . $gallery->image) }}"
                                        width="70" class="border rounded cursor-pointer" alt=""></div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->product_name }}</h4>
                            @php
                                $features = explode(',', $product->product_feature);
                            @endphp
                            @foreach ($features as $feature)
                                <span class="badge bg-info text-capitalize">{{ $feature }}</span>
                            @endforeach

                            {{-- <div class="d-flex gap-3 py-3">
                                <div class="cursor-pointer">
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star col-sm-6text-secondary'></i>
                                </div>
                                <div>142 reviews</div>
                                <div class="text-success"><i class='bx bxs-cart-alt align-middle'></i> 134 orders</div>
                            </div> --}}
                            {{-- <div class="mb-3">
                                <span class="price h4">${{ $product->varient[0]->discount_amount }}</span>
                                <span class="text-muted">/per {{ $product->varient[0]->unit }}</span>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-6">
                                    <dl class="row my-3">
                                        <dt class="col-sm-6">Regular Price</dt>
                                        <dd class="col-sm-6">৳ {{ $product->varient[0]->regular_price ?? 0 }}</dd>

                                        <dt class="col-sm-6">Discount</dt>
                                        <dd class="col-sm-6">{{ $product->varient[0]->discount ?? 0 }}%</dd>

                                        <dt class="col-sm-6">Discount Amount</dt>
                                        <dd class="col-sm-6">৳ {{ $product->varient[0]->discount_amount ?? 0 }}</dd>

                                        <dt class="col-sm-6">Stock Quantity</dt>
                                        <dd class="col-sm-6">{{ $product->varient[0]->stock_quantity ?? 0 }}</dd>

                                        @if (!empty($product->varient[0]->unit))
                                            <dt class="col-sm-6">Unit</dt>
                                            <dd class="col-sm-6">{{ $product->varient[0]->unit }}</dd>
                                        @endif


                                        <dt class="col-sm-6">Category</dt>
                                        <dd class="col-sm-6">{{ $product->category->categoryName }}</dd>


                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row my-3">
                                        <dt class="col-sm-6">Subcategory</dt>
                                        <dd class="col-sm-6">{{ $product->subcategory->subcategoryName }}</dd>

                                        <dt class="col-sm-6">Brand</dt>
                                        <dd class="col-sm-6">{{ $product->brand->BrandName }}</dd>

                                        <dt class="col-sm-6">Model/SKU</dt>
                                        <dd class="col-sm-6">{{ $product->sku }}</dd>

                                        @if (!empty($product->varient[0]->color))
                                            <dt class="col-sm-6">Color</dt>
                                            <dd class="col-sm-6">{{ $product->varient[0]->color }}</dd>
                                        @endif

                                        @if (!empty($product->varient[0]->size))
                                            <dt class="col-sm-6">Size</dt>
                                            <dd class="col-sm-6">{{ $product->varient[0]->size }}</dd>
                                        @endif

                                        @php
                                            $tags = explode(',', $product->tags);
                                        @endphp
                                        <dt class="col-sm-6">Tags#</dt>
                                        <dd class="col-sm-6">
                                            @foreach ($tags as $tag)
                                                <span class="badge bg-warning">#{{ $tag }}</span>
                                            @endforeach
                                        </dd>
                                    </dl>
                                </div>
                            </div>

                            <p class="card-text fs-6 mb-3"><b>Short Description:
                                </b>{{ $product->short_desc }}</p>
                            <p class="card-text fs-6"><b>Long Description:
                                </b>{{ $product->long_desc }}</p>
                            <hr>

                            <div class="d-flex gap-3 mt-3">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary"> <span
                                        class="text">Edit</span> <i class='bx bx-edit'></i></a>
                                <a href="{{ route('product.delete', $product->id) }}" class="btn btn-outline-danger"
                                    id="delete"><span class="text">Delete</span>
                                    <i class='bx bx-trash'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
