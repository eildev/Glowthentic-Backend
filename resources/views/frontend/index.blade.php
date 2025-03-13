@extends('frontend.master')
@section('maincontent')
    <!-- slider-area-start -->
    @include('frontend.indexContent.slider')
    <!-- slider-area-end -->

    <!-- feature-area-start -->
    
    <!-- feature-area-end -->

    <!-- product-area-start -->
    <!--include('frontend.indexContent.productArea_1')-->
    <!-- product-area-end -->

    <!-- banner-area-start -->
    <!--include('frontend.indexContent.banner')-->
    <!-- banner-area-end -->

    <!-- product-area-start -->
    <!--include('frontend.indexContent.productArea_2')-->
    <!-- product-area-end -->

    <!--hot-contact-area-start -->
    <!--include('frontend.indexContent.hot-contact')-->
    <!-- hot-contact-area-end -->

    <!-- product-area-start -->
    <!--include('frontend.indexContent.productArea_3')-->
    <!-- product-area-end -->

    <!-- banner-area-start -->
    <!--include('frontend.indexContent.banner2')-->
    <!-- banner-area-end -->

    <!-- brand-product-area-start -->
    <!--include('frontend.indexContent.brandProduct')-->
    <!-- brand-product-area-end -->
    
    <!-- Category-area-start -->
    @include('frontend.indexContent.cartArea')
    <!-- cart-area-end -->
    
     <!-- All-product-area-start -->
    @include('frontend.indexContent.all_product')
    <!-- brand-product-area-end -->

    

    <!-- blog-area-start -->
    @include('frontend.indexContent.blogArea')

    <!-- blog-area-end -->
@endsection
