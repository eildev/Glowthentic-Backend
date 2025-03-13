<!-- product-area-start -->
<section class="weekly-product-area whight-product grey-bg">
    <div class="container">
        <div class="sections__wrapper white-bg pl-50 pr-50">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="tpsection mb-10">
                        <h4 class="tpsection__title brand-product-title" id="top_trending">Top Trending Products</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 text-center">
                    <div class="tpnavtab__area tp-navtab-style-2">
                        <nav>
                            <div class="nav nav-tabs" role="tablist">
                                <button class="nav-link active" id="nav-all-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all"
                                    aria-selected="true">All</button>
                                @php
                                    $cats = App\Models\Category::where('status', 1)->take(4)->orderBy('id', 'DESC')->get();
                                @endphp
                                @foreach ($cats as $cat)
                                    <button class="nav-link" id="nav-meat-tab" data-bs-toggle="tab"
                                        data-bs-target="#{{ $cat->slug }}" type="button" role="tab"
                                        aria-controls="nav-meat" aria-selected="false">{{ $cat->categoryName }}</button>
                                @endforeach
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tpnavtab__area pb-40">
                        <div class="tab-content" id="nav-tabContent">
                            <!-- All Product here without Condition -->
                            @php
                                $all_product = App\Models\Product::whereHas('varient')->where('status', 1)->take(10)->orderBy('id', 'DESC')->get();
                                // @dd($all_product);
                            @endphp
                            @if ($all_product->count() > 0)
                                <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                                    aria-labelledby="nav-all-tab" tabindex="0">
                                    <div class="tpproduct__arrow p-relative">
                                        <div
                                            class="swiper-container tpproduct-active-3 tpslider-bottom p-relative tpproduct-priority">
                                            <div class="swiper-wrapper">

                                                @foreach ($all_product as $product)
                                                    {{-- @dd($product); --}}
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
                                                                    <span class="text-secondary text-capitalize"
                                                                        style="font-size: 14px">/{{ $product->varient[0]->unit ?? '' }}
                                                                    </span>
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
                                                                            value="{{ $product->id ?? 0 }}"
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
                                            <div class="tpprduct-arrow tpproduct-btn__prv tpproduct-arrow-left-2">
                                                <a href="#"><i class="icon-chevron-left"></i></a>
                                            </div>
                                            <div class="tpprduct-arrow tpproduct-btn__nxt tpproduct-arrow-right-2">
                                                <a href="#"><i class="icon-chevron-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <!-- Category Wise Product here -->




                            @foreach ($cats as $cat)
                                @php
                                    $all_product = App\Models\Product::whereHas('varient')
                                        ->where('status', 1)
                                        ->where('category_id', $cat->id)
                                        ->take(10)
                                        ->orderBy('id', 'DESC')
                                        ->get();
                                    // dd($all_product);
                                @endphp

                                {{-- @dd($cat); --}}
                                <div class="tab-pane fade" id="{{ $cat->slug }}" role="tabpanel"
                                    aria-labelledby="nav-meat-tab" tabindex="0">
                                    <div class="tpproduct__arrow p-relative">
                                        <div
                                            class="swiper-container tpproduct-active-3 tpslider-bottom p-relative tpproduct-priority">
                                            <div class="swiper-wrapper">
                                                @foreach ($all_product as $product)
                                                    {{-- @dd($product->varient[0]->discount); --}}
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
                                                                    <span class="text-secondary text-capitalize"
                                                                        style="font-size: 14px">/{{ $product->varient[0]->unit ?? '' }}
                                                                    </span>
                                                                    @if (!empty($product->varient[0]))
                                                                        @if ($product->varient[0]->discount > 0)
                                                                            <del>৳{{ $product->varient[0]->regular_price ?? '' }}</del>
                                                                        @else
                                                                            <span></span>
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
                                            <div class="tpprduct-arrow tpproduct-btn__prv tpproduct-arrow-left-2">
                                                <a href="#"><i class="icon-chevron-left"></i></a>
                                            </div>
                                            <div class="tpprduct-arrow tpproduct-btn__nxt tpproduct-arrow-right-2">
                                                <a href="#"><i class="icon-chevron-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product-area-end -->
