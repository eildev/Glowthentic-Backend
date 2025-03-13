<section class="product-area whight-product pt-75 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="tpdescription__product-title mb-20">Related Products</h5>
            </div>
        </div>

        @php
            $brand = App\Models\Brand::where('BrandName', 'like', '%' . 'Local' . '%')->first();
            $products = App\Models\Product::whereHas('varient')
                ->where('brand_id', $brand->id)
                ->take(10)
                ->orderBy('id', 'ASC')
                ->get();
        @endphp
        <div class="tpproduct__arrow double-product p-relative">
            <div class="swiper-container tpproduct-active tpslider-bottom p-relative">
                <div class="swiper-wrapper">
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <div class="swiper-slide">
                                <div class="tpproduct p-relative">
                                    <div class="tpproduct__thumb p-relative text-center">
                                        <a href="{{ route('product.details', $product->slug) }}"><img
                                                src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                alt=""></a>
                                        <a class="tpproduct__thumb-img"
                                            href="{{ route('product.details', $product->slug) }}"><img
                                                src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                alt=""></a>
                                        <div class="tpproduct__info bage">
                                            @if ($product->varient[0]->discount > 0)
                                                <span
                                                    class="tpproduct__info-discount bage__discount">-{{ $product->varient[0]->discount }}%</span>
                                            @endif
                                            @if ($product->varient[0]->discount > 0)
                                                <span class="tpproduct__info-hot bage__hot">HOT</span>
                                            @endif
                                        </div>
                                        <div class="tpproduct__shopping">
                                            @auth
                                                <a class="tpproduct__shopping-wishlist add_whishlist" href="#"
                                                    value="{{ $product->id }}">
                                                    <!-- <i class="icon-heart icons"></i> -->
                                                    @auth
                                                        @php
                                                            $loved = App\Models\WishList::where('user_id', Auth::user()->id)
                                                                ->where('product_id', $product->id)
                                                                ->first();
                                                        @endphp
                                                    @endauth
                                                    <i style="color: {{ !empty($loved->loved) ? 'red' : '' }}"
                                                        class="fas fa-heart icons"></i>
                                                </a>
                                            @else
                                                <a class="tpproduct__shopping-wishlist" href="{{ route('login') }}">
                                                    <i class="fas fa-heart icons"></i>
                                                </a>
                                            @endauth
                                            <a class="tpproduct__shopping-cart"
                                                href="{{ route('product.details', $product->slug) }}">
                                                <i class="icon-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="tpproduct__content">
                                        <span class="tpproduct__content-weight">
                                            <a
                                                href="{{ route('category.wise.product', $product->category->slug) }}">{{ $product->category->categoryName }}</a>
                                        </span>
                                        <h4 class="tpproduct__title">
                                            <a
                                                href="{{ route('product.details', $product->slug) }}">{{ $product->product_name }}</a>
                                        </h4>
                                        <div class="tpproduct__rating mb-5">
                                            @php
                                                $indivitualReviews = App\Models\ReviewRating::where('product_id', $product->id)->get();
                                                $indivitualRatingAvg = App\Models\ReviewRating::where('product_id', $product->id)->avg('rating');
                                            @endphp
                                            @php
                                                $last = 0;
                                            @endphp
                                            @for ($i = 1; $i <= $indivitualRatingAvg; $i++)
                                                <a href="#"><i class="icon-star"></i></a>
                                                @php $last = $i @endphp
                                            @endfor
                                            @for ($j = $last; $j < 5; $j++)
                                                <a href="#"><i class="icon-star_outline1"></i></a>
                                            @endfor
                                            ({{ $indivitualReviews->count() }})
                                        </div>
                                        <div class="tpproduct__price">

                                            <span>৳{{ $product->varient[0]->discount_amount ?? '' }}</span>
                                            @if ($product->varient[0]->discount > 0)
                                                <del>৳{{ $product->varient[0]->regular_price ?? '' }}</del>
                                            @endif
                                            <span>/{{ $product->varient[0]->unit }}</span>
                                        </div>
                                    </div>
                                    <div class="tpproduct__hover-text">
                                        <div class="tpproduct__hover-btn d-flex justify-content-center mb-10">
                                            <form method="POST" id="add_to_cart_form">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <input type="hidden" value="{{ $product->varient[0]->id }}"
                                                    name="variant_id">
                                                <input type="hidden"
                                                    value="{{ $product->varient[0]->discount_amount }}"name="selling_price">
                                                <input type="hidden" value="{{ $product->varient[0]->weight }}"
                                                    name="weight">
                                                <input type="hidden" value="{{ $product->varient[0]->unit }}"
                                                    name="unit">
                                                <button class="tp-btn-2">Add to cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
