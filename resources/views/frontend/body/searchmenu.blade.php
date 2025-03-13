<!-- search-menu-start -->
<div class="row align-items-center header-logo-border">
    <div class="col-xl-4">
        <div class="header-three__search">
            <form action="#">
                <input type="email" placeholder="Search products...">
                <i class="icon-search"></i>
            </form>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="header__logo text-center">
            <a href="index.html"><img src="{{ asset('frontend') }}/assets/img/logo/logo.png" alt="logo"></a>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="header__info d-flex align-items-center justify-content-end">
            <div class="header__info-search tpcolor__purple ml-10">
                <button class="tp-search-toggle"><i class="icon-search"></i></button>
            </div>
            <div class="header__info-user tpcolor__yellow ml-10">
                <a href="{{ !empty(Auth::user()->id) ? route('user.dashboard') : route('login') }}"><i
                        class="icon-user"></i></a>
            </div>
            <div class="header__info-wishlist tpcolor__greenish ml-10">
                <a href="#"><i class="icon-heart icons"></i></a>
            </div>
            <div class="header__info-cart tpcolor__oasis ml-10 tp-cart-toggle">
                <button><i><img src="{{ asset('frontend') }}/assets/img/icon/cart-1.svg" alt=""></i>
                    <span>5</span>
                </button>
            </div>
            @auth
                <div class="header__info-wishlist tpcolor__greenish ml-10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button href="#"><i class="fas fa-power-off"></i></button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</div>
<!-- search-menu-end -->
