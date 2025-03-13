@extends('backend.master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Purchase</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Purchase Product</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                            href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add Purchase Product</h5>
                <hr />
                <div class="form-body mt-4">
                    <form action="{{ route('purchase.store') }}" method="POST" id="myForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    @php
                                        $products = App\Models\Product::all();
                                        $company = App\Models\CompanyDetails::all();
                                    @endphp
                                    <div class="row mb-3">
                                        <div class="col-12 errors">
                                            <label for="single-select-clear-field" class="col-12 form-label">Product
                                                Name</label>
                                            <select name="product_id" class="form-select product-id"
                                                id="single-select-clear-field" data-placeholder="Choose one thing">
                                                <option value=""></option>
                                                @if ($products->count() > 0)
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}" class="d-flex ">
                                                            {{ Illuminate\Support\Str::limit($product->product_name ?? '', 40) }}
                                                            (SKU-{{ $product->sku }})
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 errors">
                                            <label for="inputEnterYourName" class="col-12 form-label">Company Name</label>
                                            <select name="company_name" class="form-select" id="single-select-field"
                                                data-placeholder="Choose one thing">
                                                <option></option>
                                                @if ($company->count() > 0)
                                                    @foreach ($company as $item)
                                                        <option value="{{ $item->id }}" class="d-flex ">
                                                            {{ Illuminate\Support\Str::limit($item->company_name ?? '', 40) }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-6 errors">
                                            <label for="inputProductTitle" class="form-label ">Purchase Date</label>
                                            <input type="date" class="form-control datepicker" name="purchase_date"
                                                value="{{ old('purchase_date') }}" />
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 errors">
                                            <label for="inputPrice" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" placeholder="00.00"
                                                name="quantity" onkeyup="calculation();" onchange="calculation();"
                                                onblur="calculation();">
                                        </div>
                                        <div class="col-md-4 errors">
                                            <label for="inputCompareatprice" class="form-label">Product Price</label>
                                            <input type="number" class="form-control" id="unit_price" placeholder="00.00"
                                                name="unit_price" onkeyup="calculation();" onchange="calculation();"
                                                onblur="calculation();">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputCostPerPrice" class="form-label">Total Price</label>
                                            <input type="number" class="form-control" id="total_price" placeholder="00.00"
                                                name="total_price" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 errors">
                                            <label for="inputStarPoints" class="form-label">Vehicle Cost</label>
                                            <input type="number" class="form-control" id="vehicle_cost"
                                                placeholder="00.00" name="vehicle_cost" onkeyup="calculation();"
                                                onchange="calculation();" onblur="calculation();">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="inputStarPoints" class="form-label">Other Cost</label>
                                            <input type="number" class="form-control" id="other_cost"
                                                placeholder="00.00" name="other_cost" onkeyup="calculation();"
                                                onchange="calculation();" onblur="calculation();">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputStarPoints" class="form-label">Grand Total</label>
                                            <input type="number" class="form-control" id="grand_total"
                                                placeholder="00.00" name="grand_total" readonly>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 errors">
                                            <label for="inputStarPoints" class="form-label">Payable Amount</label>
                                            <input type="number" class="form-control" id="payable_amount"
                                                placeholder="00.00" name="payable_amount" onkeyup="calculation();"
                                                onchange="calculation();" onblur="calculation();">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputStarPoints" class="form-label ">Total Due</label>
                                            <input type="number" class="form-control" id="due"
                                                placeholder="00.00" name="due" readonly>
                                        </div>
                                        <div class="col-md-4 errors">
                                            <label for="inputProductType" class="form-label">Payment With</label>
                                            <select class="form-select" id="inputProductType" name="payment_method">
                                                <option></option>
                                                <option value="bank">Bank</option>
                                                <option value="check">Check</option>
                                                <option value="mobile-banking">Mobile Banking</option>
                                                <option value="cash">Cash</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="inputProductTitle" class="form-label">Remarks</label>
                                            <textarea class="form-control" id="inputProductDescription" rows="3" name="remarks"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6 errors">
                                            <label for="inputPrice" class="form-label">Regular Price</label>
                                            <input type="number" class="form-control regular_price" id="inputPrice"
                                                placeholder="00.00" name="regular_price">
                                            <input type="hidden" class="variant_id" name="variant_id" value="0">
                                        </div>
                                        <div class="col-md-6 errors">
                                            <label class="form-label col-12">Discount</label>
                                            <select class="form-select discount" name="discount">
                                                <option value="">discount</option>
                                                <option value="0">0</option>
                                                <option value="10">10%</option>
                                                <option value="20">20%</option>
                                                <option value="30">30%</option>
                                                <option value="40">40%</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 errors">
                                            <label for="inputPrice" class="form-label">Sale Price</label>
                                            <input type="number" class="form-control discount_amount" id="inputPrice"
                                                placeholder="00.00" name="discount_amount">
                                        </div>
                                        <div class="col-md-6 errors">
                                            <label class="form-label col-12">Unit</label>
                                            <select class="form-select unit" name="unit">
                                                <option value="">Unit</option>
                                                <option value="kg">KG</option>
                                                <option value="liter">Liter</option>
                                                <option value="piece">Piece</option>
                                                <option value="dozon">Dozon</option>
                                                <option value="inch">Inch</option>
                                                <option value="gm">GM</option>
                                                <option value="ml">ML</option>
                                                <option value="packet">Packet</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 errors">
                                            <label class="form-label">Weight</label> <br>
                                            <input type="text" class="form-control weight" id="inputPrice"
                                                placeholder="Weight" name="weight">
                                        </div>
                                         <div class="col-md-6 errors">
                                            <label class="form-label">Available Stock</label> <br>
                                            <input type="number" class="form-control stock" id="inputPrice"
                                                placeholder="Stock" name="stock" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-12">Color</label>
                                            <select class="form-select color" name="color">
                                                <option value="">Color</option>
                                                <option value="black">Black</option>
                                                <option value="white">White</option>
                                                <option value="red">Red</option>
                                                <option value="blue">Blue</option>
                                                <option value="green">Green</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-12">Size</label>
                                            <select class="form-select size" name="size">
                                                <option value="">Size</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Manufacture Date</label> <br>
                                            <input type="date" class="form-control datepicker manufacture_date"
                                                id="inputPrice" placeholder="" name="manufacture_date">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Expire Date</label> <br>
                                            <input type="date" class="form-control datepicker expire_date"
                                                id="inputPrice" placeholder="" name="expire_date">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Save </button>
                                            </div>
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

    <script>
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_id: {
                        required: true,
                    },
                    company_name: {
                        required: true,
                    },
                    purchase_date: {
                        required: true,
                    },
                    quantity: {
                        required: true,
                    },
                    unit_price: {
                        required: true,
                    },
                    vehicle_cost: {
                        required: true,
                    },
                    other_cost: {
                        required: true,
                    },
                    payable_amount: {
                        required: true,
                    },
                    payment_method: {
                        required: true,
                    },
                    regular_price: {
                        required: true,
                    },
                    discount: {
                        required: true,
                    },
                    discount_amount: {
                        required: true,
                    },
                    unit: {
                        required: true,
                    },
                    weight: {
                        required: true,
                    },
                },
                messages: {
                    product_id: {
                        required: 'Please Select Product ID',
                    },
                    company_name: {
                        required: 'Please Select A Company',
                    },
                    purchase_date: {
                        required: 'Please Select Date',
                    },
                    quantity: {
                        required: 'Quantity Field is Required',
                    },
                    unit_price: {
                        required: 'Product Price is Required',
                    },
                    vehicle_cost: {
                        required: 'Vehical cost is Required',
                    },
                    other_cost: {
                        required: 'Other cost is Required',
                    },
                    payable_amount: {
                        required: 'Payable amount is Required',
                    },
                    payment_method: {
                        required: 'Payment Method is Required',
                    },
                    regular_price: {
                        required: 'Regular Price is Required',
                    },
                    discount: {
                        required: 'Discount is Required',
                    },
                    discount_amount: {
                        required: 'Sale Price is Required',
                    },
                    unit: {
                        required: 'Unit is Required',
                    },
                    weight: {
                        required: 'Weight is Required',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.errors').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).addClass('is-valid');
                },
            });

            // function selectValidation(element) {
            //     function message(m) {
            //         return `<span class="text-danger">${m}</span>`
            //     }
            //     if (element.value === "") {
            //         element.addClass('is-valid');
            //         $('.errors').append(),
            //     } else {
            //         element.removeClass('is-valid');
            //         element.addClass('valid');
            //         element.closest('.errors').append(message('This field is required'));
            //     }
            // }
        });
    </script>
@endsection
