<!-- product-area-start -->
<div class="weekly-product-area whight-product grey-bg" id="New_Arrivals">
    <div class="container">
        <div class="sections__wrapper white-bg pl-50 pr-50 pb-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="tpnavtab__area tpnavtab__newitem">
                        <nav>
                            <div class="nav tp-nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-arrivals-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-arrivals" type="button" role="tab"
                                    aria-controls="nav-arrivals" aria-selected="true">New Arrivals</button>
                                <button class="nav-link" id="nav-features-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-features" type="button" role="tab"
                                    aria-controls="nav-features" aria-selected="false">Features</button>
                                <button class="nav-link" id="nav-best-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-best" type="button" role="tab" aria-controls="nav-best"
                                    aria-selected="false">Best Rate</button>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tpproduct__all-item">
                        <a href="{{ route('all.feature.product') }}">See All <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="z-index: 1 !important;">
                    <div class="tpnavtab__area pb-40">
                        <div class="tab-content" id="nav-tabContent-tp">
                            {{-- New arrival products  --}}
                            @php
                                $arrival_product = App\Models\Product::whereHas('varient')->where('status', 1)->take(10)->orderBy('id', 'DESC')->get();
                            @endphp
                            @if ($arrival_product->count() > 0)
                                <div class="tab-pane fade show active" id="nav-arrivals" role="tabpanel"
                                    aria-labelledby="nav-arrivals-tab" tabindex="0">
                                    <div class="tpproduct__arrow p-relative">
                                        <div
                                            class="swiper-container tpproduct-active-2 tpslider-bottom p-relative tpproduct-priority">
                                            <div class="swiper-wrapper">
                                                @foreach ($arrival_product as $product)
                                                    <div class="swiper-slide">
                                                        <div class="tpproduct p-relative">
                                                            <div class="tpproduct__thumb p-relative text-center">
                                                                <a
                                                                    href="{{ route('product.details', $product->slug) }}"><img
                                                                        src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                        alt="{{$product->slug}}" ></a>
                                                                <a class="tpproduct__thumb-img"
                                                                    href="{{ route('product.details', $product->slug) }}"><img
                                                                        src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                        alt="{{$product->slug}}" ></a>
                                                                <div class="tpproduct__info bage">
                                                                    @if (!empty($product->varient[0]))
                                                                        @if ($product->varient[0]->discount > 0)
                                                                            <span class="tpproduct__info-discount bage__discount">-{{ $product->varient[0]->discount }}%</span>
                                                                            <span class="tpproduct__info-hot bage__hot">HOT</span>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="tpproduct__shopping">
                                                                    @auth
                                                                        <a class="tpproduct__shopping-wishlist add_whishlist"
                                                                            href="#" value="{{ $product->id }}">
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
                                                                        <a class="tpproduct__shopping-wishlist"
                                                                            href="{{ route('login') }}">
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
                                                                        href="{{ route('product.details', $product->slug) }}">{{ Illuminate\Support\Str::limit($product->product_name, 18) }}</a>
                                                                </h4>
                                                                <div class="tpproduct__rating mb-5">
                                                                    @php
                                                                        $ratingAvg = App\Models\ReviewRating::where('product_id', $product->id)->avg('rating');
                                                                    @endphp
                                                                    @php
                                                                        $last = 0;
                                                                    @endphp
                                                                    @for ($i = 1; $i <= $ratingAvg; $i++)
                                                                        <a href="#"><i class="icon-star"></i></a>
                                                                        @php $last = $i @endphp
                                                                    @endfor
                                                                    @for ($j = $last; $j < 5; $j++)
                                                                        <a href="#"><i
                                                                                class="icon-star_outline1"></i></a>
                                                                    @endfor
                                                                </div>
                                                                <div class="tpproduct__price">

                                                                    <span>৳{{ $product->varient[0]->discount_amount ?? '' }}</span>
                                                                    @if (!empty($product->varient[0]))
                                                                        @if($product->varient[0]->weight == "gm" || $product->varient[0]->weight == "ml")
                                                                            <span class="text-secondary" style="font-size: 14px">/{{ $product->varient[0]->weight ?? '' }} {{ $product->varient[0]->unit ?? '' }}</span>
                                                                        @else
                                                                            <span class="text-secondary" style="font-size: 14px">/{{ $product->varient[0]->unit ?? '' }}</span>
                                                                        @endif
                                                                    @endif
                                                                     <br>
                                                                    @if (!empty($product->varient[0]))
                                                                        @if ($product->varient[0]->discount > 0)
                                                                            <del>৳{{ $product->varient[0]->regular_price ?? '' }}</del>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="tpproduct__hover-text">
                                                                <div
                                                                    class="tpproduct__hover-btn d-flex justify-content-center mb-10">
                                                                    <form method="POST" id="add_to_cart_form">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            value="{{ $product->id }}"
                                                                            name="product_id">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->id ?? 0 }}"
                                                                            name="variant_id">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->discount_amount ?? 0 }}"
                                                                            name="selling_price">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->weight ?? 0 }}"
                                                                            name="weight">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->unit ?? 0 }}"
                                                                            name="unit">
                                                                        <button class="tp-btn-2">Add to
                                                                            cart</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tpproduct-btn">
                                            <div class="tpprduct-arrow tpproduct-btn__prv tpproduct-arrow-left"><a
                                                    href="#"><i class="icon-chevron-left"></i></a></div>
                                            <div class="tpprduct-arrow tpproduct-btn__nxt tpproduct-arrow-right"><a
                                                    href="#"><i class="icon-chevron-right"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- featured products  --}}
                            @php
                                $featured_product = App\Models\Product::whereHas('varient')
                                    ->where('status', 1)
                                    ->where('product_feature', 'like', '%' . 'feature' . '%')
                                    ->take(10)
                                    ->orderBy('id', 'DESC')
                                    ->get();
                            @endphp
                            @if ($featured_product->count() > 0)

                                <div class="tab-pane fade" id="nav-features" role="tabpanel"
                                    aria-labelledby="nav-features-tab" tabindex="0">
                                    <div class="tpproduct__arrow p-relative">
                                        <div
                                            class="swiper-container tpproduct-active-2 tpslider-bottom p-relative tpproduct-priority">
                                            <div class="swiper-wrapper">
                                                @foreach ($featured_product as $product)
                                                    {{-- @dd($products); --}}
                                                    <div class="swiper-slide">
                                                        <div class="tpproduct p-relative">
                                                            <div class="tpproduct__thumb p-relative text-center">
                                                                <a
                                                                    href="{{ route('product.details', $product->slug) }}"><img
                                                                        src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                        alt="{{$product->slug}}" ></a>
                                                                <a class="tpproduct__thumb-img"
                                                                    href="{{ route('product.details', $product->slug) }}"><img
                                                                        src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                        alt="{{$product->slug}}" ></a>
                                                                <div class="tpproduct__info bage">
                                                                    @if (!empty($product->varient[0]))
                                                                        @if ($product->varient[0]->discount > 0)
                                                                            <span
                                                                                class="tpproduct__info-discount bage__discount">-{{ $product->varient[0]->discount }}%</span>
                                                                        @else
                                                                            <span></span>
                                                                        @endif
                                                                        @if ($product->varient[0]->discount > 0)
                                                                            <span
                                                                                class="tpproduct__info-hot bage__hot">HOT</span>
                                                                        @else
                                                                            <span></span>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="tpproduct__shopping">
                                                                    @auth
                                                                        <a class="tpproduct__shopping-wishlist add_whishlist"
                                                                            href="#" value="{{ $product->id }}">
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
                                                                        <a class="tpproduct__shopping-wishlist"
                                                                            href="{{ route('login') }}">
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
                                                                        href="{{ route('product.details', $product->slug) }}">{{ Illuminate\Support\Str::limit($product->product_name, 18) }}</a>
                                                                </h4>
                                                                <div class="tpproduct__rating mb-5">
                                                                    @php
                                                                        $ratingAvg = App\Models\ReviewRating::where('product_id', $product->id)->avg('rating');
                                                                    @endphp
                                                                    @php
                                                                        $last = 0;
                                                                    @endphp
                                                                    @for ($i = 1; $i <= $ratingAvg; $i++)
                                                                        <a href="#"><i
                                                                                class="icon-star"></i></a>
                                                                        @php $last = $i @endphp
                                                                    @endfor
                                                                    @for ($j = $last; $j < 5; $j++)
                                                                        <a href="#"><i
                                                                                class="icon-star_outline1"></i></a>
                                                                    @endfor
                                                                </div>
                                                                <div class="tpproduct__price">
                                                                    <span>৳{{ $product->varient[0]->discount_amount ?? '' }}</span>
                                                                    <span class="text-secondary"
                                                                        style="font-size: 14px">/{{ $product->varient[0]->unit ?? '' }}
                                                                    </span>
                                                                    <br>
                                                                    @if (!empty($product->varient[0]))
                                                                        @if ($product->varient[0]->discount > 0)
                                                                            <del>৳{{ $product->varient[0]->regular_price ?? '' }}</del>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="tpproduct__hover-text">
                                                                <div
                                                                    class="tpproduct__hover-btn d-flex justify-content-center mb-10">
                                                                    <form method="POST" id="add_to_cart_form">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            value="{{ $product->id }}"
                                                                            name="product_id">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->id ?? 0 }}"
                                                                            name="variant_id">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->discount_amount ?? 0 }}"
                                                                            name="selling_price">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->weight ?? 0 }}"
                                                                            name="weight">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->unit ?? 0 }}"
                                                                            name="unit">
                                                                        <button class="tp-btn-2">Add to
                                                                            cart</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tpproduct-btn">
                                            <div class="tpprduct-arrow tpproduct-btn__prv tpproduct-arrow-left"><a
                                                    href="#"><i class="icon-chevron-left"></i></a></div>
                                            <div class="tpprduct-arrow tpproduct-btn__nxt tpproduct-arrow-right"><a
                                                    href="#"><i class="icon-chevron-right"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Best Selling  --}}
                            @php
                                $best_selling = App\Models\Product::whereHas('varient')
                                    ->where('status', 1)
                                    ->where('product_feature', 'like', '%' . 'best-rate' . '%')
                                    ->take(10)
                                    ->orderBy('id', 'DESC')
                                    ->get();
                            @endphp
                            @if ($best_selling->count() > 0)
                                <div class="tab-pane fade" id="nav-best" role="tabpanel"
                                    aria-labelledby="nav-best-tab" tabindex="0">
                                    <div class="tpproduct__arrow p-relative">
                                        <div
                                            class="swiper-container tpproduct-active-2 tpslider-bottom p-relative tpproduct-priority">
                                            <div class="swiper-wrapper">
                                                @foreach ($best_selling as $product)
                                                    <div class="swiper-slide">
                                                        <div class="tpproduct p-relative">
                                                            <div class="tpproduct__thumb p-relative text-center">
                                                                <a
                                                                    href="{{ route('product.details', $product->slug) }}"><img
                                                                        src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                        alt="{{$product->slug}}" ></a>
                                                                <a class="tpproduct__thumb-img"
                                                                    href="{{ route('product.details', $product->slug) }}"><img
                                                                        src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                        alt="{{$product->slug}}" ></a>
                                                                <div class="tpproduct__info bage">
                                                                    @if (!empty($product->varient[0]))
                                                                        @if ($product->varient[0]->discount > 0)
                                                                            <span
                                                                                class="tpproduct__info-discount bage__discount">-{{ $product->varient[0]->discount }}%</span>
                                                                        @endif
                                                                        @if ($product->varient[0]->discount > 0)
                                                                            <span
                                                                                class="tpproduct__info-hot bage__hot">HOT</span>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="tpproduct__shopping">
                                                                    @auth
                                                                        <a class="tpproduct__shopping-wishlist add_whishlist"
                                                                            href="#" value="{{ $product->id }}">
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
                                                                        <a class="tpproduct__shopping-wishlist"
                                                                            href="{{ route('login') }}">
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
                                                                        href="{{ route('product.details', $product->slug) }}">{{ Illuminate\Support\Str::limit($product->product_name, 18) }}</a>
                                                                </h4>
                                                                <div class="tpproduct__rating mb-5">
                                                                    @php
                                                                        $ratingAvg = App\Models\ReviewRating::where('product_id', $product->id)->avg('rating');
                                                                    @endphp
                                                                    @php
                                                                        $last = 0;
                                                                    @endphp
                                                                    @for ($i = 1; $i <= $ratingAvg; $i++)
                                                                        <a href="#"><i
                                                                                class="icon-star"></i></a>
                                                                        @php $last = $i @endphp
                                                                    @endfor
                                                                    @for ($j = $last; $j < 5; $j++)
                                                                        <a href="#"><i
                                                                                class="icon-star_outline1"></i></a>
                                                                    @endfor
                                                                </div>
                                                                <div class="tpproduct__price">

                                                                    <span>৳{{ $product->varient[0]->discount_amount ?? '' }}</span>
                                                                    <span class="text-secondary"
                                                                        style="font-size: 14px">/{{ $product->varient[0]->unit ?? '' }}
                                                                    </span>
                                                                    <br>
                                                                    @if (!empty($product->varient[0]))
                                                                        @if ($product->varient[0]->discount > 0)
                                                                            <del>৳{{ $product->varient[0]->regular_price ?? '' }}</del>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="tpproduct__hover-text">
                                                                <div
                                                                    class="tpproduct__hover-btn d-flex justify-content-center mb-10">
                                                                    <form method="POST" id="add_to_cart_form">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            value="{{ $product->id }}"
                                                                            name="product_id">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->id ?? 0 }}"
                                                                            name="variant_id">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->discount_amount ?? 0 }}"
                                                                            name="selling_price">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->weight ?? 0 }}"
                                                                            name="weight">
                                                                        <input type="hidden"
                                                                            value="{{ $product->varient[0]->unit ?? 0 }}"
                                                                            name="unit">
                                                                        <button class="tp-btn-2">Add to
                                                                            Cart</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tpproduct-btn">
                                            <div class="tpprduct-arrow tpproduct-btn__prv tpproduct-arrow-left"><a
                                                    href="#"><i class="icon-chevron-left"></i></a></div>
                                            <div class="tpprduct-arrow tpproduct-btn__nxt tpproduct-arrow-right">
                                                <a href="#"><i class="icon-chevron-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- product-area-end -->
