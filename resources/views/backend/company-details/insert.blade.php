@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('company-details.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">

                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Add Company Details</h5>

                                    <a href="{{ route('company-details.view') }}" class=" btn-info btn-sm text-light ">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-12 form-label">Company Name</label>
                                    <div class="col-12">
                                        <input type="text" name="company_name"
                                            class="form-control @error('company_name') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Company Name">
                                        @error('company_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-12 form-label">Manager Name</label>
                                    <div class="col-12">
                                        <input type="text" name="manager_name"
                                            class="form-control @error('manager_name') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Manager Name">
                                        @error('manager_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-12 form-label">Company Adress</label>
                                    <div class="col-12">
                                        <input type="text" name="address"
                                            class="form-control @error('address') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Company Address">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-12 form-label">Company Email</label>
                                    <div class="col-12">
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Company Email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-12 form-label">Company Phone Number</label>
                                    <div class="col-12">
                                        <input type="number" name="phone"
                                            class="form-control @error('phone') is-invalid  @enderror"
                                            id="inputEnterYourName" placeholder="Enter Company Phone Number">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info px-5">Add Company</button>
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
