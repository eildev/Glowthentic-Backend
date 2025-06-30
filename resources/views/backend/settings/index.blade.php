@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-top border-0 border-3 col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-3 text-info">Category Settings</h5>
                    </div>
                    <!-- Display success or error messages -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div>
                        <form action="{{ route('settings.store') }}" method="POST">
                            @csrf
                            <div>
                                <h6 class="mb-2 text-uppercase">Category Type</h6>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1" value="single"
                                            {{ isset($setting) && $setting->isMultipleCategory == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Single
                                        </label>
                                    </div>
                                    <div class="form-check form-check-success">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioSuccess" value="multiple"
                                            {{ isset($setting) && $setting->isMultipleCategory == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioSuccess">
                                            Multiple
                                        </label>
                                    </div>
                                </div>
                                @error('flexRadioDefault')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary px-5">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
