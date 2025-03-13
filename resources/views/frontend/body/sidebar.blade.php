<!-- sidebar-menu-area -->
<div class="tpsideinfo">
    <button class="tpsideinfo__close">Close<i class="fal fa-times ml-10"></i></button>
    <div class="tpsideinfo__search text-center pt-35">
        <span class="tpsideinfo__search-title mb-20">What Are You Looking For?</span>
        <form action="{{ route('search.product') }}" method="get">
            @csrf
            <input type="text" name="search" placeholder="Search Products...">
            <button class=""><i class="icon-search"></i></button>
        </form>
    </div>
    <div class="tpsideinfo__nabtab">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="mobile-menu"></div>
            </div>
        </div>
    </div>
    <div class="tpsideinfo__account-link">
        @if (!empty(Auth::user()->id))
            <a href="{{ route('login') }}"><i class="icon-home icons"></i> Profile</a>
        @else
            <a href="{{ route('user.dashboard') }}"><i class="icon-user icons"></i> Login / Register</a>
        @endif
    </div>

    @auth
        <div class="tpsideinfo__wishlist-link">
            <a href="{{ route('user.dashboard') }}" target="_parent"><i class="icon-heart"></i> Wishlist</a>
        </div>
    @endauth
    @auth
        <div class="tpsideinfo__account-link">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button href="#" class="text-white"><i class="fas fa-power-off me-2"></i> log out</button>
            </form>
        </div>
    @endauth

</div>
<!-- sidebar-menu-area-end -->
