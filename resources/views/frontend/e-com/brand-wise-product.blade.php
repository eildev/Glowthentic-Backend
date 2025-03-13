@extends('frontend.master')
@section('maincontent')
    <!-- breadcrumb-area-start -->
    <div class="breadcrumb__area grey-bg pt-5 pb-5">
        <div class="container" style="margin-top:80px">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-breadcrumb__content">
                        <div class="tp-breadcrumb__list">
                            <span class="tp-breadcrumb__active"><a href="{{ route('home') }}">Home</a></span>
                            <span class="dvdr">/</span>
                            <span>{{ $brand->BrandName }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- shop-area-start -->
    <section class="shop-area-start grey-bg pb-200">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="tpshop__details">
                        <div class="tpshop__category">
                            <div class="swiper-container inner-category-two">
                                <div class="category__item mb-30">
                                    <div class="category__thumb fix mb-15">
                                        <a href="{{ route('brand.wise.product', $brand->slug) }}"><img
                                                src="{{ asset('uploads/brands/' . $brand->image) }}"
                                                alt="category-thumb"></a>
                                    </div>
                                    <div class="category__content">
                                        <h5 class="category__title"><a
                                                href="{{ route('brand.wise.product', $brand->slug) }}">{{ $brand->BrandName }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="swiper-wrapper">
                                    @php
                                        $brands = App\Models\Brand::all();
                                        $allProducts = App\Models\Product::whereHas('varient')
                                            ->where('brand_id', $brand->id)
                                            ->paginate(12);
                                        // dd($allProducts->all());
                                    @endphp
                                    @foreach ($brands as $brand)
                                        <div class="swiper-slide">
                                            <div class="category__item mb-30">
                                                <div class="category__thumb fix mb-15">
                                                    <a href="{{ route('brand.wise.product', $brand->slug) }}"><img
                                                            src="{{ asset('uploads/brands/' . $brand->image) }}"
                                                            alt="category-thumb"></a>
                                                </div>
                                                <div class="category__content">
                                                    <h5 class="category__title"><a
                                                            href="{{ route('brand.wise.product', $brand->slug) }}">{{ $brand->BrandName }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="product__filter-content mb-30">
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="product__item-count">
                                        <span>Showing 1 - 18 of 40 Products</span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div
                                        class="tpproductnav tpnavbar product-filter-nav d-flex align-items-center justify-content-center">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link" id="nav-all-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-all" type="button" role="tab"
                                                    aria-controls="nav-all" aria-selected="false">
                                                    <i>
                                                        <svg width="22" height="16" viewBox="0 0 22 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2 4C3.10457 4 4 3.10457 4 2C4 0.89543 3.10457 0 2 0C0.89543 0 0 0.89543 0 2C0 3.10457 0.89543 4 2 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M2 10C3.10457 10 4 9.10457 4 8C4 6.89543 3.10457 6 2 6C0.89543 6 0 6.89543 0 8C0 9.10457 0.89543 10 2 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M2 16C3.10457 16 4 15.1046 4 14C4 12.8954 3.10457 12 2 12C0.89543 12 0 12.8954 0 14C0 15.1046 0.89543 16 2 16Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M8 4C9.10457 4 10 3.10457 10 2C10 0.89543 9.10457 0 8 0C6.89543 0 6 0.89543 6 2C6 3.10457 6.89543 4 8 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M8 16C9.10457 16 10 15.1046 10 14C10 12.8954 9.10457 12 8 12C6.89543 12 6 12.8954 6 14C6 15.1046 6.89543 16 8 16Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M14 4C15.1046 4 16 3.10457 16 2C16 0.89543 15.1046 0 14 0C12.8954 0 12 0.89543 12 2C12 3.10457 12.8954 4 14 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M14 10C15.1046 10 16 9.10457 16 8C16 6.89543 15.1046 6 14 6C12.8954 6 12 6.89543 12 8C12 9.10457 12.8954 10 14 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M14 16C15.1046 16 16 15.1046 16 14C16 12.8954 15.1046 12 14 12C12.8954 12 12 12.8954 12 14C12 15.1046 12.8954 16 14 16Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20 4C21.1046 4 22 3.10457 22 2C22 0.89543 21.1046 0 20 0C18.8954 0 18 0.89543 18 2C18 3.10457 18.8954 4 20 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20 10C21.1046 10 22 9.10457 22 8C22 6.89543 21.1046 6 20 6C18.8954 6 18 6.89543 18 8C18 9.10457 18.8954 10 20 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20 16C21.1046 16 22 15.1046 22 14C22 12.8954 21.1046 12 20 12C18.8954 12 18 12.8954 18 14C18 15.1046 18.8954 16 20 16Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </i>
                                                </button>
                                                <button class="nav-link active" id="nav-popular-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-popular" type="button" role="tab"
                                                    aria-controls="nav-popular" aria-selected="true">
                                                    <i>
                                                        <svg width="28" height="16" viewBox="0 0 28 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2 4C3.10457 4 4 3.10457 4 2C4 0.89543 3.10457 0 2 0C0.89543 0 0 0.89543 0 2C0 3.10457 0.89543 4 2 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M2 10C3.10457 10 4 9.10457 4 8C4 6.89543 3.10457 6 2 6C0.89543 6 0 6.89543 0 8C0 9.10457 0.89543 10 2 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M2 16C3.10457 16 4 15.1046 4 14C4 12.8954 3.10457 12 2 12C0.89543 12 0 12.8954 0 14C0 15.1046 0.89543 16 2 16Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M8 4C9.10457 4 10 3.10457 10 2C10 0.89543 9.10457 0 8 0C6.89543 0 6 0.89543 6 2C6 3.10457 6.89543 4 8 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M8 16C9.10457 16 10 15.1046 10 14C10 12.8954 9.10457 12 8 12C6.89543 12 6 12.8954 6 14C6 15.1046 6.89543 16 8 16Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M14 4C15.1046 4 16 3.10457 16 2C16 0.89543 15.1046 0 14 0C12.8954 0 12 0.89543 12 2C12 3.10457 12.8954 4 14 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M14 10C15.1046 10 16 9.10457 16 8C16 6.89543 15.1046 6 14 6C12.8954 6 12 6.89543 12 8C12 9.10457 12.8954 10 14 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M14 16C15.1046 16 16 15.1046 16 14C16 12.8954 15.1046 12 14 12C12.8954 12 12 12.8954 12 14C12 15.1046 12.8954 16 14 16Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20 4C21.1046 4 22 3.10457 22 2C22 0.89543 21.1046 0 20 0C18.8954 0 18 0.89543 18 2C18 3.10457 18.8954 4 20 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20 10C21.1046 10 22 9.10457 22 8C22 6.89543 21.1046 6 20 6C18.8954 6 18 6.89543 18 8C18 9.10457 18.8954 10 20 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20 16C21.1046 16 22 15.1046 22 14C22 12.8954 21.1046 12 20 12C18.8954 12 18 12.8954 18 14C18 15.1046 18.8954 16 20 16Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M26 4C27.1046 4 28 3.10457 28 2C28 0.89543 27.1046 0 26 0C24.8954 0 24 0.89543 24 2C24 3.10457 24.8954 4 26 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M26 10C27.1046 10 28 9.10457 28 8C28 6.89543 27.1046 6 26 6C24.8954 6 24 6.89543 24 8C24 9.10457 24.8954 10 26 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M26 16C27.1046 16 28 15.1046 28 14C28 12.8954 27.1046 12 26 12C24.8954 12 24 12.8954 24 14C24 15.1046 24.8954 16 26 16Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </i>
                                                </button>
                                                <button class="nav-link" id="nav-product-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-product" type="button" role="tab"
                                                    aria-controls="nav-product" aria-selected="false">
                                                    <i>
                                                        <svg width="20" height="16" viewBox="0 0 20 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2 4C3.10457 4 4 3.10457 4 2C4 0.89543 3.10457 0 2 0C0.89543 0 0 0.89543 0 2C0 3.10457 0.89543 4 2 4Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M2 10C3.10457 10 4 9.10457 4 8C4 6.89543 3.10457 6 2 6C0.89543 6 0 6.89543 0 8C0 9.10457 0.89543 10 2 10Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M2 16C3.10457 16 4 15.1046 4 14C4 12.8954 3.10457 12 2 12C0.89543 12 0 12.8954 0 14C0 15.1046 0.89543 16 2 16Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20 2C20 2.552 19.553 3 19 3H7C6.448 3 6 2.552 6 2C6 1.448 6.448 1 7 1H19C19.553 1 20 1.447 20 2Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20 8C20 8.552 19.553 9 19 9H7C6.448 9 6 8.552 6 8C6 7.448 6.448 7 7 7H19C19.553 7 20 7.447 20 8Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20 14C20 14.552 19.553 15 19 15H7C6.448 15 6 14.552 6 14C6 13.447 6.448 13 7 13H19C19.553 13 20 13.447 20 14Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </i>
                                                </button>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                                @if ($brands->count() > 0)
                                    <div class="col-sm-4">
                                        <div class="product__navtabs d-flex justify-content-end align-items-center">
                                            <div class="tp-shop-selector">

                                                {{-- <select style="display: none; height: 50px;">
                                                <option>All Brands</option>
                                                @foreach ($brands as $brand)
                                                <option>{{ $brand->BrandName }}</option>
                                                @endforeach
                                            </select> --}}

                                                <style>
                                                    /* width */
                                                    .custom_scroll::-webkit-scrollbar {
                                                        width: 10px;
                                                    }

                                                    /* Track */
                                                    .custom_scroll::-webkit-scrollbar-track {
                                                        box-shadow: inset 0 0 5px grey;
                                                        border-radius: 10px;
                                                    }

                                                    /* Handle */
                                                    .custom_scroll::-webkit-scrollbar-thumb {
                                                        background: #c8a3cc;
                                                        border-radius: 10px;
                                                    }

                                                    /* Handle on hover */
                                                    .custom_scroll::-webkit-scrollbar-thumb:hover {
                                                        background: #b30000;
                                                    }

                                                    .sorting_bar {
                                                        /* margin-right: -20px; */
                                                    }
                                                </style>
                                                <div class="nice-select sorting_bar"  style="width: 200px;" tabindex="0">
                                                    <span class="current">All Brands</span>
                                                    <ul class="list custom_scroll"
                                                        style="height: 200px; overflow-y:scroll; border-radius: 10px; margin-top: 15px !important;">
                                                        @foreach ($brands as $brand)
                                                            <a href="{{ route('brand.wise.product', $brand->slug) }}">
                                                                <li data-value="Show 12" class="option selected">
                                                                    {{ $brand->BrandName }}

                                                                </li>
                                                            </a>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                @if ($allProducts->count() > 0)
                                    <div
                                        class="row row-cols-xxl-4 row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 tpproduct__shop-item">
                                        @foreach ($allProducts as $product)
                                            <div class="col">
                                                <div class="tpproduct p-relative mb-20">
                                                    <div class="tpproduct__thumb p-relative text-center">
                                                        <a href="{{ route('product.details', $product->slug) }}"><img
                                                                src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                alt="Product Image"></a>
                                                        <a class="tpproduct__thumb-img"
                                                            href="{{ route('product.details', $product->slug) }}"><img
                                                                src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                alt="Products Image"></a>
                                                        <div class="tpproduct__info bage">
                                                            @if (!empty($product->varient[0]))
                                                                @if ($product->varient[0]->discount > 0)
                                                                    <span
                                                                        class="tpproduct__info-discount bage__discount">-{{ $product->varient[0]->discount ?? '' }}%</span>
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
                                                                href="{{ route('product.details', $product->slug) }}"><i
                                                                    class="icon-eye"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="tpproduct__content">
                                                        <span class="tpproduct__content-weight">
                                                            <a
                                                                href="{{ route('category.wise.product', $product->category->slug) }}">{{ $product->category->categoryName }}</a>,
                                                            <a
                                                                href="{{ route('subcategory.wise.product', $product->subcategory->slug) }}">{{ $product->subcategory->subcategoryName }}</a>
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
                                                                <a href="#"><i class="icon-star_outline1"></i></a>
                                                            @endfor
                                                        </div>
                                                        <div class="tpproduct__price">
                                                            <span>৳{{ $product->varient[0]->discount_amount ?? '' }}</span>
                                                            <span class="text-secondary text-capitalize"
                                                                style="font-size: 14px">/{{ $product->varient[0]->unit ?? '' }}
                                                            </span>
                                                            @if (!empty($product->varient[0]))
                                                                @if ($product->varient[0]->discount > 0)
                                                                    <del>৳{{ $product->varient[0]->regular_price }}</del>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="tpproduct__hover-text">
                                                        <div
                                                            class="tpproduct__hover-btn d-flex justify-content-center mb-10">
                                                            <form method="POST" id="add_to_cart_form">
                                                                @csrf
                                                                <input type="hidden" value="{{ $product->id ?? 0 }}"
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
                                @else
                                @endif
                            </div>
                            <div class="tab-pane fade show active whight-product" id="nav-popular" role="tabpanel"
                                aria-labelledby="nav-popular-tab">
                                @if ($allProducts->count() > 0)
                                    <div
                                        class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 tpproduct__shop-item">
                                        @foreach ($allProducts as $product)
                                            <div class="col">
                                                <div class="tpproduct p-relative mb-20">
                                                    <div class="tpproduct__thumb p-relative text-center">
                                                        <a href="{{ route('product.details', $product->slug) }}"><img
                                                                src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                alt="Product Image"></a>
                                                        <a class="tpproduct__thumb-img"
                                                            href="{{ route('product.details', $product->slug) }}"><img
                                                                src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                alt="Products Image"></a>
                                                        <div class="tpproduct__info bage">
                                                            @if (!empty($product->varient[0]))
                                                                @if ($product->varient[0]->discount > 0)
                                                                    <span
                                                                        class="tpproduct__info-discount bage__discount">-{{ $product->varient[0]->discount ?? '' }}%</span>
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
                                                                href="{{ route('product.details', $product->slug) }}"><i
                                                                    class="icon-eye"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="tpproduct__content">
                                                        <span class="tpproduct__content-weight">
                                                            <a
                                                                href="{{ route('category.wise.product', $product->category->slug) }}">{{ $product->category->categoryName }}</a>,
                                                            <a
                                                                href="{{ route('subcategory.wise.product', $product->subcategory->slug) }}">{{ $product->subcategory->subcategoryName }}</a>
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
                                                                <a href="#"><i class="icon-star_outline1"></i></a>
                                                            @endfor
                                                        </div>
                                                        <div class="tpproduct__price">
                                                            <span>৳{{ $product->varient[0]->discount_amount ?? '' }}</span>
                                                            <span class="text-secondary text-capitalize"
                                                                style="font-size: 14px">/{{ $product->varient[0]->unit ?? '' }}
                                                            </span>
                                                            @if (!empty($product->varient[0]))
                                                                @if ($product->varient[0]->discount > 0)
                                                                    <del>৳{{ $product->varient[0]->regular_price }}</del>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="tpproduct__hover-text">
                                                        <div
                                                            class="tpproduct__hover-btn d-flex justify-content-center mb-10">
                                                            <form method="POST" id="add_to_cart_form">
                                                                @csrf
                                                                <input type="hidden" value="{{ $product->id ?? 0 }}"
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
                                @else
                                    <div class="col">
                                        <p class="text-center">Product Not Available</p>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade whight-product" id="nav-product" role="tabpanel"
                                aria-labelledby="nav-product-tab">
                                @if ($allProducts->count() > 0)
                                    @foreach ($allProducts as $product)
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div
                                                    class="tplist__product d-flex align-items-center justify-content-between mb-20">
                                                    <div class="tplist__product-img">
                                                        <a href="{{ route('product.details', $product->slug) }}"
                                                            class="tplist__product-img-one">
                                                            <img src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                alt="Product Image" style="height: 200px">
                                                        </a>
                                                        <a class="tplist__product-img-two"
                                                            href="{{ route('product.details', $product->slug) }}">
                                                            <img src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                                alt="Product Image" style="height: 200px">
                                                        </a>
                                                        <div class="tpproduct__info bage">
                                                            @if (!empty($product->varient[0]))
                                                                @if ($product->varient[0]->discount > 0)
                                                                    <span class="tpproduct__info-discount bage__discount">-{{ $product->varient[0]->discount ?? '' }}%</span>
                                                                    <span class="tpproduct__info-hot bage__hot">HOT</span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="tplist__content">
                                                        <h4 class="tplist__content-title"><a
                                                                href="{{ route('product.details', $product->slug) }}">{{ $product->product_name }}</a>
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
                                                                <a href="#"><i class="icon-star_outline1"></i></a>
                                                            @endfor
                                                        </div>
                                                        <ul class="tplist__content-info">
                                                            <li>{{ $product->short_desc }}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="tplist__price justify-content-end">
                                                        <h4 class="tplist__instock">Availability:
                                                            <span>In Stock</span>
                                                        </h4>
                                                        <h3 class="tplist__count mb-15" style="color: #9e54a1;">
                                                            ৳{{ $product->varient[0]->discount_amount ?? '' }}
                                                            <span class="text-secondary" style="font-size: 14px">/
                                                                {{ $product->varient[0]->unit ?? '' }}</span>
                                                        </h3>
                                                        <form method="POST" id="add_to_cart_form">
                                                            @csrf
                                                            <input type="hidden" value="{{ $product->id ?? '' }}"
                                                                name="product_id">
                                                            <input type="hidden"
                                                                value="{{ $product->varient[0]->id ?? '' }}"
                                                                name="variant_id">
                                                            <input type="hidden"
                                                                value="{{ $product->varient[0]->discount_amount ?? '' }}"
                                                                name="selling_price">
                                                            <input type="hidden"
                                                                value="{{ $product->varient[0]->weight ?? '' }}"
                                                                name="weight">
                                                            <input type="hidden"
                                                                value="{{ $product->varient[0]->unit ?? '' }}"
                                                                name="unit">
                                                            <button class="tp-btn-2 mb-10">Add to
                                                                cart</button>
                                                        </form>
                                                        <div class="tplist__shopping">
                                                            @auth
                                                                <a class="add_whishlist" href="#"
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
                                                                        class="fas fa-heart icons"></i>wishlist
                                                                </a>
                                                            @else
                                                                <a class="" href="{{ route('login') }}">
                                                                    <i class="fas fa-heart icons"></i> wishlist
                                                                </a>
                                                            @endauth
                                                            <a href="{{ route('product.details', $product->slug) }}"><i
                                                                    class="icon-eye"></i>View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col">
                                        <p class="text-center">Product Not Available</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($allProducts->count() > 11)
                            <div class="basic-pagination text-center mt-35 d-flex justify-content-center">
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($allProducts->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true"
                                            aria-label="@lang('pagination.previous')">
                                            <span class="page-link pt-0" aria-hidden="true">&lsaquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link pt-0" href="{{ $allProducts->previousPageUrl() }}"
                                                rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($allProducts->getUrlRange(1, $allProducts->lastPage()) as $page => $url)
                                        @if ($page == $allProducts->currentPage())
                                            <li class="page-item active" aria-current="page"><span
                                                    class="page-link pt-0">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link pt-0"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($allProducts->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link pt-0" href="{{ $allProducts->nextPageUrl() }}"
                                                rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true"
                                            aria-label="@lang('pagination.next')">
                                            <span class="page-link pt-0" aria-hidden="true">&rsaquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </section>
    <!-- shop-area-end -->

    <!-- feature-area-start -->
    @include('frontend.body.servicesfooter')
    <!-- feature-area-end -->
@endsection
