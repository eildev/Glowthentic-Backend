@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-5 border-end">
                       
                        @if($product->variantImage && $product->variantImage->whereNull('deleted_at')->first())
                                <img src="{{ asset($product->variantImage->whereNull('deleted_at')->first()->image) }}" class="img-fluid" alt="product-image">
                            @endif


                        <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                            @foreach ($product->variantImage()->whereNull('deleted_at')->get() as $gallery)

                                <div class="col"><img src="{{ asset($gallery->image) }}"
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
                            @php use Illuminate\Support\Str; @endphp
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
                                        <dd class="col-sm-6">{{ $product->productStock[0]->StockQuantity ?? 0 }}</dd>

                                        @if (!empty($product->varient[0]->unit))
                                            <dt class="col-sm-6">Unit</dt>
                                            <dd class="col-sm-6">{{ $product->varient[0]->unit ??''}}</dd>
                                        @endif


                                        <dt class="col-sm-6">Category</dt>
                                        <dd class="col-sm-6">{{ $product->category->categoryName??'' }}</dd>


                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row my-3">
                                        <dt class="col-sm-6">Subcategory</dt>
                                        @php
                                            $subcategory =App\Models\Category::where('id',$product->subcategory_id)->first();
                                        @endphp
                                        {{-- @dd($product->subcategory_id) --}}
                                        <dd class="col-sm-6">{{ $subcategory->categoryName??''}}</dd>

                                        <dt class="col-sm-6">Brand</dt>
                                        <dd class="col-sm-6">{{ $product->brand->BrandName??'' }}</dd>

                                        <dt class="col-sm-6">Model/SKU</dt>
                                        <dd class="col-sm-6">{{ $product->sku ??''}}</dd>

                                        @if (!empty($product->varient[0]->color))
                                            <dt class="col-sm-6">Color</dt>
                                            <dd class="col-sm-6">{{ $product->varient[0]->color??'' }}</dd>
                                        @endif

                                        @if (!empty($product->varient[0]->size))
                                            <dt class="col-sm-6">Size</dt>
                                            <dd class="col-sm-6">{{ $product->varient[0]->size??'' }}</dd>
                                        @endif


                                        <dt class="col-sm-6">Tags#</dt>
                                        <dd class="col-sm-6">
                                            @foreach ($product->product_tags as $tag)
                                            @php
                                                $tag_name = App\Models\TagName::where('id',$tag->tag_id)->first();
                                            @endphp

                                                <span class="badge bg-warning">#{{$tag_name->tagName??'' }}</span>
                                            @endforeach
                                        </dd>
                                    </dl>
                                </div>
                            </div>

                            <p class="card-text fs-6 mb-3"><b> Description:</b>
                                {!! Str::words($product->productdetails->description ?? '', 20, '...') !!}
                            </p>
                            
                            <p class="card-text fs-6 mb-3"><b>Usage Instructions:</b>
                                {!! Str::words($product->productdetails->usage_instruction ?? '', 20, '...') !!}
                            </p>
                            
                            <p class="card-text fs-6"><b>Ingredients:</b>
                                {!! Str::words($product->productdetails->ingredients ?? '', 30, '...') !!}
                            </p>
                            
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
            <h6 class="mb-0 text-uppercase">DataTable Import</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Varianr Name</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Weight</th>
                                    <th>Flavor</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            @php
                                $variants = $product->variants()->orderBy('id', 'desc')->get();
                            @endphp
                            <tbody>
                                @foreach (  $variants as $variant)
                                {{-- @dd($variant->size) --}}
                                <tr>
                                    <td class="fw-bold">{{ $variant->variant_name }}</td>
                                    <td class="text-success fw-semibold">৳{{ number_format($variant->regular_price, 2)??0 }}</td>
                                    <td>{{ $variant->size??''}}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $variant->color??'' }}</span>
                                    </td>
                                    <td>{{ $variant->weight??'' }} kg</td>
                                    <td>{{ $variant->flavor??'' }}</td>
                                    <td>
                                        @foreach ($variant->variantImage as $image)
                                        <img src="{{ asset($image->image) }}" alt="Variant Image" class="img-thumbnail rounded shadow-sm" width="50" height="50">
                                        @endforeach
                                    </td>
                                    <td class="fw-bold text-primary">{{ $variant->productStock->StockQuantity??0 }}</td>
                                    <td>
                                        <span class="badge {{ $variant->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($variant->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>

    <script>
        <script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
    </script>
@endsection
