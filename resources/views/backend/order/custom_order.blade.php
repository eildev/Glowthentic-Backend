@extends('backend.master')
@section('admin')
<div class="page-content p-4 bg-light">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body">
            <h4 class="mb-4 text-primary fw-bold">Custom Order Management</h4>
            <hr class="border-primary">

            <!-- Form Section -->
            <form id="orderForm">
                <div class="row g-4 mb-5">
                    <!-- Customer and Billing Information -->
                    <div class="col-12">
                        <h5 class="mb-3 fw-bold">Customer & Billing Information</h5>
                        <hr>
                        <div class="row g-3">
                            <!-- User Selection -->
                            <div class="col-12 col-sm-12 col-md-3">
                                <label for="customUserSelect" class="form-label fw-medium">Select User</label>
                                <select class="form-select getdata shadow-sm" id="customUserSelect" name="custom_user_id">
                                    <option selected disabled value="">Choose...</option>
                                    @foreach ($custom_user as $user)
                                        <option value="{{ $user['id'] }}" data-source="{{ $user['source'] }}">
                                            {{ $user['name'] }} ({{ $user['source'] == 'user' ? 'Registered User' : 'Unlinked Detail' }})
                                        </option>
                                    @endforeach
                                    <option value="other">Other</option>
                                </select>
                                <span class="error-message error-custom_user_id text-danger"></span>
                            </div>
                            <!-- Full Name -->
                            <div class="col-12 col-sm-12 col-md-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control">
                                <span class="error-message error-full_name text-danger"></span>
                            </div>
                            <!-- Secondary Email -->
                            <div class="col-12 col-sm-12 col-md-3">
                                <label for="secondary_email" class="form-label">Secondary Email</label>
                                <input type="email" name="secondary_email" class="form-control">
                                <span class="error-message error-secondary_email text-danger"></span>
                            </div>
                            <!-- Phone Number -->
                            <div class="col-12 col-sm-12 col-md-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control">
                                <span class="error-message error-phone_number text-danger"></span>
                            </div>
                            <!-- City -->
                            <div class="col-12 col-sm-12 col-md-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="district" class="form-control">
                                <span class="error-message error-city text-danger"></span>
                            </div>
                            <!-- Postal Code -->
                            <div class="col-12 col-sm-12 col-md-3">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control">
                                <span class="error-message error-postal_code text-danger"></span>
                            </div>
                            <!-- Police Station -->
                            <div class="col-12 col-sm-12 col-md-3">
                                <label for="police_station" class="form-label">Police Station</label>
                                <input type="text" name="police_station" class="form-control">
                                <span class="error-message error-police_station text-danger"></span>
                            </div>
                            <!-- Country -->
                            <div class="col-12 col-sm-12 col-md-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" name="country" class="form-control">
                                <span class="error-message error-country text-danger"></span>
                            </div>
                            <!-- Payment Method -->
                            <div class="col-12 col-sm-12 col-md-3">
                                <label for="active_payment_method" class="form-label">Payment Method</label>
                                <select name="active_payment_method" class="form-select" id="paymentMethodSelect">
                                    <option value="COD" selected>Cash on Delivery</option>
                                    <option value="card">Card</option>
                                    <option value="mobile_banking">Mobile Banking</option>
                                </select>
                                <span class="error-message error-active_payment_method text-danger"></span>
                            </div>
                            <!-- Card Details -->
                            <div class="col-12 col-sm-12 col-md-3 card-section d-none">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input type="text" name="card_number" class="form-control">
                                <span class="error-message error-card_number text-danger"></span>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 card-section d-none">
                                <label for="cvc_code" class="form-label">CVC Code</label>
                                <input type="text" name="cvc_code" class="form-control">
                                <span class="error-message error-cvc_code text-danger"></span>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 card-section d-none">
                                <label for="card_expiry_date" class="form-label">Expiry Date</label>
                                <input type="text" name="card_expiry_date" class="form-control" placeholder="MM/YY">
                                <span class="error-message error-card_expiry_date text-danger"></span>
                            </div>
                            <!-- Mobile Banking Details -->
                            <div class="col-12 col-sm-12 col-md-3 mobile-section d-none">
                                <label for="mobile_banking_id" class="form-label">Mobile Banking ID</label>
                                <input type="text" name="mobile_banking_id" class="form-control">
                                <span class="error-message error-mobile_banking_id text-danger"></span>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 mobile-section d-none">
                                <label for="verified_mobile_number" class="form-label">Verified Mobile Number</label>
                                <input type="text" name="verified_mobile_number" class="form-control">
                                <span class="error-message error-verified_mobile_number text-danger"></span>
                            </div>
                            <!-- Address -->
                            <div class="col-12 col-sm-12 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="3"></textarea>
                                <span class="error-message error-address text-danger"></span>
                            </div>
                            <hr>
                            <h5 class="mb-3 fw-bold">Order Create</h5>
                            <!-- Product Selection -->
                            <div class="col-12 col-sm-12 col-md-4">
                                <label for="productSelect" class="form-label fw-medium">Select Product</label>
                                <select class="form-select product shadow-sm" id="productSelect" name="product_id">
                                    <option selected disabled value="">Choose...</option>
                                    @foreach ($product as $item)
                                        <option value="{{ $item['id'] }}" data-type="{{ $item['type'] }}">
                                            {{ $item['name'] }} ({{ ucfirst($item['type']) }})
                                        </option>
                                    @endforeach
                                </select>
                                <span class="error-message error-product_id text-danger"></span>
                            </div>
                            <!-- Variant Selection -->
                            <div class="col-12 col-sm-12 col-md-4">
                                <label for="variantSelect" class="form-label fw-medium">Select Variant</label>
                                <select class="form-select variant shadow-sm" id="variantSelect" name="variant_id">
                                    <option selected disabled value="">Choose...</option>
                                </select>
                                <span class="error-message error-variant_id text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Creation and Summary -->
                <div class="row g-4">
                    <!-- Custom Order Table -->
                    <div class="col-md-7">
                        <h5 class="mb-3 fw-bold">Create Custom Order</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered stock-table" style="display: none;">
                                <thead class="table-info text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Product Type</th>
                                        <th>Variant</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Discount/Unit</th>
                                        <th>Total Discount</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="customOrderVariant"></tbody>
                            </table>
                            <span class="error-message error-table text-danger"></span>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-md-5">
                        <h5 class="mb-3 fw-bold">Order Summary</h5>
                        <hr>
                        <div class="card shadow-sm p-4">
                            <div class="mb-3">
                                <label for="subtotal" class="form-label">Subtotal</label>
                                <input type="text" id="subtotal" class="form-control" name="subtotal" value="0.00" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="shippingInput" class="form-label">Shipping Charge</label>
                                <input type="number" id="shippingInput" class="form-control" name="shipping_charge" value="0" min="0">
                            </div>
                            <div class="mb-3">
                                <label for="tax" class="form-label">Tax (0%)</label>
                                <input type="text" id="tax" class="form-control" name="tax" value="0.00" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="discountInput" class="form-label">Discount</label>
                                <input type="number" id="discountInput" class="form-control" name="discount" value="0" min="0">
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="grandTotal" class="form-label fw-bold">Grand Total</label>
                                <input type="text" id="grandTotal" class="form-control fw-bold" name="grand_total" value="0.00" readonly>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.table-bordered th, .table-bordered td {
    vertical-align: middle;
}
.btn-primary, .btn-success {
    background-color: #9e54a1;
    border-color: #9e54a1;
}
.btn-primary:hover, .btn-success:hover {
    background-color: #7a3f7d;
    border-color: #7a3f7d;
}
.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}
.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}
.table-primary {
    background-color: #9e54a1;
    color: #ffffff;
}
.error-message {
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}
.form-control.is-invalid, .form-select.is-invalid {
    border-color: #dc3545;
    background-image: none;
}
.form-control.is-invalid:focus, .form-select.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}
</style>

<script>
$(document).ready(function() {
    // CSRF Token Setup
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });


    $('#paymentMethodSelect').on('change', function() {
        let method = $(this).val();
        $('.card-section').addClass('d-none');
        $('.mobile-section').addClass('d-none');
        if (method === 'card') {
            $('.card-section').removeClass('d-none');

            $('input[name="card_number"], input[name="cvc_code"], input[name="card_expiry_date"]').prop('required', true);
            $('input[name="mobile_banking_id"], input[name="verified_mobile_number"]').prop('required', false);
        } else if (method === 'mobile_banking') {
            $('.mobile-section').removeClass('d-none');

            $('input[name="mobile_banking_id"], input[name="verified_mobile_number"]').prop('required', true);
            $('input[name="card_number"], input[name="cvc_code"], input[name="card_expiry_date"]').prop('required', false);
        } else {

            $('input[name="card_number"], input[name="cvc_code"], input[name="card_expiry_date"]').prop('required', false);
            $('input[name="mobile_banking_id"], input[name="verified_mobile_number"]').prop('required', false);
        }
    });


    $(document).on('change', '.getdata', function() {
        let selectedOption = $(this).find('option:selected');
        let id = selectedOption.val();
        let source = selectedOption.data('source');

        if (id !== 'other' && id) {

            $('input[name="full_name"]').prop('readonly', true);
            $('input[name="secondary_email"]').prop('readonly', true);

            $.ajax({
                url: "{{ route('get.user.data') }}",
                type: 'POST',
                data: { id: id, source: source },
                success: function(data) {
                    if (data.user_data) {
                        $('input[name="full_name"]').val(data.user_data.name || data.user_data.full_name || '');
                        $('input[name="secondary_email"]').val(data.user_data.email || data.user_data.secondary_email || '');
                        $('input[name="phone_number"]').val(data.user_data.phone_number || '');
                        $('textarea[name="address"]').val(data.user_data.address || '');
                        $('input[name="city"]').val(data.user_data.city || '');
                        $('input[name="postal_code"]').val(data.user_data.postal_code || '');
                        $('input[name="police_station"]').val(data.user_data.police_station || '');
                        $('input[name="country"]').val(data.user_data.country || '');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error('Failed to fetch user data.');
                }
            });
        } else {

            $('input[name="full_name"]').val('').prop('readonly', false);
            $('input[name="secondary_email"]').val('').prop('readonly', false);
            $('input[name="phone_number"]').val('');
            $('textarea[name="address"]').val('');
            $('input[name="city"]').val('');
            $('input[name="postal_code"]').val('');
            $('input[name="police_station"]').val('');
            $('input[name="country"]').val('');
        }
    });


    $(document).on('change', '.product', function() {
        let id = $(this).val();
        let productType = $(this).find(':selected').data('type');
        let url1 = "{{ url('get/stock/product/variant') }}/" + id;
        let url2 = "{{ url('get/combo/custom/order') }}/" + id;

        if (productType === 'product') {
            $('.variant').attr('disabled', false);
            $.ajax({
                url: url1,
                type: 'GET',
                success: function(data) {
                    if (data.status === 200) {
                        let variants = data.variant;
                        let variantOptions = '<option selected disabled value="">Choose...</option>';
                        variants.forEach(function(variant) {
                            variantOptions += `<option value="${variant.id}">${variant.variant_name}</option>`;
                        });
                        $('.variant').html(variantOptions);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error('Failed to fetch variants.');
                }
            });
        } else if (productType === 'combo') {
            $('.variant').html('<option selected disabled value="">Choose...</option>');
            $('.variant').attr('disabled', true);

            $.ajax({
                url: url2,
                type: 'GET',
                success: function(data) {
                    $('.stock-table').fadeIn();
                    if (data.status === 200) {
                        let combo = data.combo;
                        $('.customOrderVariant').append(`
                            <tr>
                                <td>${$('.customOrderVariant tr').length + 1}</td>
                                <td><input value="${combo.name}" name="combo_name[]" readonly class="form-control-plaintext"></td>
                                <td><input value="combo" readonly name="combo_type[]" class="form-control-plaintext"></td>
                                <td>------</td>
                                <td>--------</td>
                                <td><input value="${combo.offerd_price}" readonly name="combo_price[]" class="form-control-plaintext regularPrice"></td>
                                <td><input type="number" value="0" class="form-control quantityInput" name="combo_quantity[]" min="0"></td>
                                <td>-------------</td>
                                <td><input type="text" class="form-control-plaintext total_discount" name="total_discount[]" value="0.00" readonly></td>
                                <td><input type="text" class="form-control-plaintext totalPrice" name="combo_total_price[]" value="0.00" readonly></td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button>
                                    <input type="hidden" name="combo_id[]" value="${combo.id}">
                                </td>
                            </tr>
                        `);
                        calculateSubtotal();
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error('Failed to fetch combo.');
                }
            });
        }
    });


    $(document).on('change', '.variant', function() {
        let id = $(this).val();
        $('.stock-table').fadeIn();
        $.ajax({
            url: "{{ url('get/variant/custom/order_info') }}/" + id,
            type: 'GET',
            success: function(data) {
                if (data.status === 200) {
                    let variants = data.variant;
                    $('.customOrderVariant').append(`
                        <tr>
                            <td>${$('.customOrderVariant tr').length + 1}</td>
                            <td><input value="${variants.product.product_name}" name="product_name[]" readonly class="form-control-plaintext"></td>
                            <td><input value="product" readonly name="type[]" class="form-control-plaintext"></td>
                            <td><input value="${variants.variant_name}" readonly name="variant_name[]" class="form-control-plaintext"></td>
                            <td><input value="${variants.product_stock.StockQuantity}" name="stock[]" readonly class="form-control-plaintext stockQty"></td>
                            <td><input value="${variants.regular_price}" readonly name="price[]" class="form-control-plaintext regularPrice"></td>
                            <td><input type="number" value="0" class="form-control quantityInput" name="quantity[]" min="0"></td>
                            <td><input type="number" value="${data.promotion}" data-discount="${data.promotion}" name="promotion[]" readonly class="form-control-plaintext discountPerUnit"></td>
                            <td><input type="text" class="form-control-plaintext total_variant_discount" name="total_discount[]" value="0.00" readonly></td>
                            <td><input type="text" class="form-control-plaintext totalPrice" name="variant_total_price[]" value="0.00" readonly></td>
                            <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button>
                                <input type="hidden" name="variant_id[]" value="${variants.id}">
                                <input type="hidden" name="product_id[]" value="${variants.product_id}">
                            </td>
                        </tr>
                    `);
                    calculateSubtotal();
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                toastr.error('Failed to fetch variant details.');
            }
        });
    });

    // Delete Row
    $(document).on('click', '.delete-row', function() {
        $(this).closest('tr').remove();

        $('.customOrderVariant tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
        calculateSubtotal();

        if ($('.customOrderVariant tr').length === 0) {
            $('.stock-table').fadeOut();
        }
    });


    $(document).on('input', '.quantityInput', function() {
        updateRow($(this));
        calculateSubtotal();
    });


    $(document).on('input', '#shippingInput, #discountInput', function() {
        calculateSubtotal();
    });


    function updateRow(input) {
        let row = input.closest('tr');
        let quantity = parseFloat(row.find('.quantityInput').val()) || 0;
        let regularPrice = parseFloat(row.find('.regularPrice').val()) || 0;
        let discountPerUnit = parseFloat(row.find('.discountPerUnit').data('discount')) || 0;

        let total = (regularPrice - discountPerUnit) * quantity;
        let totalDiscount = discountPerUnit * quantity;

        row.find('.totalPrice').val(total.toFixed(2));
        row.find('.total_discount').val(totalDiscount.toFixed(2));
    }


    function calculateSubtotal() {
        let subtotal = 0;
        let totalDiscount = 0;

        $('.totalPrice').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
        });

        $('.total_discount').each(function() {
            totalDiscount += parseFloat($(this).val()) || 0;
        });

        $('#subtotal').val(subtotal.toFixed(2));

        let shipping = parseFloat($('#shippingInput').val()) || 0;
        let discount = parseFloat($('#discountInput').val()) || 0;
        let tax = 0; // 0% tax

        $('#tax').val(tax.toFixed(2));

        let grandTotal = subtotal + tax + shipping - discount;
        $('#grandTotal').val(grandTotal.toFixed(2));
    }

    // Form Submission with Validation
    $('#orderForm').on('submit', function(e) {
        e.preventDefault();

        let isValid = true;


        $('.error-message').text('');
        $('.form-control, .form-select').removeClass('is-invalid');


        let fullName = $('input[name="full_name"]').val().trim();
        if (!fullName) {
            $('.error-full_name').text('Full name is required.');
            $('input[name="full_name"]').addClass('is-invalid');
            isValid = false;
        }


        let address = $('textarea[name="address"]').val().trim();
        if (!address) {
            $('.error-address').text('Address is required.');
            $('textarea[name="address"]').addClass('is-invalid');
            isValid = false;
        }


        let phone = $('input[name="phone_number"]').val().trim();
        if (!phone) {
            $('.error-phone_number').text('Phone number is required.');
            $('input[name="phone_number"]').addClass('is-invalid');
            isValid = false;
        } else if (!/^\d{10,15}$/.test(phone)) {
            $('.error-phone_number').text('Phone number must be 10-15 digits.');
            $('input[name="phone_number"]').addClass('is-invalid');
            isValid = false;
        }


        let paymentMethod = $('select[name="active_payment_method"]').val();
        if (!paymentMethod) {
            $('.error-active_payment_method').text('Please select a payment method.');
            $('select[name="active_payment_method"]').addClass('is-invalid');
            isValid = false;
        }


        if (paymentMethod === 'card') {
            let cardNumber = $('input[name="card_number"]').val().trim();
            let cvcCode = $('input[name="cvc_code"]').val().trim();
            let expiryDate = $('input[name="card_expiry_date"]').val().trim();

            if (!cardNumber) {
                $('.error-card_number').text('Card number is required.');
                $('input[name="card_number"]').addClass('is-invalid');
                isValid = false;
            } else if (!/^\d{16}$/.test(cardNumber)) {
                $('.error-card_number').text('Card number must be 16 digits.');
                $('input[name="card_number"]').addClass('is-invalid');
                isValid = false;
            }

            if (!cvcCode) {
                $('.error-cvc_code').text('CVC code is required.');
                $('input[name="cvc_code"]').addClass('is-invalid');
                isValid = false;
            } else if (!/^\d{3,4}$/.test(cvcCode)) {
                $('.error-cvc_code').text('CVC code must be 3-4 digits.');
                $('input[name="cvc_code"]').addClass('is-invalid');
                isValid = false;
            }

            if (!expiryDate) {
                $('.error-card_expiry_date').text('Expiry date is required.');
                $('input[name="card_expiry_date"]').addClass('is-invalid');
                isValid = false;
            } else if (!/^(0[1-9]|1[0-2])\/[0-9]{2}$/.test(expiryDate)) {
                $('.error-card_expiry_date').text('Expiry date must be MM/YY format.');
                $('input[name="card_expiry_date"]').addClass('is-invalid');
                isValid = false;
            }
        }


        if (paymentMethod === 'mobile_banking') {
            let mobileBankingId = $('input[name="mobile_banking_id"]').val().trim();
            let verifiedMobile = $('input[name="verified_mobile_number"]').val().trim();

            if (!mobileBankingId) {
                $('.error-mobile_banking_id').text('Mobile banking ID is required.');
                $('input[name="mobile_banking_id"]').addClass('is-invalid');
                isValid = false;
            }

            if (!verifiedMobile) {
                $('.error-verified_mobile_number').text('Verified mobile number is required.');
                $('input[name="verified_mobile_number"]').addClass('is-invalid');
                isValid = false;
            } else if (!/^\d{10,15}$/.test(verifiedMobile)) {
                $('.error-verified_mobile_number').text('Mobile number must be 10-15 digits.');
                $('input[name="verified_mobile_number"]').addClass('is-invalid');
                isValid = false;
            }
        }

        // Custom User ID
        let customUserId = $('select[name="custom_user_id"]').val();
        if (!customUserId) {
            $('.error-custom_user_id').text('Please select a user or choose "Other".');
            $('select[name="custom_user_id"]').addClass('is-invalid');
            isValid = false;
        }
      ///select product


      let selectedProduct = $('select[name="product_id"]').val();
      if (!selectedProduct) {
        $('.error-product_id').text('Please select a product.');
        $('select[name="product_id"]').addClass('is-invalid');
        isValid = false;
        }

        // Table Rows (Quantity Validation)
        let tableRows = $('.customOrderVariant tr');
        if (tableRows.length === 0) {
            $('.error-table').text('Please add at least one product or combo to the order.');
            isValid = false;
        } else {
            let validQuantities = true;
            tableRows.each(function() {
                let quantityInput = $(this).find('.quantityInput');
                let quantity = parseInt(quantityInput.val()) || 0;
                if (quantity <= 0) {
                    quantityInput.addClass('is-invalid');
                    validQuantities = false;
                } else {
                    quantityInput.removeClass('is-invalid');
                }
            });
            if (!validQuantities) {
                $('.error-table').text('All quantities must be greater than 0.');
                isValid = false;
            }
        }

        // Proceed with form submission if valid
        if (isValid) {
            let formData = new FormData(this);

            // Append user source
            let selectedOption = $('#customUserSelect').find('option:selected');
            let source = selectedOption.data('source') || 'guest';
            formData.append('source', source);

            // Generate customer_id for 'Other' users
            if ($('#customUserSelect').val() === 'other') {
                formData.append('customer_id', generateCustomerId());
            }

            $.ajax({
                url: "{{ route('custom.order.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 200) {
                        $('#orderForm')[0].reset();
                        $('.customOrderVariant').empty();
                        $('.stock-table').hide();
                        $('#subtotal, #tax, #grandTotal').val('0.00');
                        $('#shippingInput, #discountInput').val('0');
                        $('.card-section, .mobile-section').addClass('d-none');
                        toastr.success("Order placed successfully! Order ID: " + response.order_id);
                    } else {
                        toastr.error(response.message || 'Failed to place order.');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error('Failed to place order: ' + (xhr.responseJSON?.message || 'Unknown error'));
                }
            });
        } else {
            toastr.error('Please fix the errors in the form.');
        }
    });

    // Generate Customer ID
    function generateCustomerId() {
        return 'CUST-' + Math.random().toString(36).substr(2, 9).toUpperCase();
    }
});
</script>
@endsection
