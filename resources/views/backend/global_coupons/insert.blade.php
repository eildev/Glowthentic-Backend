@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('global.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">

                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Add Global Coupon</h5>

                                    <a href="{{ route('tagname.view') }}" class="btn-info btn-sm text-light ">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Global Coupon</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="coupon_code"
                                            class="form-control @error('coupon_code') is-invalid  @enderror"
                                            id="inputEnterYourName" value="{{ old('coupon_code') }}"
                                            placeholder="Enter Global Coupon">
                                        @error('coupon_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row mb-3">          
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Discount</label>
                                    <div class="col-sm-9">
                                        <select class="form-select discount @error('discount') is-invalid  @enderror" name="discount" value="{{ old('discount') }}">
                                            <option value="0">discount</option>
                                            <option value="0">0</option>
                                            <option value="05">05%</option>
                                            <option value="10">10%</option>
                                            <option value="15">15%</option>
                                            <option value="20">20%</option>
                                            <option value="30">30%</option>
                                            <option value="40">40%</option>
                                            <option value="50">50%</option>
                                        </select>
                                        @error('coupon_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">          
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Start Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control @error('startDate') is-invalid  @enderror" id="expiration"
                                                    placeholder="" name="startDate" value="{{ old('startDate') }}">
                                        @error('startDate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">          
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Expiration date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control @error('expiration') is-invalid  @enderror" id="expiration"
                                                    placeholder="" name="expiration" value="{{ old('expiration') }}">
                                        @error('expiration')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5">Add Global Coupon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
