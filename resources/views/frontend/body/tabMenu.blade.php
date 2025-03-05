<!-- tablet-menu-area -->
{{-- <div id="header-sticky-2 d-none" class="tpmobile-menu d-xl-none">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-4 col-3 col-sm-3">
                <div class="mobile-menu-icon">
                    <button class="tp-menu-toggle"><i class="icon-menu1"></i></button>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-6 col-sm-4">
                <div class="header__logo text-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('frontend') }}/assets/img/logo/logo.png" alt="logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-3 col-sm-5">
                <div class="header__info d-flex align-items-center">
                    <button>
                            <a href="https://wa.me/+8801602085121" target="_blank">
                                <button type="button" class="btn btn-outline-secondary custom_btn">Sobrokom Rideeasy</button>
                                <!--<img src="uploads/giphy.gif" height="45px" width ="100px" alt="ok">-->
                                <!--<p style="color:white !important; margin:0px">Sobrokom - RideEasy</p>-->
                            </a>
                        </button>
                    <div class="header__info-search tpcolor__purple ml-10 d-none d-sm-block">
                        <button class="tp-search-toggle"><i class="icon-search"></i></button>
                    </div>
                    <div class="header__info-user tpcolor__yellow ml-10 d-none d-sm-block">
                        <a href="{{ !empty(Auth::user()->id) ? route('user.dashboard') : route('login') }}"><i class="icon-user"></i></a>
                    </div>
                    @auth
                    <div class="header__info-wishlist tpcolor__greenish ml-10 d-none d-sm-block">
                        <a href="{{route('user.dashboard')}}"><i class="icon-heart icons"></i></a>
                    </div>
                    @endauth
                    <div class="header__info-cart tpcolor__oasis ml-10 tp-cart-toggle">
                        <button><i><img src="{{ asset('frontend') }}/assets/img/icon/cart-1.svg" alt=""></i>
                            <span class="mobile_show_quantity"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="body-overlay"></div>
<!-- tablet-menu-area-end -->
