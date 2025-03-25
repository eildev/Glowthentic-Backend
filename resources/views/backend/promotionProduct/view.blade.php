@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="card border-top border-0 border-3 border-info col-md-12">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <h4 class="text-info">
                        Promotion: <strong>{{ $promotionProduct->first()->coupon->promotion_name ?? 'N/A' }}</strong>
                    </h4>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-info">
                            <tr>
                                <th>Product Name</th>
                                <th>Variant</th>
                                <th>Category Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promotionProduct as $promotionProduct)
                                <tr>
                                    <td>{{ $promotionProduct->product->product_name ?? '--' }}</td>
                                    <td>

                                            @php
                                                $selectedVariants = App\Models\VariantPromotion::where('product_id', $promotionProduct->product_id)
                                                    ->pluck('variant_id')->toArray() ?? [];

                                                $variantNames = optional($promotionProduct->product)->variants // Use optional() to avoid null errors
                                                    ?->whereIn('id', $selectedVariants)
                                                    ->pluck('variant_name')
                                                    ->filter() // Remove null values
                                                    ->implode(', '); // Convert array to a comma-separated string
                                            @endphp
                                            {{ $variantNames ?: '--' }}
                                       

                                    </td>

                                    <td>{{ $promotionProduct->category->categoryName ?? '--' }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection
