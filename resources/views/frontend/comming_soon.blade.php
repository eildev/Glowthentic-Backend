
<!doctype html>
<html class="no-js" lang="zxx">
   <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SOBROKOM | Let's Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ajax Header -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend') }}/assets/img/logo/favicon.svg">

    <!-- CSS here -->
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/animate.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/swiper-bundle.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/magnific-popup.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/spacing.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/meanmenu.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/nice-select.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/fontawesome.min.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/icon-dukamarket.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/jquery-ui.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/main.css">
   </head>
   <body>


      <!-- Scroll-top -->
      <button class="scroll-top scroll-to-target" data-target="html">
         <i class="icon-chevrons-up"></i>
      </button>
      <!-- Scroll-top-end-->


      <main>

         <!-- comming-soon-area-start -->
         <section class="commoing-soon-area grey-bg pt-75 pb-75">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg-5 col-md-6">
                     <div class="tpsoon">
                        <h4 class="tpsoon__sub-title mb-15">Coming soon</h4>
                        <h2 class="tpsoon__title mb-30">Sobrokom | Let's Shop<br> Will Be Available Soon</h2>
                        <p>We are currently working on an awesome new site. Your personal details <br>
                           are strictly for our use, and you can unsubscribe at any time.</p>
                        <div class="tpsoon__submit-form  mb-50">
                           <form action="#">
                              <div class="tpsoon__submit-wrapper">
                                 <div class="tpsoon__input mb-10 mr-10">
                                    <input type="email" placeholder="Your email address...">
                                    <span><img src="{{ asset('frontend') }}/assets/img/shape/message-1.svg" alt=""></span>
                                 </div>
                                 <div class="tpsoon__submit">
                                    <button class="tp-btn-3">Subscribe</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                        {{-- <div class="rainbow__social mb-15">
                           <a href="#"><i class="fab fa-twitter"></i></a>
                           <a class="rainbow__facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                           <a class="rainbow__pin" href="#"><i class="fab fa-pinterest-p"></i></a>
                           <a class="rainbow__skype" href="#"><i class="fab fa-skype"></i></a>
                           <a class="rainbow__youtube" href="#"><i class="fab fa-youtube"></i></a>
                        </div> --}}
                        <div class="tpsoon__copyright">
                           <span>Copyright <a href="https://sobrokom.store/">© Sobrokom</a> all rights reserved. Powered by <a href="https://eclipseintellitech.com/">Eclipse Intellitech Limited</a>.</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-7 col-md-6">
                     <div class="tpsoon__thumb p-relative w-img">
                        <img src="{{ asset('temp') }}/comming-soon-banner.png" alt="">
                        <div class="tpsoon__shape d-none d-md-block">
                           <div class="tpsoon__shape-one">
                              <img src="{{ asset('temp') }}/comming-shae-1.png" alt="">
                           </div>
                           <div class="tpsoon__shape-two">
                              <img src="{{ asset('temp') }}/comming-shae-2.png" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- comming-soon-area-end -->

      </main>

      <!-- JS here -->
      <script src="{{ asset('frontend') }}/assets/js/jquery.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/waypoints.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/bootstrap.bundle.min.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/swiper-bundle.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/nice-select.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/slick.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/magnific-popup.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/counterup.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/wow.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/isotope-pkgd.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/imagesloaded-pkgd.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/countdown.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/ajax-form.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/jquery-ui.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/meanmenu.js"></script>
      <script src="{{ asset('frontend') }}/assets/js/main.js"></script>
   </body>
</html>
