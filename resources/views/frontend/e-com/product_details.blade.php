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
                            <span class="tp-breadcrumb__active"><a
                                    href="{{ route('category.wise.product', $product->category->slug) }}">{{ $product->category->categoryName }}</a></span>
                            <span class="dvdr">/</span>
                            <span class="tp-breadcrumb__active"><a
                                    href="{{ route('subcategory.wise.product', $product->subcategory->slug) }}">{{ $product->subcategory->subcategoryName }}</a></span>
                            <span class="dvdr">/</span>
                            <span>{{ $product->product_name }}</span>
                            {{-- <span>{{dd($product->varient);}}</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    <!-- shop-details-area-start -->
    <section class="shopdetails-area grey-bg pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-12">
                    <div class="tpdetails__area mr-60 pb-30">
                        <div class="tpdetails__product mb-30">
                            <div class="tpdetails__title-box">
                                <h3 class="tpdetails__title">{{ $product->product_name }}</h3>
                                <ul class="tpdetails__brand">
                                    <li> Brands: <a
                                            href="{{ route('brand.wise.product', $product->brand->slug) }}">{{ $product->brand->BrandName }}</a>
                                    </li>
                                    <li>
                                        @php
                                            $reviews = App\Models\ReviewRating::where('product_id', $product->id)->get();
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
                                        <b>{{ $reviews->count() }} Reviews</b>
                                    </li>
                                    <li>
                                        SKU: <span>{{ $product->sku }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="tpdetails__box">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="tpproduct-details__nab">
                                            <div class="tab-content" id="nav-tabContents">
                                                @php
                                                    $galleries = App\Models\ProductGallery::where('product_id', $product->id);

                                                @endphp
                                                @foreach ($product->gallary as $key => $gallery)
                                                    <div class="tab-pane fade w-img show {{ $key == 0 ? 'active' : '' }}"
                                                        id="nav-home{{ $gallery->id }}" role="tabpanel"
                                                        aria-labelledby="nav-home-tab" tabindex="0">
                                                        <img src="{{ asset('/uploads/products/gallery/' . $gallery->image) }}"
                                                            alt="">
                                                        <div class="tpproduct__info bage">
                                                            @if ($product->varient[0]->discount > 0)
                                                                <span class="tpproduct__info-hot bage__hot">HOT</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <nav>
                                                <div class="nav nav-tabs justify-content-center" id="nav-tab"
                                                    role="tablist">
                                                    <!-- <button class="active nav-link" id="nav-home-tab" data-bs-toggle="tab"
                                                                                                                                                                                                      </button> -->
                                                    @foreach ($product->gallary as $gallery)
                                                        <button class="nav-link " id="nav-home-tab" data-bs-toggle="tab"
                                                            data-bs-target="#nav-home{{ $gallery->id }}" type="button"
                                                            role="tab" aria-controls="nav-home" aria-selected="true">
                                                            <img src="{{ asset('/uploads/products/gallery/' . $gallery->image) }}"
                                                                alt="">
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="product__details">


                                            <div class="product__details-price-box">
                                                <h5 class="product__details-price mb-1">
                                                    ৳{{ $product->varient[0]->discount_amount }}
                                                    <span class="text-secondary" style="font-size: 14px">
                                                        / {{ $product->varient[0]->weight ?? '' }}
                                                        {{ $product->varient[0]->unit ?? '' }}
                                                    </span>

                                                </h5>
                                                @if ($product->varient[0]->discount > 0)
                                                    <del>৳{{ $product->varient[0]->regular_price ?? '' }}</del>
                                                @endif

                                                <ul class="product__details-info-list">
                                                    <li>{{ $product->short_desc }}</li>
                                                </ul>


                                                {{-- variant price --}}
                                                {{-- @if ($product->varient->count() > 1)
                                                    @php
                                                        $variants = $product->varient;
                                                    @endphp

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="tpnavtab__area pb-40">
                                                                <nav>
                                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                    @foreach ($variants as $variant)
                                                                        <button class="nav-link active text-capitalize" id="nav-all-tab"
                                                                            data-bs-toggle="tab" data-bs-target="#nav-all-{{$variant->id}}"
                                                                            type="button" role="tab"
                                                                            aria-controls="nav-all" aria-selected="true">{{$variant->color}}</button>
                                                                        @endforeach
                                                                    </div>
                                                                </nav>

                                                                <div>
                                                                    @foreach ($variants as $variant)
                                                                    <h1 class="product__details-price">{{$variant->discount_amount}}</h1>
                                                                    <div><p class="border-1">{{$variant->size}}</p></div>
                                                                    @endforeach
                                                                </div>

                                                                <div class="tab-content" id="nav-tabContent">
                                                                    @foreach ($product->varient as $key => $variant)
                                                                    <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}" id="nav-all-{{$variant->id}}"
                                                                        role="tabpanel" aria-labelledby="nav-all-tab"
                                                                        tabindex="0">


                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Price</th>
                                                                                    <th>Discount</th>
                                                                                    <th>Sale Price</th>
                                                                                    <th>Size</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>{{$variant->regular_price}}</td>
                                                                                    <td>{{$variant->discount}}</td>
                                                                                    <td>{{$variant->discount_amount}}</td>
                                                                                    <td>{{$variant->size}}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    @endforeach
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                @else
                                                    <h5 class="product__details-price">
                                                        ৳{{ $product->varient[0]->discount_amount }}</h5>
                                                    <ul class="product__details-info-list">
                                                        <li>{{ $product->short_desc }}</li>
                                                    </ul>
                                                @endif --}}



                                            </div>

                                            <div class="product__details-cart">
                                                <div class="product__details-quantity d-flex align-items-center mb-15">
                                                    <b>Qty:</b>
                                                    <div class="product__details-count mr-10">
                                                        <span class="cart-minus"><i class="far fa-minus"></i></span>
                                                        <input class="tp-cart-input pr_quantity" id=""
                                                            type="text" value="1">
                                                        <span class="cart-plus"><i class="far fa-plus"></i></span>
                                                    </div>
                                                    <div class="product__details-btn">
                                                        <input type="hidden" value="{{ $product->id ?? 0 }}" name="product_id"
                                                            class="product_id">
                                                        <input type="hidden" value="{{ $product->varient[0]->id ?? 0 }}"
                                                            name="variant_id" class="variant_id">
                                                        <input type="hidden"
                                                            value="{{ $product->varient[0]->discount_amount ?? 0 }}"
                                                            name="selling_price" class="selling_price">
                                                        <input type="hidden" value="{{ $product->varient[0]->weight ?? 0 }}"
                                                            name="weight" class="weight">
                                                        <input type="hidden" value="{{ $product->varient[0]->unit ?? 0 }}"
                                                            name="unit" class="unit">
                                                      <button class="tp-btn-2 px-5 py-1" id="details_cart">Add to cart</button>
                                                    </div>
                                                </div>
                                                <ul class="product__details-check">
                                                    @auth
                                                        <li>
                                                            <a class="add_whishlist" href="#" value="{{ $product->id }}">
                                                                <!-- <i class="icon-heart icons"></i> -->
                                                                @auth
                                                                    @php
                                                                        $loved = App\Models\WishList::where('user_id', Auth::user()->id)
                                                                            ->where('product_id', $product->id)
                                                                            ->first();
                                                                    @endphp
                                                                @endauth
                                                                <i style="color: {{ !empty($loved->loved) ? 'red' : '' }}"
                                                                    class="fas fa-heart icons"></i> add to
                                                                wishlist
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a class="" href="{{ route('login') }}">
                                                                <i class="icon-heart icons"></i> add to
                                                                wishlist
                                                            </a>
                                                        </li>
                                                    @endauth
                                                    <li>
                                                        <a href="#"><i class="icon-share-2"></i> Share</a>
                                                    </li>

                                                </ul>
                                                <!--<div id="social-links">-->
                                                <!--    <ul>-->
                                                <!--        <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://sobrokom.store/product-details/{{ $product->slug }}"-->
                                                <!--                class="social-button btn btn-primary  my-class"-->
                                                <!--                id="my-id" rel="nofollow noopener noreferrer"><span-->
                                                <!--                    class="fa fa-facebook-official"></span></a></li>-->
                                                <!--    </ul>-->
                                                <!--</div>-->
                                            </div>
                                            @php
                                                $variant = App\Models\Variant::where('product_id', $product->id)->first();
                                            @endphp
                                            <div class="product__details-stock mb-25">
                                                <ul>
                                                    <li>Availability: 
                                                        @if($variant && $variant->stock_quantity > 0)
                                                            <i>In Stock</i>
                                                        @else
                                                            <i class="text-danger">Out of Stock</i>
                                                        @endif
                                                    </li>
                                                    <li>Category: <span>{{ $product->category->categoryName }} </span>
                                                    </li>
                                                    <li>Subcategory: <span>{{ $product->subcategory->subcategoryName }}
                                                        </span>
                                                    </li>
                                                    <li class="text-capitalize">Tags: {{ $product->tags }}</li>
                                                </ul>
                                            </div>
                                            {{-- <div class="product__details-payment text-center">
                                                <img src="{{ asset('frontend') }}/assets/img/shape/footer-payment.png "
                                                    alt="">
                                                <span>Guarantee safe & Secure checkout</span>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tpdescription__box">
                            <div class="tpdescription__box-center d-flex align-items-center justify-content-center">
                                <nav>
                                    <div class="nav nav-tabs" role="tablist">
                                        <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-description" type="button" role="tab"
                                            aria-controls="nav-description" aria-selected="true">Product
                                            Description</button>
                                        <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-review" type="button" role="tab"
                                            aria-controls="nav-review" aria-selected="false">Reviews
                                            ({{ $reviews->count() }})</button>
                                    </div>
                                </nav>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                    aria-labelledby="nav-description-tab" tabindex="0">

                                    
                                    <div class="tpdescription__content">
                                        @if (!empty($product->long_desc))
                                            <p> {!! $product->long_desc !!}</p>
                                        @else
                                            <div class="product__details-stock mb-25">
                                                <ul>
                                                    <li>Availability:
                                                       @if($variant && $variant->stock_quantity > 0)
                                                            <i>In Stock</i>
                                                        @else
                                                            <i class="text-danger">Out of Stock</i>
                                                        @endif
                                                    </li>
                                                    <li>Category: <span>{{ $product->category->categoryName }} </span>
                                                    </li>
                                                    <li>Subcategory: <span>{{ $product->subcategory->subcategoryName }}
                                                        </span>
                                                    </li>
                                                    <li class="text-capitalize">Tags: {{ $product->tags }}</li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    {{-- <div
                                        class="tpdescription__product-wrapper mt-30 mb-30 d-flex justify-content-between align-items-center">
                                        <div class="tpdescription__product-info">
                                            <h5 class="tpdescription__product-title">PRODUCT DETAILS</h5>
                                            <ul class="tpdescription__product-info">
                                                <li>Material: Plastic, Wood</li>
                                                <li>Legs: Lacquered oak and black painted oak</li>
                                                <li>Dimensions and Weight: Height: 80 cm, Weight: 5.3 kg</li>
                                                <li>Length: 48cm</li>
                                                <li>Depth: 52 cm</li>
                                            </ul>
                                            <p>Lemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut <br>
                                                fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem <br>
                                                sequi nesciunt.</p>
                                        </div>
                                        <div class="tpdescription__product-thumb">
                                            <img src="{{ asset('frontend') }}/assets/img/product/product-single-1.png"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="tpdescription__video">
                                        <h5 class="tpdescription__product-title">PRODUCT DETAILS</h5>
                                        <p>Form is an armless modern chair with a minimalistic expression. With a simple and
                                            contemporary design Form Chair has a soft and welcoming ilhouette and a
                                            distinctly residential look. The legs appear almost as if they are growing out
                                            of the shell. This gives the design flexibility and makes it possible to vary
                                            the frame. Unika is a mouth blown series of small, glass pendant lamps,
                                            originally designed for the Restaurant Gronbech. Est eum itaque maiores qui
                                            blanditiis architecto. Eligendi saepe rem ut. Cumque quia earum eligendi. </p>
                                        <div class="tpdescription__video-wrapper p-relative mt-30 mb-35 w-img">
                                            <img src="{{ asset('frontend') }}/assets/img/product/product-video1.jpg"
                                                alt="">
                                            <div class="tpvideo__video-btn">
                                                <a class="tpvideo__video-icon popup-video"
                                                    href="https://www.youtube.com/watch?v=rLrV5Tel7zw">
                                                    <i>
                                                        <svg width="20" height="22" viewBox="0 0 20 22"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.6499 6.58886L15.651 6.58953C17.8499 7.85553 18.7829 9.42511 18.7829 10.8432C18.7829 12.2613 17.8499 13.8308 15.651 15.0968L15.6499 15.0975L12.0218 17.195L8.3948 19.2919C8.3946 19.292 8.3944 19.2921 8.3942 19.2922C6.19546 20.558 4.36817 20.5794 3.13833 19.8697C1.9087 19.1602 1.01562 17.5694 1.01562 15.0382V10.8432V6.64818C1.01562 4.10132 1.90954 2.51221 3.13721 1.80666C4.36609 1.1004 6.1936 1.12735 8.3942 2.39416C8.3944 2.39428 8.3946 2.3944 8.3948 2.39451L12.0218 4.49135L15.6499 6.58886Z"
                                                                stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </i>
                                                </a>
                                            </div>
                                        </div>
                                        <h5 class="tpdescription__product-title">Product supreme quality</h5>
                                        <p>Form is an armless modern chair with a minimalistic expression. With a simple and
                                            contemporary design Form Chair has a soft and welcoming ilhouette and a
                                            distinctly residential look. The legs appear almost as if they are growing out
                                            of the shell. This gives the design flexibility and makes it possible to vary
                                            the frame. Unika is a mouth blown series of small, glass pendant lamps,
                                            originally designed for the Restaurant Gronbech. Est eum itaque maiores qui
                                            blanditiis architecto. Eligendi saepe rem ut. Cumque quia earum eligendi. </p>
                                        <p>Duis semper erat mauris, sed egestas purus commodo. Cras imperdiet est in nunc
                                            tristique lacinia. Nullam aliquam mauris eu accumsan tincidunt. Suspendisse
                                            velit ex, aliquet vel ornare vel, dignissim a tortor. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate.</p>
                                    </div> --}}
                                </div>
                                <div class="tab-pane fade" id="nav-review" role="tabpanel"
                                    aria-labelledby="nav-review-tab" tabindex="0">
                                    <div class="tpreview__wrapper">
                                        <h4 class="tpreview__wrapper-title">{{ $reviews->count() }} review for Cheap and
                                            delicious fresh chicken
                                        </h4>
                                        @foreach ($reviews as $review)
                                            <div class="tpreview__comment">
                                                <div class="tpreview__comment-img mr-20">
                                                    <img style="height: 40px;width:40px"
                                                        src="{{ asset('/default/user.svg') }}" alt="">
                                                </div>

                                                <div class="tpreview__comment-text w-50">
                                                    <div
                                                        class="tpreview__comment-autor-info d-flex align-items-center justify-content-between">
                                                        <div class="tpreview__comment-author">
                                                            <span>{{ $review->user->userName }}</span>
                                                        </div>
                                                        <div class="tpreview__comment-star">
                                                            @php
                                                                $last = 0;
                                                            @endphp
                                                            @for ($i = 1; $i <= $review->rating; $i++)
                                                                <i class="icon-star"></i>
                                                                @php $last = $i @endphp
                                                            @endfor
                                                            @for ($j = $last; $j < 5; $j++)
                                                                <i class="icon-star_outline1"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $date = new DateTime($review->created_at);
                                                    $formattedDate = $date->format('M j');
                                                    $day = $date->format('j');
                                                    if ($day % 10 == 1 && $day != 11) {
                                                        $formattedDate .= 'st';
                                                    } elseif ($day % 10 == 2 && $day != 12) {
                                                        $formattedDate .= 'nd';
                                                    } elseif ($day % 10 == 3 && $day != 13) {
                                                        $formattedDate .= 'rd';
                                                    } else {
                                                        $formattedDate .= 'th';
                                                    }
                                                    $formattedDate .= $date->format(' Y g:i A');

                                                    ?>
                                                    <span class="date mb-20">{{ $formattedDate }}</span>
                                                    @if ($review->gallary->count() > 0)
                                                        @foreach ($review->gallary as $image)
                                                        @endforeach
                                                        <img src="{{ asset('/uploads/review_image/' . $image->image) }}"
                                                            alt="Review Image" class="img-fluid">
                                                    @endif


                                                    <p class="mt-2">{{ $review->review }}</p>
                                                </div>

                                            </div>
                                        @endforeach
                                        @auth
                                            @php
                                                // @dd(Auth::user()->id);
                                                $userId = Auth::user()->id;
                                                $order = App\Models\Order::where('user_identity', $userId)->where('status', 'completed')->latest()->first();
                                                if (!empty($order->id)) {
                                                    $orderDetail = App\Models\OrderDetails::where('order_id', $order->id)
                                                        ->where('product_id', $product->id)
                                                        ->latest()
                                                        ->first();
                                                }
                                            @endphp
                                            @if (!empty($orderDetail->id))
                                                <div class="tpreview__form">
                                                    <h4 class="tpreview__form-title mb-25">Add a Review</h4>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <form action="{{ Route('review-rating.insert') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" value="{{ $product->id }}"
                                                                    name="product_id" class="">
                                                                <div class="tpreview__star mb-20">
                                                                    <h4 class="title">Your Rating</h4>
                                                                    <div class="star-rating ratings">
                                                                        <input type="hidden" name="rating" id="rating"
                                                                            value="0" required>
                                                                        <span class="star" data-value="1">&#9733;</span>
                                                                        <span class="star" data-value="2">&#9733;</span>
                                                                        <span class="star" data-value="3">&#9733;</span>
                                                                        <span class="star" data-value="4">&#9733;</span>
                                                                        <span class="star" data-value="5">&#9733;</span>
                                                                    </div>
                                                                </div>
                                                                <div class="tpreview__input mb-30">
                                                                    <label for="message" class="form-label">Write Your
                                                                        Comment here.</label>
                                                                    <textarea id="message" name="message" placeholder="Message" required></textarea>
                                                                    @error('message')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    <label for="imageGallery" class="form-label">Add pictures
                                                                        from here.</label>
                                                                    <input type="file" id="imageGallery"
                                                                        class="form-control h-auto ps-3" name="imageGallery[]"
                                                                        multiple>
                                                                    @error('imageGallery[]')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    <div class="tpreview__submit mt-30">
                                                                        <button class="tp-btn">Submit</button>
                                                                    </div>
                                                                </div>
                                                                <div class="tpreview__input mb-30">

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .star-rating {
                        display: flex;
                        direction: row;
                        font-size: 20px;
                        color: #ddd;
                        /* Default star color */
                    }

                    .star-rating .star {
                        cursor: pointer;
                        transition-duration: 1s;
                    }

                    .star-rating .star:hover {
                        color: #ffc107;
                    }

                    /* Change color for active stars */
                    .star-rating .star.active {
                        color: #ffc107;
                        /* Active star color, typically gold */

                    }
                </style>
                <script>
                    document.querySelectorAll('.star-rating .star').forEach(star => {
                        star.onclick = () => {
                            // Remove active class from all stars
                            document.querySelectorAll('.star-rating .star').forEach(innerStar => {
                                innerStar.classList.remove('active');
                            });

                            // Add active class to clicked star and all previous stars
                            star.classList.add('active');
                            let previousSibling = star.previousElementSibling;
                            while (previousSibling) {
                                previousSibling.classList.add('active');
                                previousSibling = previousSibling.previousElementSibling;
                            }
                        };
                    });
                    document.addEventListener('DOMContentLoaded', function() {
                        const stars = document.querySelectorAll('.ratings span');
                        stars.forEach((star, index) => {
                            star.addEventListener('click', function(e) {
                                e.preventDefault();
                                const ratingValue = index + 1;
                                document.getElementById('rating').value = ratingValue;
                                stars.forEach((s, i) => {
                                    if (i < ratingValue) {
                                        s.classList.add('active');
                                    } else {
                                        s.classList.remove('active');
                                    }
                                });
                            });
                        });
                    });
                </script>
                @php
                    $featureProducts = App\Models\Product::whereHas('varient')
                        ->where('product_feature', 'like', '%' . 'new-arrival' . '%')
                        ->take(3)
                        ->orderBy('id', 'ASC')
                        ->get();
                    // dd($featureProducts);
                @endphp
                <div class="col-lg-2 col-md-12">
                    <div class="tpsidebar pb-30">
                        <div class="tpsidebar__product">
                            <h4 class="tpsidebar__title mb-15">Recent Products</h4>
                            @if ($featureProducts->count() > 0)
                                @foreach ($featureProducts as $product)
                                    <div class="tpsidebar__product-item">
                                        <div class="tpsidebar__product-thumb p-relative">
                                            <img
                                                src="{{ asset('uploads/products/' . $product->product_image) }}"alt="Product Image">
                                            <div class="tpsidebar__info bage">
                                                @if ($product->varient[0]->discount > 0)
                                                    <span
                                                        class="tpproduct__info-discount bage__discount">-{{ $product->varient[0]->discount }}%</span>
                                                @endif
                                                @if ($product->varient[0]->discount > 0)
                                                    <span class="tpproduct__info-hot bage__hot">HOT</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tpsidebar__product-content">
                                            <span class="tpproduct__product-category">
                                                <a
                                                    href="{{ route('category.wise.product', $product->category->slug) }}">{{ $product->category->categoryName }}</a>
                                            </span>
                                            <h4 class="tpsidebar__product-title">
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
                                    </div>
                                @endforeach
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-details-area-end -->

    <!-- Recommended product-area-start -->
    @include('frontend.pageContent.recommendedProduct')
    <!-- Recommended product-area-end -->
    <!-- feature-area-start -->
    @include('frontend.body.servicesfooter')
    <!-- feature-area-end -->

    <!-- feature-area-end -->

    <script>
        const details_cart_btn = document.querySelector('#details_cart');
        details_cart_btn.addEventListener('click', function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let product_id = document.querySelector('.product_id').value;
            let variant_id = document.querySelector('.variant_id').value;
            let selling_price = document.querySelector('.selling_price').value;
            let quantity = document.querySelector('.pr_quantity').value;
            let weight = document.querySelector('.weight').value;
            let unit = document.querySelector('.unit').value;
            $.ajax({
                url: '/product/add_to_cart',
                type: 'POST',
                data: {
                    'product_id': product_id,
                    'variant_id': variant_id,
                    'selling_price': selling_price,
                    'pr_quantity': quantity,
                    'weight': weight,
                    'unit': unit
                },
                success: function(success_response) {
                    console.log(success_response);
                    if (success_response.status == 200) {
                        toastr.success(success_response.message);
                        showCart();
                    } else {
                        toastr.warning(success_response.error.email);
                    }
                    // console.log(success_response);

                }
            });
        });



        $(document).ready(function() {
            $('.cart-minus').on('click', function() {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
            });
        });


        $(document).ready(function() {
            $('.cart-plus').on('click', function() {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
            });
        });

        $(document).ready(function() {
            var pr_quantity = document.querySelector('.pr_quantity');
            pr_quantity.addEventListener('keyup', function() {
                let quantity = parseInt(this.value);
                if (quantity < 1 || isNaN(quantity)) {
                    toastr.warning('Please provide a valid number greater than or equal to 1.');
                }
            })
        });
    </script>
@endsection
