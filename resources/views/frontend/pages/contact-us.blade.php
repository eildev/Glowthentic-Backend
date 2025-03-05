@extends('frontend.master')
@section('maincontent')
    <!-- breadcrumb-area-start -->
    <div class="breadcrumb__area my__breadcrumb"  style="margin-top:80px">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-breadcrumb__content">
                        <div class="tp-breadcrumb__list">
                            <span class="tp-breadcrumb__active"><a href="{{ route('home') }}">Home</a></span>
                            <span class="dvdr">/</span>
                            <span>Contact Us</span>
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
                    <div class="tpcontact-inner text-center mt-20">
                        <div class="tpcontact-inner-text">
                            <h5 class="tpcontact-inner-sub-title" style="font-size:16px">Connect With Us</h5>
                            <p style="text-align:justify;">Follow us on <a style="color:#9e54a1"
                                    href="https://www.facebook.com/profile.php?id=100094627520182">Facebook</a> to stay
                                updated on company news, culture, and job opportunities.
                                Join us at sobrokom.store and be a part of a dynamic team that is redefining online
                                shopping!</p>
                            <h5 class="mt-60">Or drop us a line through the form below and we will get back to you</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

    <!-- map-area-start -->
    <section class="map-area tpmap__box">
        <div class="container">
            <div class="row gx-0">
                <div class="col-lg-8 col-md-8 m-auto order-md-2">
                    <div class="tpform__wrapper pb-80">
                        <div class="tpform__box">
                            <form>
                                <div class="row gx-7">
                                    <div class="col-lg-6">
                                        <div class="tpform__input mb-20">
                                            <input name="name" id="name" type="text" placeholder="Your Name *">

                                            <span class="name_error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tpform__input mb-20">
                                            <input name="email" id="email" type="email" placeholder="Your Email *">
                                            <span class="email_error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tpform__input mb-20">
                                            <input name="subject" id="subject" type="text" placeholder="Subject *">
                                            <span class="subject_error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tpform__input mb-20">
                                            <input name="phone" id="phone" type="text" placeholder="Phone">
                                            <span class="phone_error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="tpform__textarea">
                                            <textarea name="message" id="message" placeholder="Message"></textarea>
                                            <span class="message_error text-danger"></span>

                                            <div class="tpform__textarea-check mt-20 mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input accept_terms" name="accept_terms"
                                                        type="checkbox" value="" id="accept_terms">
                                                    <label class="form-check-label" for="accept_terms">
                                                        I am bound by the terms of the <a target="_blank"
                                                            href="{{ route('termsandcondition') }}">Service I accept Privacy
                                                            Policy.</a>
                                                    </label>
                                                </div>
                                            </div>

                                            <button class="contact_us_btn">Send message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- map-area-end -->

    <script>
        const contact_us_btn = document.querySelector('.contact_us_btn');
        contact_us_btn.addEventListener('click', function(e) {
            e.preventDefault();

            // Check if the "Accept Terms & Conditions" checkbox is checked
            let acceptTermsCheckbox = document.querySelector('.accept_terms');
            if (!acceptTermsCheckbox.checked) {
                toastr.warning('Please accept our terms and conditions to contact With us.');
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            let name = document.querySelector('#name').value;
            let email = document.querySelector('#email').value;
            let subject = document.querySelector('#subject').value;
            let phone = document.querySelector('#phone').value;
            let message = document.querySelector('#message').value;

            if (name === "") {
                document.querySelector('.name_error').textContent = 'Name is Required';
            }
            if (email === "") {
                document.querySelector('.email_error').textContent = 'Email is Required';
            }
            if (subject === "") {
                document.querySelector('.subject_error').textContent = 'Subject is Required';
            }
            if (phone === "") {
                document.querySelector('.phone_error').textContent = 'Phone is Required';
            }
            if (message === "") {
                document.querySelector('.message_error').textContent = 'Message is Required';
            }
            $.ajax({
                url: '/contact-message/save',
                type: 'POST',
                data: {
                    'name': name,
                    'email': email,
                    'subject': subject,
                    'phone': phone,
                    'message': message
                },
                success: function(success_response) {


                    if (success_response.status == 200) {
                        toastr.success(success_response.message);
                        document.querySelector('#name').value = '';
                        document.querySelector('#email').value = '';
                        document.querySelector('#subject').value = '';
                        document.querySelector('#phone').value = '';
                        document.querySelector('#message').value = '';
                    } else {
                        toastr.warning(success_response.error.name);
                        toastr.warning(success_response.error.email);
                        toastr.warning(success_response.error.subject);
                        toastr.warning(success_response.error.message);
                    }
                    // console.log(success_response.message);

                }
            });
        });
    </script>


    <!-- feature-area-start -->
    @include('frontend.body.servicesfooter')
    <!-- feature-area-end -->
@endsection
