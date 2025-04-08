@extends('backend.master')
@section('admin')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">SteadFast Courier Information</h4>
                </div>
                <div class="card-body" id="steadfast_courier_info" style="">
                    <p class="text-muted text-center">Please fill in the necessary details below.</p>
                    <hr>
                 <form action="{{ route('steadfast.send') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Invoice Number</label>
                        <input type="text" class="form-control" name="invoice" placeholder="Enter Invoice Number" id="invoice_number">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Recipient Name</label>
                        <input type="text" class="form-control" name="recipient_name" placeholder="Enter Recipient Name" id="recipient_name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Recipient Phone No</label>
                        <input type="text" class="form-control" name="recipient_phone" placeholder="Enter Recipient Phone No" id="recipient_phone">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">COD Amount</label>
                        <input type="text" class="form-control" name="cod_amount" placeholder="Enter COD Amount" id="cod_amount">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Recipient Address</label>
                        <textarea class="form-control" name="recipient_address" placeholder="Enter Recipient Address" id="recipient_address" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Note (Optional)</label>
                        <textarea class="form-control" name="note" placeholder="Enter any additional notes" rows="2"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-info px-4">Submit</button>
                    </div>
                </div>

            </form>

            </div>
        </div>
    </div>
</div>
@endsection
