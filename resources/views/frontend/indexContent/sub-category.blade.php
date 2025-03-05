<!-- cart-area-start -->
<section class="cart-area">
    <div class="container">
        <div class="swiper-container product-details-active">
            <!--<h4></h4>-->
             <div class="row">
                 <h4 class="tpsection__title text-start brand-product-title pt-2 text-center" id="weekly_offers">{{ $category->categoryName }}</h4>
             </div>
            <div class="row"  style="justify-content: center;">
                
                @if ($subcategories->count() > 0)
                    @foreach ($subcategories as $Category)
                        <div class="col-lg-2 col-md-4 col-4">
                            <div class="tpcartitem">
                                <div class="tpcartitem__thumb mb-15 text-center">
                                    <a href="{{ route('subcategory.wise.product',$Category->slug) }}">
                                        <img src="{{ !empty($Category->image) ? asset('uploads/subcategory/' . $Category->image) : asset('uploads/subcategory/default.png') }}" alt="{{$Category->slug}}" class="img-fluid">
                                    </a>
                                    <span class="category-span mt-2" style="display: inline-block">{{ $Category->subcategoryName }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide">
                        <div class="tpcartitem">
                            <div class="tpcartitem__thumb mb-15">
                                <a href="#"><img src="{{ asset('frontend') }}/assets/img/cart/cart-1.jpg"
                                        alt=""></a>
                            </div>
                            <div class="tpcartitem__content">
                                <h3 class="tpcartitem__title mb-15"><a href="shop-3.html">Fresh Vegetables</a>
                                </h3>
                                <ul>
                                    <li><a href="shop-details-4.html">Exotic Fruits & Veggies</a></li>
                                    <li><a href="shop-details-3.html">Fresh Fruits jihadtfhdthdty</a></li>
                                    <li><a href="shop-details-3.html">Fresh Vegetables</a></li>
                                    <li><a href="shop-details-4.html">Herbs & Seasonings</a></li>
                                </ul>
                                <span class="tpcartitem__all"><a href="shop-3.html">See All <i
                                            class="icon-chevron-right"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
<!-- cart-area-end -->
