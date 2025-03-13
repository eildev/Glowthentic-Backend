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
                            <span>Features</span>
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
            <div class="product__filter-content mb-40">
                <div class="row align-items-center gy-2 ">
                    <div class="col-md-4">
                        <div class="product__item-count">
                            <span>Showing 1 - 18 of 40 Products</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="tpproductnav tpnavbar product-filter-nav d-flex align-items-center justify-content-center">
                            <form action="{{ route('search.product') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="search" placeholder="Search Here"
                                        class="form-control rounded-0 py-1 rounded-start">
                                    <button class="tp-btn rounded-0 py-1 px-3 rounded-end">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product__navtabs d-flex justify-content-end align-items-center">
                            <div class="tp-shop-selector">
                                <select style="display: none;">
                                    <option>Default sorting</option>
                                    <option>Show 14</option>
                                    <option>Show 08</option>
                                    <option>Show 20</option>
                                </select>
                                <div class="nice-select" tabindex="0">
                                    <span class="current">Default sorting</span>
                                    <ul class="list">
                                        <li data-value="Show 12" class="option selected">Default sorting</li>
                                        <li data-value="Show 14" class="option">Short popularity</li>
                                        <li data-value="Show 08" class="option">Show 08</li>
                                        <li data-value="Show 20" class="option">Show 20</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-2 col-lg-12 col-md-12">
                    <div class="tpshop__leftbar">
                        <div class="tpshop__widget mb-30 pb-25">
                            <h4 class="tpshop__widget-title">Product Features</h4>
                            <div class="form-check">
                                <input class="form-check-input feature_product" type="checkbox" value="new-arrival"
                                    id="flexCheckDefault9">
                                <label class="form-check-label" for="flexCheckDefault9">
                                    @php
                                        $NewArrivals = App\Models\Product::whereHas('varient')
                                            ->where('product_feature', 'LIKE', '%' . 'new-arrival' . '%')
                                            ->count();
                                    @endphp
                                    New Arrivals ({{ $NewArrivals }})
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input feature_product" type="checkbox" value="feature"
                                    id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
                                    @php
                                        $Feature = App\Models\Product::whereHas('varient')
                                            ->where('product_feature', 'LIKE', '%' . 'feature' . '%')
                                            ->count();
                                    @endphp
                                    Feature ({{ $Feature }})
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input feature_product" type="checkbox" value="trending"
                                    id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    @php
                                        $Trending = App\Models\Product::whereHas('varient')
                                            ->where('product_feature', 'LIKE', '%' . 'trending' . '%')
                                            ->count();
                                    @endphp
                                    Trending ({{ $Trending }})
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input feature_product" type="checkbox" value="best-rate"
                                    id="flexCheckDefault4">
                                <label class="form-check-label" for="flexCheckDefault4">
                                    @php
                                        $BestRate = App\Models\Product::whereHas('varient')
                                            ->where('product_feature', 'LIKE', '%' . 'best-rate' . '%')
                                            ->count();
                                    @endphp
                                    Best Rate ({{ $BestRate }})
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input feature_product" type="checkbox" value="weekend-deals"
                                    id="flexCheckDefault5">
                                <label class="form-check-label" for="flexCheckDefault5">
                                    @php
                                        $WeekendDeals = App\Models\Product::whereHas('varient')
                                            ->where('product_feature', 'LIKE', '%' . 'weekend-deals' . '%')
                                            ->count();
                                    @endphp
                                    Weekend Deals ({{ $WeekendDeals }})
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input feature_product" type="checkbox" value="top-seller"
                                    id="flexCheckDefault6">
                                <label class="form-check-label" for="flexCheckDefault6">
                                    @php
                                        $TopSeller = App\Models\Product::whereHas('varient')
                                            ->where('product_feature', 'LIKE', '%' . 'top-seller' . '%')
                                            ->count();
                                    @endphp
                                    Top Seller ({{ $TopSeller }})
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input feature_product" type="checkbox" value="top-offers"
                                    id="flexCheckDefault7">
                                <label class="form-check-label" for="flexCheckDefault7">
                                    @php
                                        $TopOffers = App\Models\Product::whereHas('varient')
                                            ->where('product_feature', 'LIKE', '%' . 'top-offers' . '%')
                                            ->count();
                                    @endphp
                                    Top Offers ({{ $TopOffers }})
                                </label>
                            </div>
                        </div>
                        <div class="tpshop__widget mb-30 pb-25">
                            <h4 class="tpshop__widget-title">Product Categories</h4>
                            @php
                                $categories = App\Models\Category::where('status', 1)->get();
                            @endphp
                            @if ($categories->count() > 0)
                                @foreach ($categories as $category)
                                    @php
                                        $categoryProducts = App\Models\Product::whereHas('varient')
                                            ->where('category_id', $category->id)
                                            ->count();
                                    @endphp
                                    <div class="form-check">
                                        <input
                                            class="form-check-input checkbox_category checkbox_category{{ $category->id }}"
                                            type="checkbox" value="{{ $category->id }}"
                                            id="{{ $category->categoryName }}">
                                        <label class="form-check-label" for="{{ $category->categoryName }}">
                                            {{ $category->categoryName }} ({{ $categoryProducts }})
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="tpshop__widget mb-30 pb-25">
                            <h4 class="tpshop__widget-title">FILTER BY BRAND</h4>
                            @php
                                $brands = App\Models\Brand::where('status', 1)->get();
                            @endphp
                            @if ($brands->count() > 0)
                                @foreach ($brands as $brand)
                                    @php
                                        $brandProducts = App\Models\Product::whereHas('varient')
                                            ->where('brand_id', $brand->id)
                                            ->get();
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input checkbox_brand checkbox_brand{{ $brand->id }}"
                                            type="checkbox" value="{{ $brand->id }}" id="{{ $brand->BrandName }}"
                                            name="brandName[]">
                                        <label class="form-check-label" for="{{ $brand->BrandName }}">
                                            {{ $brand->BrandName }} ({{ $brandProducts->count() }})
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="tpshop__widget">
                        <div class="tpshop__sidbar-thumb mt-35">
                            <img src="assets/img/shape/sidebar-product-1.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-12 col-md-12">
                    <div class="tpshop__top ml-60">
                        <div class="tab-content" id="nav-tabContent">
                            @if ($features)
                                <div
                                    class="row row-cols-xxl-4 row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 tpproduct__shop-item shorted_product">
                                    @foreach ($features as $product)
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
                                                                    class="tpproduct__info-discount bage__discount">-{{ $product->varient[0]->discount }}%</span>
                                                            @endif
                                                            @if ($product->varient[0]->discount > 0)
                                                                <span class="tpproduct__info-hot bage__hot">HOT</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="tpproduct__shopping">
                                                        @auth
                                                            <a class="tpproduct__shopping-wishlist add_whishlist"
                                                                href="#" value="{{ $product->id }}">
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
                                                    <div class="tpproduct__price">
                                                        <span>৳{{ $product->varient[0]->discount_amount ?? 0 }}</span>
                                                        <span class="text-secondary"
                                                            style="font-size: 14px">/{{ $product->varient[0]->unit ?? 0 }}</span>
                                                        @if (!empty($product->varient[0]))
                                                            @if ($product->varient[0]->discount > 0)
                                                                <del>৳{{ $product->varient[0]->regular_price ?? 0 }}</del>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="tpproduct__hover-text">
                                                    <div class="tpproduct__hover-btn d-flex justify-content-center mb-10">
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
                            @endif

                        </div>

                        {{-- pagination  --}}
                        <div class="basic-pagination text-center mt-35 d-flex justify-content-center">
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($features->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                        <span class="page-link pt-0" aria-hidden="true">&lsaquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link pt-0" href="{{ $features->previousPageUrl() }}"
                                            rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($features->getUrlRange(1, $features->lastPage()) as $page => $url)
                                    @if ($page == $features->currentPage())
                                        <li class="page-item active" aria-current="page"><span
                                                class="page-link pt-0">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link pt-0"
                                                href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($features->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link pt-0" href="{{ $features->nextPageUrl() }}" rel="next"
                                            aria-label="@lang('pagination.next')">&rsaquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                        <span class="page-link pt-0" aria-hidden="true">&rsaquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-area-end -->


    <!-- feature-area-start -->
    @include('frontend.body.servicesfooter')
    <!-- feature-area-end -->
    <script>
        // const feature_product = document.querySelectorAll('.feature_product');
        // feature_product.forEach((feature)=>{
        //   feature.addEventListener("click",()=>{
        //       let featureAllValue = [];
        //       let featureAllValues = document.querySelectorAll('.feature_product:checked');
        //       if(featureAllValues.length> 0){
        //           featureAllValues.forEach((value)=>{
        //               featureAllValue.push(value.value);
        //           });
        //       }

        //   })
        // });

        // const checkbox_categorys = document.querySelectorAll('.checkbox_category');
        // checkbox_categorys.forEach((category)=>{
        //   category.addEventListener("click",()=>{
        //       let categoryAllValues = document.querySelectorAll('.checkbox_category:checked');
        //       let categoryAllValue = [];
        //       if(categoryAllValues.length> 0){
        //           categoryAllValues.forEach((value)=>{
        //               categoryAllValue.push(value.value);
        //             // $(".shorted_product").html(value.value)
        //           });
        //       }

        //   })
        // });

        // const checkbox_brand = document.querySelectorAll('.checkbox_brand');
        // checkbox_brand.forEach((brand)=>{
        //   brand.addEventListener("click",()=>{
        //       let brandAllValue = [];
        //       let brandAllValues = document.querySelectorAll('.checkbox_brand:checked');

        //       if(brandAllValues.length> 0){
        //           brandAllValues.forEach((value)=>{
        //               brandAllValue.push(value.value);
        //           });
        //       }

        //   })
        // });

        const form_check_input = document.querySelectorAll('.form-check-input');
        form_check_input.forEach((check) => {
            check.addEventListener("click", () => {
                let brandAllValue = [];
                let brandAllValues = document.querySelectorAll('.checkbox_brand:checked');
                if (brandAllValues.length > 0) {
                    brandAllValues.forEach((value) => {
                        brandAllValue.push(value.value);
                    });
                }
                let categoryAllValues = document.querySelectorAll('.checkbox_category:checked');
                let categoryAllValue = [];
                if (categoryAllValues.length > 0) {
                    categoryAllValues.forEach((value) => {
                        categoryAllValue.push(value.value);
                    });
                }
                let featureAllValue = [];
                let featureAllValues = document.querySelectorAll('.feature_product:checked');
                if (featureAllValues.length > 0) {
                    featureAllValues.forEach((value) => {
                        featureAllValue.push(value.value);
                    });
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/product/filter/feature/category/brand",
                    type: "POST",
                    data: {
                        featureAllValue: featureAllValue.toString(),
                        categoryAllValue: categoryAllValue,
                        brandAllValue: brandAllValue
                    },

                    success: function(res) {
                        let filterProduct = "";
                        if (res.status === 200) {

                            $.each(res.filterProducts, function(key, val) {
                                $.ajax({
                                    url: "/product/filter/feature/category/brand/findVariant/" +
                                        val.id,
                                    type: "GET",
                                    success: function(response) {
                                        if (res.status === 200) {
                                            filterProduct +=
                                                '<div class="col">\
                                                                                                <div class="tpproduct p-relative mb-20">\
                                                                                                    <div class="tpproduct__thumb p-relative text-center">\
                                                                                                        <a href="{{ route('product.details', '+val.slug+') }}"><img\
                                                                                                                src="https://sobrokom.store/uploads/products/' +
                                                val
                                                .product_image +
                                                '"\
                                                                                                                alt="Product Image"></a>\
                                                                                                        <a class="tpproduct__thumb-img"\
                                                                                                            href="{{ route('product.details', '+val.slug+') }}"><img\
                                                                                                                src="https://sobrokom.store/uploads/products/' +
                                                val
                                                .product_image +
                                                '"\
                                                                                                                alt="Products Image"></a>\
                                                                                                        <div class="tpproduct__info bage">\
                                                                                                            <span class="tpproduct__info-discount bage__discount">-' +
                                                response.variant.discount +
                                                '%</span>\
                                                                                                        </div>\
                                                                                                        <div class="tpproduct__shopping">\
                                                                                                            @auth\
                                                                                                                <a class="tpproduct__shopping-wishlist add_whishlist"\
                                                                                                                    href="#" value="' +
                                                val
                                                .id +
                                                '">\
                                                                                                                    @auth\
                                                                                                                        @php\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            $loved = App\Models\WishList::where('user_id', Auth::user()->id)\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ->where('product_id', '+val.id+')\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ->first();\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @endphp ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?>\
                                                                                                                    @endauth\
                                                                                                                    <i style="color: {{ !empty($loved->loved) ? 'red' : '' }}"\
                                                                                                                        class="fas fa-heart icons"></i>\
                                                                                                                </a>\
                                                                                                            @else\
                                                                                                                <a class="tpproduct__shopping-wishlist"\
                                                                                                                    href="{{ route('login') }}">\
                                                                                                                    <i class="fas fa-heart icons"></i>\
                                                                                                                </a>\
                                                                                                            @endauth\
                                                                                                            <a class="tpproduct__shopping-cart"\
                                                                                                                href="{{ route('product.details', '+val.slug+') }}"><i\
                                                                                                                    class="icon-eye"></i></a>\
                                                                                                        </div>\
                                                                                                    </div>\
                                                                                                    <div class="tpproduct__content">\
                                                                                                        <h4 class="tpproduct__title">\
                                                                                                            <a\
                                                                                                                href="{{ route('product.details', '+val.slug+') }}">' +
                                                val.product_name + '</a>\
                                                                                                        </h4>\
                                                                                                        <div class="tpproduct__rating mb-5">\
                                                                                                            <a href="#"><i class="icon-star_outline1"></i></a>\
                                                                                                            <a href="#"><i class="icon-star_outline1"></i></a>\
                                                                                                            <a href="#"><i class="icon-star_outline1"></i></a>\
                                                                                                            <a href="#"><i class="icon-star_outline1"></i></a>\
                                                                                                            <a href="#"><i class="icon-star_outline1"></i></a>\
                                                                                                        </div>\
                                                                                                        <div class="tpproduct__price">\
                                                                                                            <span>৳' +
                                                response
                                                .variant
                                                .discount_amount +
                                                '</span>\
                                                                                                            <span class="text-secondary"\
                                                                                                                style="font-size: 14px">/' +
                                                response
                                                .variant
                                                .unit + '</span>\
                                                                                                            @if ('+response.variant.discount+' > 0)\
                                                                                                                <del>৳' +
                                                response
                                                .variant
                                                .regular_price +
                                                '</del>\
                                                                                                            @endif\
                                                                                                        </div>\
                                                                                                    </div>\
                                                                                                    <div class="tpproduct__hover-text">\
                                                                                                        <div class="tpproduct__hover-btn d-flex justify-content-center mb-10">\
                                                                                                            <form method="POST" id="add_to_cart_form">\
                                                                                                                @csrf\
                                                                                                                <input type="hidden" value="' +
                                                val
                                                .id +
                                                '"\
                                                                                                                    name="product_id">\
                                                                                                                <input type="hidden" value="' +
                                                response
                                                .variant
                                                .id +
                                                '"\
                                                                                                                    name="variant_id">\
                                                                                                                <input type="hidden"\
                                                                                                                    value="' +
                                                response
                                                .variant
                                                .discount_amount +
                                                '"\
                                                                                                                    name="selling_price">\
                                                                                                                <input type="hidden"\
                                                                                                                    value="' +
                                                response
                                                .variant
                                                .weight +
                                                '"\
                                                                                                                    name="weight">\
                                                                                                                <input type="hidden"\
                                                                                                                    value="' +
                                                response
                                                .variant
                                                .unit + '" name="unit">\
                                                                                                                <button class="tp-btn-2">Add to\
                                                                                                                    cart</button>\
                                                                                                            </form>\
                                                                                                        </div>\
                                                                                                    </div>\
                                                                                                </div>\
                                                                                            </div>';
                                        }
                                        $(".shorted_product").html(
                                            filterProduct);
                                        console.log(filterProduct)
                                    }
                                });

                            });

                        } else {
                            filterProduct += 'Product Not Found';
                            $(".shorted_product").html(filterProduct);
                        }

                    }
                })
            })
        });
    </script>



@endsection
