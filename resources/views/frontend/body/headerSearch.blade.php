<!-- header-search -->
<div class="tpsearchbar tp-sidebar-area">
    <button class="tpsearchbar__close"><i class="icon-x"></i></button>
    <div class="search-wrap text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 pt-100 pb-100">
                    <h2 class="tpsearchbar__title">What Are You Looking For?</h2>
                    <div class="tpsearchbar__form">
                        <form action="{{ route('search.product') }}" method="get">
                            @csrf
                            <input type="text" name="search" autocomplete="off" class="top_search"
                                placeholder="Search Product...">
                            <button class="tpsearchbar__search-btn"><i class="icon-search"></i></button>
                        </form>
                    </div>
                    <ul class="list-unstyled top_search_list" style="text-align: left; padding-left:5px;display:none;max-height: 300px; overflow-y:auto;">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="search-body-overlay"></div>
<!-- header-search-end -->
