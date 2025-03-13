@extends('frontend.master')
@section('maincontent')

     <!-- breadcrumb-area-start -->
     <div class="breadcrumb__area my__breadcrumb"  style="margin-top:80px">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="tp-breadcrumb__content">
                        <div class="tp-breadcrumb__list">
                           <span class="tp-breadcrumb__active"><a href="{{ route('home') }}">Home</a></span>
                           <span class="dvdr">/</span>
                           <span>career</span>
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
                        <h3 class="tpcontact-inner-sub-title" style="font-size:16px">WE ARE HIRING</h3>
                           <p>Last Updated: 27/02/2024</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6 col-md-12 offset-lg-2">
                     <div class="tpcontact mb-30">
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Job Title</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p>Logistics and Operation Officer</p>
                           </div>
                        </div>
                     </div>
                  </div> 
                  <div class="col-lg-12 col-md-12 offset-lg-2">
                     <div class="tpcontact mb-30">
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Education</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p>H.S.C/ Equivalent.</p>
                           </div>
                        </div>
                     </div>
                  </div>  
                  <div class="col-lg-12 col-md-12 offset-lg-2">
                     <div class="tpcontact mb-30">
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Experience</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p>Fresher.</p>
                           </div>
                        </div>
                     </div>
                  </div>  
                  <div class="col-lg-12 col-md-12 offset-lg-2">
                     <div class="tpcontact mb-30">
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Requirements from the applicant</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p><strong>1.</strong> Checking the received orders from customers.</p>
                              <p><strong>2.</strong> Packing the order products in company standard and handover to delivery person.</p>
                              <p><strong>3.</strong> Inventory management</p>
                              <p><strong>4.</strong> Keeping communication with page and website moderators.</p>
                              <p><strong>5.</strong> Having basic computer literacy on using microsoft office and use of email.</p>
                              <p><strong>6.</strong> Understanding of Bengali and English language.</p>
                              <p><strong>7.</strong> Having experience of working in similar line will be preferred.</p>
                              <p><strong>8.</strong> Good interpersonal, communication, people management skills.</p>
                           </div>
                        </div>
                     </div>
                  </div> 
                  <div class="col-lg-12 col-md-12 offset-lg-2">
                     <div class="tpcontact mb-30">
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Employment Status</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p><strong>Full Time</strong></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12 offset-lg-2">
                     <div class="tpcontact mb-30">
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Job Location</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p><strong>Banasree (Dhaka)</strong></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12 offset-lg-2">
                     <div class="tpcontact mb-30">
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Salary</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p><strong>Negotiable</strong></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12 offset-lg-2">
                     <div class="tpcontact mb-30">
                        <div class="tplocation__text">
                           <h4 class="tplocation__text-title">Please Send your CV to sobrokom.store@gmail.com</h4>
                           <div class="tplocation__content tplocation__content-two">
                              <p><strong>Note: </strong> CV must be submitted within 7 days after job publish</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- feature-area-start -->
            @include('frontend.body.servicesfooter')
         <!-- feature-area-end -->
@endsection
