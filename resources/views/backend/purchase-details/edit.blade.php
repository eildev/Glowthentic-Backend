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
                        <li class="breadcrumb-item active" aria-current="page">Update Purchase Product</li>
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
                <h5 class="card-title">Update Purchase Product</h5>
                <hr />
                <div class="form-body mt-4">
                    <form action="{{ route('purchase.update', $data->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    @php
                                        $products = App\Models\Product::all();
                                        $company = App\Models\CompanyDetails::all();
                                        // $variant = App\Models\Variant::all();
                                    @endphp
                                    <div class="row mb-3">
                                        </select>
                                        <div class="col-12">
                                            <label for="single-select-clear-field" class="col-12 form-label">Product
                                                Name</label>
                                            <select name="product_id"
                                                class="form-select product-id @error('product_id') is-invalid  @enderror"
                                                id="single-select-clear-field" data-placeholder="Choose one thing">
                                                <option value="{{ $data->product->id }}" selected>
                                                    {{ $data->product->product_name }}</option>
                                                @if ($products->count() > 0)
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}" class="d-flex ">
                                                            {{ Illuminate\Support\Str::limit($product->product_name ?? '', 40) }}
                                                            (SKU-{{ $product->sku }})
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('product_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="inputEnterYourName" class="col-12 form-label">Company Name</label>
                                            <select name="company_name"
                                                class="form-select @error('company_name') is-invalid  @enderror"
                                                id="single-select-field" data-placeholder="Choose one thing">
                                                <option selected value="{{ $data->company->id }}">
                                                    {{ $data->company->company_name }}</option>
                                                @if ($company->count() > 0)
                                                    @foreach ($company as $item)
                                                        <option value="{{ $item->id }}" class="d-flex ">
                                                            {{ Illuminate\Support\Str::limit($item->company_name ?? '', 40) }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('company_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputProductTitle" class="form-label ">Purchase Date</label>
                                            <input type="date"
                                                class="form-control datepicker @error('purchase_date') is-invalid  @enderror"
                                                name="purchase_date" value="{{ $data->purchase_date }}" />
                                            @error('purchase_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="inputPrice" class="form-label">Quantity</label>
                                            <input type="number"
                                                class="form-control  @error('quantity') is-invalid  @enderror"
                                                id="quantity" placeholder="00.00" name="quantity"
                                                value="{{ $data->quantity }}" onkeyup="calculation();"
                                                onchange="calculation();" onblur="calculation();">
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputCompareatprice" class="form-label">Product Price</label>
                                            <input type="number"
                                                class="form-control @error('unit_price') is-invalid  @enderror"
                                                id="unit_price" placeholder="00.00" name="unit_price"
                                                value="{{ $data->unit_price }}" onkeyup="calculation();"
                                                onchange="calculation();" onblur="calculation();">
                                            @error('unit_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputCostPerPrice" class="form-label">Total Price</label>
                                            <input type="number"
                                                class="form-control @error('total_price') is-invalid  @enderror"
                                                id="total_price" placeholder="00.00" name="total_price" readonly
                                                value="{{ $data->total_price }}">
                                            @error('total_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="inputStarPoints" class="form-label">Vehicle Cost</label>
                                            <input type="number"
                                                class="form-control @error('vehicle_cost') is-invalid  @enderror"
                                                id="vehicle_cost" placeholder="00.00" name="vehicle_cost"
                                                value="{{ $data->total_price }}" onkeyup="calculation();"
                                                onchange="calculation();" onblur="calculation();">
                                            @error('vehicle_cost')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputStarPoints" class="form-label">Other Cost</label>
                                            <input type="number"
                                                class="form-control @error('other_cost') is-invalid  @enderror"
                                                id="other_cost" placeholder="00.00" name="other_cost"
                                                value="{{ $data->other_cost }}" onkeyup="calculation();"
                                                onchange="calculation();" onblur="calculation();">
                                            @error('other_cost')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputStarPoints" class="form-label">Grand Total</label>
                                            <input type="number"
                                                class="form-control @error('grand_total') is-invalid  @enderror"
                                                id="grand_total" placeholder="00.00" name="grand_total" readonly
                                                value="{{ $data->grand_total }}">
                                            @error('grand_total')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="inputStarPoints" class="form-label">Payable Amount</label>
                                            <input type="number"
                                                class="form-control @error('payable_amount') is-invalid  @enderror"
                                                id="payable_amount" placeholder="00.00" name="payable_amount"
                                                value="{{ $data->payable_amount }}" onkeyup="calculation();"
                                                onchange="calculation();" onblur="calculation();">
                                            @error('payable_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputStarPoints" class="form-label ">Total Due</label>
                                            <input type="number"
                                                class="form-control @error('due') is-invalid  @enderror" id="due"
                                                placeholder="00.00" name="due" readonly value="{{ $data->due }}">
                                            @error('due')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputProductType" class="form-label">Payment With</label>
                                            <select class="form-select @error('payment_method') is-invalid  @enderror"
                                                id="inputProductType" name="payment_method">
                                                <option selected value="{{ $data->payment_method }}">
                                                    {{ $data->payment_method }}</option>
                                                <option value="bank">Bank</option>
                                                <option value="check">Check</option>
                                                <option value="mobile-banking">Mobile Banking</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="inputProductTitle" class="form-label">Remarks</label>
                                            <textarea class="form-control" id="inputProductDescription" rows="3" name="remarks">{{ $data->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputPrice" class="form-label">Regular Price</label>
                                            <input type="number" class="form-control regular_price" id="inputPrice"
                                                placeholder="00.00" name="regular_price"
                                                value="{{ $data->variant->regular_price }}">
                                            {{-- <input type="hidden" value="{{ $data->variant->id }}" name="variant_id"> --}}
                                            <span class="regular_price_error text-danger"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label col-12">Discount</label>
                                            <select class="form-select discount" name="discount"
                                                value="{{ $data->variant->discount }}">
                                                <option value="{{ $data->variant->discount }}">
                                                    {{ $data->variant->discount }}</option>
                                                <option value="0">0</option>
                                                <option value="10">10%</option>
                                                <option value="20">20%</option>
                                                <option value="30">30%</option>
                                                <option value="40">40%</option>

                                            </select>
                                            <span class="discount_error text-danger"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPrice" class="form-label">Sale Price</label>
                                            <input type="number" class="form-control discount_amount" id="inputPrice"
                                                placeholder="00.00" name="discount_amount"
                                                value="{{ $data->variant->discount_amount }}">
                                            <span class="discount_amount_error text-danger"></span>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label col-12">Unit</label>
                                            <select class="form-select unit" name="unit">
                                                <option value="{{ $data->variant->unit }}">{{ $data->variant->unit }}
                                                </option>
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
                                        <div class="col-md-6">
                                            <label class="form-label">Weight</label> <br>
                                            <input type="text" class="form-control weight" id="inputPrice"
                                                placeholder="Weight" name="weight"
                                                value="{{ $data->variant->weight }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label col-12">Color</label>
                                            <select class="form-select color" name="color">
                                                <option value="{{ $data->variant->color }}">{{ $data->variant->color }}
                                                </option>
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
                                                <option value="{{ $data->variant->size }}">{{ $data->variant->size }}
                                                </option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Manufacture Date</label> <br>
                                            <input type="date" class="form-control datepicker" id="inputPrice"
                                                placeholder="" name="manufacture_date"
                                                value="{{ $data->variant->manufacture_date ?? '' }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Expire Date</label> <br>
                                            <input type="date" class="form-control datepicker" id="inputPrice"
                                                placeholder="" name="expire_date"
                                                value="{{ $data->variant->expire_date ?? '' }}">
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



@endsection
