@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-5 border-end">
                        <img src="{{ asset('/uploads/products/' . $purchase->product->product_image) }}" class="img-fluid"
                            alt="product-image">
                        <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                            @foreach ($purchase->product->gallary as $gallery)
                                <div class="col"><img src="{{ asset('uploads/products/gallery/' . $gallery->image) }}"
                                        width="70" class="border rounded cursor-pointer" alt=""></div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h4 class="card-title">{{ $purchase->product->product_name }}</h4>
                            @php
                                $features = explode(',', $purchase->product->product_feature);
                                $ratings = App\Models\ReviewRating::where('product_id', $purchase->product->id)->avg(
                                    'rating',
                                );
                                $last = 0;
                            @endphp
                            @foreach ($features as $feature)
                                <span class="badge bg-info text-capitalize">{{ $feature }}</span>
                            @endforeach
                            <div class="d-flex gap-3 py-3">
                                <div class="cursor-pointer">
                                    @for ($i = 1; $i <= $ratings; $i++)
                                        <i class='bx bxs-star text-warning'></i>
                                        @php $last = $i @endphp
                                    @endfor
                                    @for ($j = $last; $j < 5; $j++)
                                        <i class='bx bxs-star col-sm-6text-secondary'></i>
                                    @endfor
                                </div>
                                {{-- <div>{{ $ratings->count() ?? 0 }} reviews</div> --}}
                            </div>
                            <div class="mb-3">
                                <span class="price h4">${{ $purchase->product->varient[0]->discount_amount ?? 0 }}</span>
                                <span class="text-muted">/{{ $purchase->product->varient[0]->unit ?? 0 }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="price h4">Purchase Details</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <dl class="row my-3">
                                        {{-- <dt class="col-sm-6">Company Name</dt>
                                        <dd class="col-sm-6">৳ {{ $purchase->company->company_name ?? '' }}</dd> --}}

                                        <dt class="col-sm-6">Purchase Date</dt>
                                        <dd class="col-sm-6">{{ $purchase->purchase_date ?? '' }}</dd>

                                        <dt class="col-sm-6">Quantity</dt>
                                        <dd class="col-sm-6">{{ $purchase->quantity ?? 0 }}</dd>

                                        <dt class="col-sm-6">Unit Price</dt>
                                        <dd class="col-sm-6">৳ {{ $purchase->unit_price ?? 0 }}</dd>

                                        <dt class="col-sm-6">Total Price</dt>
                                        <dd class="col-sm-6">{{ $purchase->total_price ?? 0 }}</dd>

                                        <dt class="col-sm-6">Vehicle Cost</dt>
                                        <dd class="col-sm-6">{{ $purchase->vehicle_cost ?? 0 }}</dd>

                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row my-3">

                                        <dt class="col-sm-6">Other Cost</dt>
                                        <dd class="col-sm-6">{{ $purchase->other_cost ?? 0 }}</dd>
                                        <dt class="col-sm-6">Grand Total</dt>
                                        <dd class="col-sm-6">{{ $purchase->grand_total ?? 0 }}</dd>
                                        <dt class="col-sm-6">Payment Method</dt>
                                        <dd class="col-sm-6">৳ {{ $purchase->payment_method ?? '' }}</dd>

                                        <dt class="col-sm-6">Payable Amount</dt>
                                        <dd class="col-sm-6">{{ $purchase->payable_amount ?? '' }}</dd>

                                        <dt class="col-sm-6">Total Due</dt>
                                        <dd class="col-sm-6">{{ $purchase->due ?? 0 }}</dd>

                                    </dl>
                                </div>

                            </div>
                            <div class="mb-3">
                                <span class="price h4">Product Details</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <dl class="row my-3">
                                        <dt class="col-sm-6">Regular Price</dt>
                                        <dd class="col-sm-6">৳ {{ $purchase->product->varient[0]->regular_price ?? 0 }}
                                        </dd>

                                        <dt class="col-sm-6">Discount</dt>
                                        <dd class="col-sm-6">{{ $purchase->product->varient[0]->discount ?? 0 }}%</dd>

                                        <dt class="col-sm-6">Discount Amount</dt>
                                        <dd class="col-sm-6">৳ {{ $purchase->product->varient[0]->discount_amount ?? 0 }}
                                        </dd>

                                        <dt class="col-sm-6">Stock Quantity</dt>
                                        <dd class="col-sm-6">{{ $purchase->product->varient[0]->stock_quantity ?? 0 }}</dd>

                                        @if (!empty($purchase->varient[0]->unit))
                                            <dt class="col-sm-6">Unit</dt>
                                            <dd class="col-sm-6">{{ $purchase->product->varient[0]->unit ?? '' }}</dd>
                                        @endif


                                        <dt class="col-sm-6">Category</dt>
                                        <dd class="col-sm-6">{{ $purchase->product->category->categoryName ?? '' }}</dd>


                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row my-3">
                                        <dt class="col-sm-6">Subcategory</dt>
                                        <dd class="col-sm-6">{{ $purchase->product->subcategory->subcategoryName ?? '' }}
                                        </dd>

                                        <dt class="col-sm-6">Brand</dt>
                                        <dd class="col-sm-6">{{ $purchase->product->brand->BrandName ?? '' }}</dd>

                                        <dt class="col-sm-6">Model/SKU</dt>
                                        <dd class="col-sm-6">{{ $purchase->product->sku ?? '' }}</dd>

                                        @if (!empty($product->varient[0]->color))
                                            <dt class="col-sm-6">Color</dt>
                                            <dd class="col-sm-6">{{ $purchase->product->varient[0]->color ?? '' }}</dd>
                                        @endif

                                        @if (!empty($product->varient[0]->size))
                                            <dt class="col-sm-6">Size</dt>
                                            <dd class="col-sm-6">{{ $purchase->product->varient[0]->size ?? '' }}</dd>
                                        @endif

                                        @php
                                            $tags = explode(',', $purchase->product->tags);
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
                                </b>{{ $purchase->product->short_desc ?? '' }}</p>
                            <hr>

                            <div class="d-flex gap-3 mt-3">
                                <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-primary"> <span
                                        class="text">Edit</span> <i class='bx bx-edit'></i></a>
                                <a href="{{ route('purchase.delete', $purchase->id) }}" class="btn btn-outline-danger"
                                    id="delete"><span class="text">Delete</span>
                                    <i class='bx bx-trash'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                {{-- <div class="row align-items-center my-5">
                    <div class="col-12">
                        <div class="card px-2 py-5 rounded-md">
                            <div class="card-title">
                                <h5 class="mb-0 text-info text-center">Manage Variants</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <td>SI</td>
                                                <th>Regular Price</th>
                                                <th>Discount</th>
                                                <th>Discount Price</th>
                                                <th>Stock Quantity</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Unit</th>
                                                <th>Barcode</th>
                                                <th>Manufacture Date</th>
                                                <th>Expire Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $variants = $product->varient;
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($variants as $variant)
                                                <tr>
                                                    <td>{{ $serialNumber++ }}</td>
                                                    <td>{{ $variant->regular_price }}</td>
                                                    <td>{{ $variant->discount }}</td>
                                                    <td>{{ $variant->discount_amount }}</td>
                                                    <td>{{ $variant->stock_quantity }}</td>
                                                    <td>{{ $variant->color }}</td>
                                                    <td>{{ $variant->size }}</td>
                                                    <td>{{ $variant->unit }}</td>
                                                    <td>{{ $variant->barcode }}</td>
                                                    <td>{{ $variant->manufacture_date }}</td>
                                                    <td>{{ $variant->expire_date }}</td>
                                                    <td>
                                                        <a href="{{ route('variant.delete', $variant->id) }}"
                                                            id="delete" class="btn-sm btn-danger">
                                                            Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <hr />
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
