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
                           <span>Terms & Conditions</span>
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
                           <h5 class="tpcontact-inner-sub-title" style="font-size:16px">Terms & conditions</h5>
                         </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">1. Acceptance of Terms</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p>By accessing and using <a style="color:#9e54a1" href="{{ route('home') }}">sobrokom.store</a>, you agree to comply with and be bound by these Terms and Conditions. If you do not agree to these terms, please refrain from using the website.</p>
                           </div>
                        </div>
                     </div>
                  </div>  
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">2. Use of the Website</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p><strong>2.1 Eligibility:</strong> You must be at least 18 years old to use this website. By using the website, you affirm that you are at least 18 years of age.</p>
                              <p><strong>2.2 Account Information:</strong> You are responsible for maintaining the confidentiality of your account information and password. You agree to accept responsibility for all activities that occur under your account.</p>
                           </div>
                        </div>
                     </div>
                  </div> 
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">3. Product Information</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p><strong>3.1 Product Descriptions:</strong> We strive to provide accurate and up-to-date information regarding our products. However, we do not guarantee the accuracy, completeness, or reliability of any product descriptions.</p>
                              <p><strong>3.2 Pricing:</strong> Prices are subject to change without notice. We reserve the right to modify or discontinue any product or service without notice.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">4. Ordering and Payment</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p><strong>4.1 Order Acceptance:</strong> Your order is an offer to buy, and we reserve the right to accept or decline it at our discretion.</p>
                              <p><strong>4.2 Payment:</strong> All payments are processed securely. We accept online payment (Bkash and Nogod) and cash on delivery payment.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">5. Shipping and Delivery</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p> <strong>5.1 Shipping Costs:</strong> Shipping costs are calculated during the checkout process. Additional charges may apply for international orders.</p>
                              <p> <strong>5.2 Delivery Times:</strong> Delivery times may vary based on your location and product availability. We are not responsible for any delays caused by third-party carriers</p>
                           </div>
                        </div>
                     </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">6. Returns and Refunds</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p> <strong> 6.1 Return Policy:</strong> Please refer to our [Return Policy] page for information on returns and exchanges.</p>
                              <p> <strong> 6.2 Refunds:</strong> Refunds will be issued in accordance with our [Refund Policy].</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">7. Intellectual Property</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p> <strong>7.1 Ownership:</strong> All content on this website, including text, graphics, logos, images, and software, is the property of [Your E-commerce Website] and is protected by intellectual property laws.</p>
                              <p> <strong>7.2 Use of Content:</strong> You may not reproduce, distribute, display, or create derivative works from any content without our express written permission.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">8. Privacy Policy</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p> Please refer to our [Privacy Policy] for information on how we collect, use, and disclose your personal information.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">9. Governing Law</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p> These Terms and Conditions are governed by and construed in accordance with the laws of Bangladesh.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">10. Changes to Terms</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p> We reserve the right to update or modify these Terms and Conditions at any time. It is your responsibility to review them periodically.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="tpcontact">
                        <div class="tpcontact__img mb-15 w-img">
                           <img src="assets/img/banner/contact-big-bg1.jpg" alt="">
                        </div>
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Contact Information</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p> For any questions regarding these Terms and Conditions, please contact us at <a style="color:#9e54a1" href="mailto:www.sobrokom.store@gmail.com">sobrokom.store@gmail.com</a></p>
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
