<!-- banner-area-start -->
<section class="tpbanner-area grey-bg">
    <div class="container">
        <div class="sections__wrapper white-bg pb-30 pl-50 pr-50 pt-30">
            <div class="row">
                <div class="col-12">


                    @php
                        $offerBanner = App\Models\OfferBanner::where('status', 1)
                            ->orderBy('id', 'DESC')
                            ->first();
                    @endphp

                    {{-- @dd($offerBanner); --}}

                    @if ($offerBanner)
                        <div class="tpbannertwo text-center pt-40 pb-45 tpbannertwo__bg"
                            data-background="{{ asset('uploads/offer_banner/' . $offerBanner->image) }}">
                            <span class="tpbannertwo__sub-title mb-5">{{ $offerBanner->head }}</span>
                            <h5 class="tpbannertwo__title mb-30"> {{ $offerBanner->title }}
                            </h5>
                            <p>{{ $offerBanner->short_description }}</p>
                        </div>
                    @else
                        <div class="tpbannertwo text-center pt-40 pb-45 tpbannertwo__bg"
                            data-background="{{ asset('frontend') }}/assets/img/banner/tpbanner-1.jpg">
                            <span class="tpbannertwo__sub-title mb-5">The Salad</span>
                            <h5 class="tpbannertwo__title mb-30">Fresh & Natural <br> Healthy Food Special Offer
                            </h5>
                            <p>Do not miss the current offers of us!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner-area-end -->
