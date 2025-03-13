<div class="tpshop__top ml-60">
    <div class="product__filter-content mb-40">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="tpproductnav tpnavbar product-filter-nav d-flex align-items-center justify-content-center">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link {{ !empty(Auth::user()->billing->id) ? 'active' : '' }}" id="nav-popular-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-popular" type="button" role="tab" aria-controls="nav-popular"
                                aria-selected="true">
                                <i class="icon-eye"></i> Billing Details
                            </button>
                            <button class="nav-link {{ !empty(Auth::user()->billing->id) ? '' : 'active' }}" id="nav-product-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-product" type="button" role="tab" aria-controls="nav-product"
                                aria-selected="false">
                                <i class="fas fa-gear"></i> Manage Information
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">


        @php
            $billingInfo = App\Models\BillingInfo::where('user_id', Auth::user()->id)->first();
        @endphp
        {{-- tab 2 details  --}}
        <div class="tab-pane fade show {{ !empty(Auth::user()->billing->id) ? 'active' : '' }} whight-product" id="nav-popular" role="tabpanel"
            aria-labelledby="nav-popular-tab">
            <div class="row">
                <div class="tab_card d-flex align-items-center justify-content-between mb-20">
                    @if ($billingInfo)
                        <div class="col-lg-12">
                            <div class="your-order mb-30 ">
                                <h3>Your Details</h3>
                                <div class="your-order-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">First Name</th>
                                                <th class="product-total">{{ $billingInfo->first_name ?? '' }}</th>
                                                <th class="product-name">Last Name</th>
                                                <th class="product-total">{{ $billingInfo->last_name ?? '' }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    Email
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ $billingInfo->email ?? '' }}</span>
                                                </td>
                                                <td class="product-name">
                                                    Phone
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ $billingInfo->phone ?? '' }}</span>
                                                </td>
                                            </tr>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    Address 1
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ $billingInfo->address_1 ?? '' }}</span>
                                                </td>
                                                <td class="product-name">
                                                    Address 2
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ $billingInfo->address_2 ?? '' }}</span>
                                                </td>
                                            </tr>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    City
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ $billingInfo->city ?? '' }}</span>
                                                </td>
                                                <td class="product-name">
                                                    Division
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ $billingInfo->division ?? '' }}</span>
                                                </td>
                                            </tr>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    Post Code
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ $billingInfo->post_code ?? '' }}</span>
                                                </td>
                                                <td class="product-name">
                                                    Country
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ $billingInfo->country ?? '' }}</span>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="payment-method">
                                    <div class="order-button-payment mt-20 mx-auto">
                                        {{-- <button type="submit"
                                            class="tp-btn tp-color-btn w-50 mx-auto banner-animation">Update Billing
                                            Information</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <div class="order-button-payment mt-20 mx-auto">
                                <button type="submit" class="tp-btn tp-color-btn w-50 mx-auto banner-animation">Add
                                    Billing Information</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- tab-3 details  --}}
        <div class="tab-pane fade whight-product {{ !empty(Auth::user()->billing->id) ? '' : 'active show' }}" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab_card d-flex align-items-center justify-content-between mb-20">
                        <form id="addBillinForm" method="POST" action="">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkbox-form">
                                        <h3>Your Information</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkout-form-list">
                                                    <label>First Name <span class="required">*</span></label>
                                                    <input type="text" placeholder="First Name" class="first_name"
                                                        value="{{ $billingInfo->first_name ?? '' }}"
                                                        name="first_name">
                                                    <span class="first_name_error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="checkout-form-list">
                                                    <label>Last Name <span class="required">*</span></label>
                                                    <input type="text" placeholder="Last Name" class="last_name"
                                                        value="{{ $billingInfo->last_name ?? '' }}" name="last_name">
                                                    <span class="last_name_error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-form-list">
                                                    <label>Email Address</label>
                                                    <input type="email" placeholder="Email"
                                                        value="{{ $billingInfo->email ?? '' }}" class="email"
                                                        name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-form-list">
                                                    <label>Phone <span class="required">*</span></label>
                                                    <input type="text" placeholder="Phone"
                                                        value="{{ $billingInfo->phone ?? '' }}" class="phone"
                                                        name="phone">
                                                    <span class="phone_error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Address 1<span class="required">*</span></label>
                                                    <input type="text" placeholder="Address 1"
                                                        value="{{ $billingInfo->address_1 ?? '' }}" class="address_1"
                                                        name="address_1">
                                                    <span class="address_1_error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Address 2</label>
                                                    <input type="text" placeholder="Address 2"
                                                        value="{{ $billingInfo->address_2 ?? '' }}" class="address_2"
                                                        name="address_2">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-form-list">
                                                    <label>City/Town<span class="required">*</span></label>
                                                    <input type="text" placeholder="City/Town"
                                                        value="{{ $billingInfo->city ?? '' }}" class="city"
                                                        name="city">
                                                    <span class="city_error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-form-list">
                                                    <label>Division <span class="required">*</span></label>
                                                    <input type="text" placeholder="Division"
                                                        value="{{ $billingInfo->division ?? '' }}" class="division"
                                                        name="division">
                                                    <span class="division_error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="checkout-form-list">
                                                    <label>Postcode / Zip <span class="required">*</span></label>
                                                    <input type="text" placeholder="Postcode / Zip"
                                                        value="{{ $billingInfo->post_code ?? '' }}" class="post_code"
                                                        name="post_code">
                                                    <span class="post_code_error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="country-select">
                                                    <label>Country <span class="required">*</span></label>
                                                    <select name="country" class="country"
                                                        value="{{ $billingInfo->country ?? '' }}">
                                                        <option value="">Select Country</option>
                                                        <option value="united-states">United States</option>
                                                        <option value="algeria">Algeria</option>
                                                        <option value="bangladesh">Bangladesh</option>
                                                        <option value="canada">Canada</option>
                                                        <option value="germany">Germany</option>
                                                        <option value="england">England</option>
                                                        <option value="qatar">Qatar</option>
                                                    </select>
                                                    <span class="country_error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="order-notes">
                                                <div class="checkout-form-list">
                                                    <label>Order Notes</label>
                                                    <textarea id="checkout-mess" cols="30" rows="10" class="order_notes" name="order_notes"
                                                        placeholder="Notes about your order, e.g. special notes for delivery.">{{ $billingInfo->order_notes ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <div class="order-button-payment mt-20 w-50 mx-auto">
                                                <button type="submit"
                                                    class="tp-btn tp-color-btn w-100 banner-animation add_billing_details">Add
                                                    Billing
                                                    Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
    // Add Billing Details
    const add_billing_details = document.querySelector('.add_billing_details');
    add_billing_details.addEventListener('click', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const user_id = "{{ Auth::user()->id }}";
        const first_name = document.querySelector('.first_name').value;
        const last_name = document.querySelector('.last_name').value;
        const email = document.querySelector('.email').value;
        const phone = document.querySelector('.phone').value;
        const address_1 = document.querySelector('.address_1').value;
        const address_2 = document.querySelector('.address_2').value;
        const city = document.querySelector('.city').value;
        const division = document.querySelector('.division').value;
        const post_code = document.querySelector('.post_code').value;
        const country = document.querySelector('.country').value;
        const order_notes = document.querySelector('.order_notes').value;

        $.ajax({
            url: "/billing/insert",
            type: "POST",
            data: {
                "user_id": user_id,
                "first_name": first_name,
                "last_name": last_name,
                "email": email,
                "phone": phone,
                "address_1": address_1,
                "address_2": address_2,
                "city": city,
                "division": division,
                "post_code": post_code,
                "country": country,
                "order_notes": order_notes
            },
            success: function(res) {
                // console.log(res);
                if (res.status == 200) {
                    toastr.success(res.message);
                    console.log(res.billing);
                    document.querySelector('.first_name').value = res.billing.first_name;
                    document.querySelector('.last_name').value = res.billing.last_name;
                    document.querySelector('.email').value = res.billing.email;
                    document.querySelector('.phone').value = res.billing.phone;
                    document.querySelector('.address_1').value = res.billing.address_1;
                    document.querySelector('.address_2').value = res.billing.address_2;
                    document.querySelector('.city').value = res.billing.city;
                    document.querySelector('.division').value = res.billing.division;
                    document.querySelector('.post_code').value = res.billing.post_code;
                    document.querySelector('.country').value = res.billing.country;
                    document.querySelector('.order_notes').value = res.billing.order_notes;
                } else {
                    document.querySelector('.first_name_error').innerText = res.error.last_name;
                    document.querySelector('.last_name_error').innerText = res.error.first_name;
                    document.querySelector('.phone_error').innerText = res.error.phone;
                    document.querySelector('.address_1_error').innerText = res.error.address_1;
                    document.querySelector('.city_error').innerText = res.error.city;
                    document.querySelector('.division_error').innerText = res.error.division;
                    document.querySelector('.post_code_error').innerText = res.error.post_code;
                    document.querySelector('.country_error').innerText = res.error.country;
                }
            },
        });

    });


    // document.addEventListener('DOMContentLoaded', function() {
    //     document.getElementById('addBillingForm').addEventListener('submit', function(e) {
    //         e.preventDefault();

    //         let formData = new FormData(this);
    //         console.log(formData);


    //     });
    // });
</script>
