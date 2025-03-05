<div class="header__top theme-bg-1 d-md-block" style="position: fixed;top:0;z-index:999999;right:0;left:0;padding:0 15px 0 10px">
    <div class="">
        <div class="row align-items-center d-flex justify-content-lg-around" style="padding-left: 20px">
            <div class="col-lg-2 col-md-3 d-flex justify-content-between" style="padding-right: 0">
                <div class="header__top-left d-flex align-items-center">
                    {{-- <span>Our <strong> Hot Line:</strong> +880 1602 08 51 21</span> --}}
                    <a href="#" class="myToggle" style="color:white;font-size:22px"><i class="fas fa-bars"></i></a>
                </div>
                <div></div>
                    <a href="{{ route('home') }}" style="margin-left: 10px" class="mytop-logo">
                        <img height="50" width="180" src="{{ asset('/frontend/assets/img/logo/sobrokom-logo-update.png') }}" alt="Sobrokom Logo">
                    </a>
                <div></div>
            </div>
            <style>
            .top_search_list_home_page{
                box-shadow:1px 1px 5px #2D2C6E;;
            }
                .top_search_list_home_page li{
                    padding:3px 10px; 
                    border-bottom:1px solid rgba(0,0,0,.2);
                }
                .top_search_list_home_page li:hover{
                    background:rgba(45, 44, 110,.2);
                }
            </style>
            <div class="col-lg-6 col-md-6 d-flex justify-content-center align-items-center top-serch-container" style="margin-bottom:5px">
                <form class="w-100" action="{{ route('search.product') }}" method="get">
                    <div class="input-group" style="position: relative">
                        <input type="text" name="search" class="top_search form-control" autocomplete="off" placeholder="Search for products (e.g. fet food, milk, cat food)" aria-label="Search for products (e.g. fet food, milk, cat food)" aria-describedby="button-addon2" style="border-radius: 0;">
                        <button class="btn btn-secondary" type="submit" id="button-addon2" style="background: var(--tp-heading-secondary) !important;
                            border: 1px solid var(--tp-heading-secondary);">Search</button>
                        <ul class="list-unstyled top_search_list_home_page" style="text-align: left; padding-left:5px;display:none;max-height: 300px; overflow-y:auto;position:absolute;left:0;top:100%;background:white;width: 89%;">

                        </ul>
                    </div>
                </form>

            </div>
<style>
    .custom_btn{
        background-color:white;
        color:#222222;
    }    
    .custom_btn:hover{
        background-color:var(--tp-heading-secondary) !important;
    }
    .custom_btn:visited{
        background-color:var(--tp-heading-secondary) !important;
    }
    .custom_btn:active{
        background-color:var(--tp-heading-secondary) !important;
    }
    .custom_btn:focus{
        background-color:var(--tp-heading-secondary) !important;
    }
</style>
            <div class="col-lg-4 col-md-3 align-items-center accounts-nav">
                <div class="header__info d-flex align-items-center">
                    <div style="padding-right:50px">
                        <button>
                            <a href="https://wa.me/+8801602085121" target="_blank">
                                <button type="button" class="btn btn-outline-secondary custom_btn">Sobrokom - RideEasy</button>
                                <!--<img src="uploads/giphy.gif" height="45px" width ="100px" alt="ok">-->
                                <!--<p style="color:white !important; margin:0px">Sobrokom - RideEasy</p>-->
                            </a>
                        </button>
                    </div>
                
                    <div class="header__info-user tpcolor__yellow ml-10">
                        <!-- <a href="log-in.html"><i class="icon-user"></i></a> -->
                        @auth
                        @if(Auth::user()->role == 'admin')
                        <a href="{{route('admin.dashboard')}}"><i
                                class="icon-user"></i></a>
                        @else
                        <a href="{{route('user.dashboard') }}"><i
                                class="icon-user"></i></a>
                        @endif
                        @else
                        <a href="{{ route('login') }}"><i
                                class="icon-user"></i></a>
                        @endauth
                        
                    </div>
                    <div class="header__info-cart tpcolor__oasis ml-10 tp-cart-toggle">
                        <button>
                            <i>
                                <img src="{{ asset('frontend') }}/assets/img/icon/cart-1.svg" alt="">
                            </i>
                            <span class="cart_quantity"></span>
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
    </div>
</div>

