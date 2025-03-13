@extends('frontend.master')
@section('maincontent')
  <!-- breadcrumb-area-start -->
  <div class="breadcrumb__area my__breadcrumb" style="margin-top:80px">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="tp-breadcrumb__content">
                        <div class="tp-breadcrumb__list">
                           <span class="tp-breadcrumb__active"><a style="color:#9e54a1" href="{{ route('home') }}">Home</a></span>
                           <span class="dvdr">/</span>
                           <span>About Us</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- breadcrumb-area-end -->

         <!-- contact-area-start -->
         <section class="contact-area mb-45">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-lg-6">
                     <div class="tpcontact-inner text-center mt-20 mb-40">
                        <div class="tpcontact-inner-text">
                           <h5 class="tpcontact-inner-sub-title"  style="font-size:16px">about us</h5>
                           <h5 class="tpcontact-inner-title mb-20">Welcome to <a style="color:#9e54a1" href="{{ route('home') }}"> sobrokom.store </a> !</h5>
                           <p style="text-align: justify;">At <a style="color:#9e54a1" href="{{ route('home') }}"> sobrokom.store,</a>  we believe in more than just providing products; we are committed to delivering an unparalleled shopping experience. Founded in 2024, we have evolved into a one-stop destination for all your needs, offering a diverse range of high-quality products that blend style, functionality, and affordability</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact mb-30">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Our Mission</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p>Our mission is to empower individuals to express their unique style and meet their lifestyle needs effortlessly. We curate a collection that not only reflects the latest trends but also caters to the diverse tastes of our customers. Whether you're seeking fashion-forward apparel, cutting-edge electronics, or home essentials, <a style="color:#9e54a1" href="{{ route('home') }}"> sobrokom.store </a> is here to exceed your expectations.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact mb-30">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Quality Assurance</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p>At <a style="color:#9e54a1" href="{{ route('home') }}"> sobrokom.store,</a>  quality is our top priority. We partner with reputable suppliers and conduct rigorous quality checks to ensure that every product meets our stringent standards. Your satisfaction and confidence in our products drive us to continuously improve and innovate.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact mb-30">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Customer-Centric Approach</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p>We understand the importance of excellent customer service. Our dedicated support team is always ready to assist you, whether you have questions about products, need help with your order, or want advice on the latest trends. Your happiness is our success, and we go the extra mile to ensure your shopping experience is seamless and enjoyable.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact mb-30">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Sustainability Initiatives</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p>As part of our commitment to a better world, we actively pursue sustainable practices. We strive to reduce our environmental footprint by using eco-friendly packaging, sourcing ethically produced goods, and supporting initiatives that promote a greener planet.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact mb-30">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Join Our Community</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p> <a style="color:#9e54a1" href="{{ route('home') }}"> sobrokom.store </a> is more than just a marketplace; it's a community. Connect with us on social media to stay updated on the latest arrivals, exclusive promotions, and be a part of our growing family. We value your feedback and suggestions as they guide us in enhancing your shopping experience.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact mb-30">
                        <div class="tplocation__text">
                           <div class="tplocation__content tplocation__content-two">
                              <p>Thank you for choosing <a style="color:#9e54a1" href="{{ route('home') }}"> sobrokom.store.</a>  We look forward to serving you and being a part of your journey.</p>
                              <p->Happy Shopping!</p->
                              <h4 class="tplocation__text-title"> <a style="color:#9e54a1" href="{{ route('home') }}"> Sobrokom.store </a> Team</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- contact-area-end -->

         <!-- feature-area-start -->
         @include('frontend.body.servicesfooter')
         <!-- feature-area-end -->

@endsection
