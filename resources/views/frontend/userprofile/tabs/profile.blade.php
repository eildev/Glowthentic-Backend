<div class="tpshop__top ml-60">
    <div class="row">
        <div class="col-lg-4 pe-0">
            <div class="card" style="min-height: 483px;">

                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ !empty($user->socialId) ? asset($user->pic) : asset('/default/user.svg') }}"
                            alt="User Image" class="rounded-circle p-1 bg-primary" width="110">
                        <div class="mt-3">
                            <p>{{ $user->userName ?? 'Your User Name' }}</p>
                            <p class="text-secondary mb-1">{{ $user->fullName ?? 'Your Full Name' }}</p>
                            <p class="text-muted font-size-sm">{{ $user->email ?? 'Your Email address' }}</p>

                        </div>
                    </div>
                    <hr class="my-4" />
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <p class="mb-0">
                                Present Address
                            </p>
                            <span class="text-secondary">{{ $user->present_address ?? 'Your Address' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <p class="mb-0">
                                Phone Number
                            </p>
                            <span class="text-secondary">{{ $user->phone ?? 'Your Phone Number' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 ps-2">
            <div class="card mb-2">
                <div class="card-title text-center fw-semibold my-4 fs-4">User Information</div>
                <form action="{{ Route('user.profile.update') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">User Name</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="username" class="form-control"
                                    value="{{ $user->userName ?? 'Data not found' }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="fullname" class="form-control"
                                    value="{{ $user->fullName ?? 'Data not found' }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="email" class="form-control"
                                    value="{{ $user->email ?? 'Data not found' }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Mobile</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="phone" class="form-control"
                                    value="{{ $user->phone ?? 'Data not found' }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Present Address</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="present_address" class="form-control"
                                    value="{{ $user->present_address ?? 'Data not found' }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Permanent Address</p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="permanent_address" class="form-control"
                                    value="{{ $user->permanent_address ?? 'Data not found' }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
