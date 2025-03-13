@extends('frontend.master')
@section('maincontent')
    <!-- breadcrumb-area-start -->
    <div class="breadcrumb__area my__breadcrumb" style="margin-top:80px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-breadcrumb__content">
                        <div class="tp-breadcrumb__list">
                            <span class="tp-breadcrumb__active"><a href="{{ route('home') }}">Home</a></span>
                            <span class="dvdr">/</span>
                            <span>FAQs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- faq-area-start -->
    <section class="faq-area pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="tpfaq__content mr-50">
                        <h4 class="tpfaq__title">How can we help you?</h4>
                        <p><a style="color:#9e54a1" href="https://sobrokom.store">Sobrokom's</a> Return Policy is very easy
                            to process. If
                            you face any problem
                            with to return policy feel free to communicate with our team.</p>
                        <span>Follow the steps below for a seamless returns process:</span>
                        <ul>
                            <li>
                                – The return shipping will be at your own expense.
                            </li>
                            <li>
                                – The product must be unused, unworn, unwashed, and without any flaws.
                            </li>
                            <li>
                                – The product must include the original tags, user manual, and accessories.
                            </li>
                            <li>
                                – The product must be returned in the original and undamaged manufacturer packaging/box.
                            </li>
                            <li>
                                – Exchange request is made within the stated time frame/limit. The item(s) is faulty,
                                damaged, or defective at the time of delivery.
                            </li>
                            <li>
                                – The received product(s) must have differed from the original order.
                            </li>
                            <li>
                                – The courier/ delivery man will wait at customer points in case the customer wants to
                                receive the product after a trial, a maximum of 10-15 minutes. (Only for Cash on Delivery).
                            </li>
                            <li>
                                – Please note that refunds can’t be processed for any consequential
                            </li>
                        </ul>
                        <p>
                            You will receive an email once your return has been processed. Please allow 06 – 12 business
                            days from the time your package arrives back to us for a refund to be issued.
                        </p>
                    </div>

                    <div class="tpfaq__item">
                        <h4 class="tpfaq__title mb-20">Order & Returns</h4>
                        <div class="accordion" id="accordionPanelsStayOpenExample3">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseSeven">
                                        How do I know if my order was successful?
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingSeven">
                                    <div class="accordion-body">
                                        You can use our search engine or just explore the website to find the product you're
                                        looking for. Once you've added them to your shopping cart, click "Place Order" to
                                        provide us with your name, address, and phone number. We will send an OTP number to
                                        your phone for that purpose; if you enter it correctly, you're done. To deliver your
                                        order, a Sobrokom representative will come to your house or place of business.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingEight">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseEight" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseEight">
                                        How do you deliver?
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingEight">
                                    <div class="accordion-body">
                                        Utilizing our proprietary fleet, we aim to ensure the timely delivery of products
                                        right to your doorstep. Our primary objective is to consistently meet delivery
                                        deadlines and provide you with a reliable and punctual service.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingNine">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseNine" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseNine">
                                        Should I tip the delivery representative?
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingNine">
                                    <div class="accordion-body">
                                        Although tipping is not obligatory, our delivery team members value acknowledgment
                                        for their dedication. The entire tip amount goes directly to the delivery
                                        representatives as a token of appreciation for their hard work.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tpfaq">
                        <div class="tpfaq__item mb-45">
                            <h4 class="tpfaq__title mb-40">Shopping Information</h4>
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOne">
                                            How does the site work?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            You can use our search engine or just explore the website to find the product
                                            you're looking for. Once you've added them to your shopping cart, click "Place
                                            Order" to provide us with your name, address, and phone number. We will send an
                                            OTP number to your phone for that purpose; if you enter it correctly, you're
                                            done. To deliver your order, a Sobrokom representative will come to your house
                                            or place of business.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                            aria-controls="panelsStayOpen-collapseTwo">
                                            How much do deliveries cost?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            The delivery fee across the country is in the table below:
                                            <br>
                                            <br>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Place
                                                        </th>
                                                        <th>
                                                            Orders below 2KG
                                                        </th>
                                                        <th>
                                                            Orders above 2KG
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            In Side Dhaka
                                                        </td>
                                                        <td>
                                                            80
                                                        </td>
                                                        <td>Per KG 20 Tk Extra</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Out Side Dhaka
                                                        </td>
                                                        <td>
                                                            140
                                                        </td>
                                                        <td>Per KG 20 Tk Extra</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                            aria-controls="panelsStayOpen-collapseThree">
                                            Why should we buy from you when I have a store nearby?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingThree">
                                        <div class="accordion-body">
                                            That's up to you, however you could also order delivery of your things and be as
                                            lazy as our founders. At times, our costs are less expensive than those of the
                                            city's largest superstores. In comparison to the typical corner store, we also
                                            carry a wider selection. Thus, there's no excuse not to purchase from us.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            How can I contact you?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingThree">
                                        <div class="accordion-body">
                                            You can always call +880 1602 08 51 21 or mail us at sobrokom.store@gmail.com or
                                            info@sobrokom.store.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tpfaq__item mb-45">
                            <h4 class="tpfaq__title mb-20">Payment information</h4>
                            <div class="accordion" id="accordionPanelsStayOpenExample2">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                            How do I pay?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingFour">
                                        <div class="accordion-body">
                                            We accept cash on delivery and we also take online payment system Nagad & Bkash.
                                            Our Sobrocom staff is always here to help you, so don't worry.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                            My order is wrong. What do I do?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingFive">
                                        <div class="accordion-body">
                                            Please immediately call +880 1602 08 51 21 or mail us at
                                            sobrokom.store@gmail.com or
                                            info@sobrokom.store. and let us know the problem.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                                            What about the prices?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingSix">
                                        <div class="accordion-body">
                                            While our pricing is independently determined, our utmost endeavor is to present
                                            you with competitive rates, striving to match or undercut prevailing market
                                            prices. We align our prices with the local market, and our relentless efforts
                                            are focused on further reducing them. Should you perceive any product to be
                                            unfairly priced, we encourage you to bring it to our attention, as we are
                                            committed to ensuring fairness and transparency in our pricing strategy.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tpfaq__item">
                            <h4 class="tpfaq__title mb-20">Our Facilities</h4>
                            <div class="accordion" id="accordionPanelsStayOpenExample3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
                                            What is your discounting policy?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingSeven">
                                        <div class="accordion-body">
                                            In Dhaka, our commitment is to offer unparalleled deals, with numerous products
                                            already marked down below their maximum retail price (MRP). Additionally, we
                                            extend special discount codes in specific situations, applied to the MRP. It's
                                            important to note that for any given product, only one type of discount can be
                                            applied. We consistently prioritize providing customers with the most
                                            advantageous discount available, ensuring a cost-effective and rewarding
                                            shopping experience.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingNine">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseNine"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseNine">
                                            Can I change the registered Phone number/Email address of my Sobrokom account?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingNine">
                                        <div class="accordion-body">
                                            Yes, you can change your registered phone number or email address. First you go
                                            to your profile then, here you can change your personal information as you wish.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq-area-end -->



    <!-- feature-area-start -->
    @include('frontend.body.servicesfooter')
    <!-- feature-area-end -->
@endsection
