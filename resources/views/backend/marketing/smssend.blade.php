@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-top border-0 border-3 border-info">
                    <form action="{{ Route('sms.send') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="border p-4 rounded">

                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-info">Send SMS</h5>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <label for="phonenumbers" class="col-sm-3 col-form-label">Phone Numbers</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="phonenumbers"
                                            class="form-control @error('phonenumbers') is-invalid  @enderror"
                                            id="inputEnterYourName" value="{{ old('phonenumbers') }}"
                                            placeholder="01917344267,01744676725"  style="height:100px"></textarea>
                                        @error('phonenumbers')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Message </label>
                                    <div class="col-sm-9">
                                        <div class="mt-3">
                                            <textarea class="form-control" name="sms" placeholder="Enter Message" style="height:150px"></textarea>
                                        </div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="mt-3">
                                            <button class="btn btn-info">Send SMS</button>
                                        </div>
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

