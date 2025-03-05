<!-- main-menu-start -->
<div class="row justify-content-center">
    <div class="col-xxl-6 col-xl-8">
        <div id="header-sticky" class="header__menu main-menu mainmenu-three text-center">
            <nav id="mobile-menu">
                <ul>
                    {{-- <h2 value="">{{ $brand->image }}</h2> --}}
                    <li class="has-dropdown has-homemenu">
                        <a href="index.html">Brand</a>
                        <ul class="sub-menu home-menu-style">
                            @php
                                $brands = App\Models\brand::where('status', 1)
                                    ->take(6)
                                    ->get();
                                // dd($brands);
                            @endphp
                            @foreach ($brands as $brand)
                                <li>
                                    <a href="index.html"><img src="{{ asset('uploads/brands/' . $brand->image) }} "
                                            alt=""> {{ $brand->BrandName }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="has-dropdown has-megamenu">
                        <a href="course-grid.html">Shop</a>
                        <ul class="sub-menu mega-menu"
                            data-background="{{ asset('frontend') }}/assets/img/banner/mega-menu-shop-1.jpg">
                            @php
                                $categoris = App\Models\Category::where('status', 1)->take(4)->get();
                            @endphp
                            @foreach ($categoris as $category)
                                <li>
                                    <a class="mega-menu-title">{{ $category->categoryName }}</a>
                                    <ul>
                                        @foreach ($category->subcategories as $subcategory)
                                            <li><a
                                                    href="{{ route('category.wise.product', $category->slug) }}">{{ $subcategory->subcategoryName }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="{{route('all.blog.post')}}">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog.html">Big image</a></li>
                            <li><a href="blog-right-sidebar.html">Right sidebar</a></li>
                            <li><a href="blog-left-sidebar.html">Left sidebar</a></li>
                            <li><a href="blog-details.html">Single Post</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="about.html">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="shop-location.html">Shop Location One</a></li>
                            <li><a href="shop-location-2.html">Shop Location Two</a></li>
                            <li><a href="faq.html">FAQs</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="cart.html">Cart Page</a></li>
                            <li><a href="wishlist.html">Wishlist</a></li>
                            <li><a href="log-in.html">Sign In</a></li>
                            <li><a href="comming-soon.html">Coming soon</a></li>
                            <li><a href="404.html">Page 404</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- main-menu-end -->
