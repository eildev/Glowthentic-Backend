@extends('backend.master')
@section('admin')
<style>
    .profile-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    .profile-card {
        padding-top: 20px;
    }
    .readonly-field {
        background-color: #f8f9fa;
        border: none;
    }
    .page-content {
        padding-top: 70px;
    }
    .error-message {
        margin-top: 5px;
    }
</style>

<div class="page-content">
    <div class="row">
        <div class="card">
            <div class="card-body profile-card">
                <!-- Profile Image and Basic Info -->
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset(Auth::user()->userDetails->image??'') }}" class="rounded-circle profile-img" alt="Profile Image">
                    <div class="ms-3">
                        <h3 class="mb-0">{{Auth::user()->name}}</h3>
                        <p class="text-muted mb-0">{{Auth::user()->email}}</p>
                    </div>
                </div>

                <!-- Readonly Information -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label"><strong>Location:</strong></label>
                        <input type="text" class="form-control readonly-field" value="{{ Auth::user()->userDetails()->country??'' }},{{Auth::user()->userDetails()->city??''  }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><strong>Email:</strong></label>
                        <input type="email" class="form-control readonly-field" value="{{ Auth::user()->email??Auth::user()->userDetails->secondary??'' }}" readonly>
                    </div>
                </div>

                <!-- Password Change Form -->
                <h5 class="mb-3">Change Password</h5>
                <form id="changePasswordForm">
                    @csrf
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <a  class="btn btn-primary update">Update Password</a>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.update', function(e) {
        e.preventDefault();


    let currentPassword = $('#currentPassword').val();
    let newPassword = $('#newPassword').val();
    let confirmPassword = $('#confirmPassword').val();

    $('input[name="confirmPassword"]').next('.error-message').remove();
    if (newPassword !== confirmPassword) {
        $('input[name="confirmPassword"]').after('<div class="error-message text-danger">Passwords do not match</div>');;
        return;
    }





        let formData = new FormData($('#changePasswordForm')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('user.password.update')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Success response handle
                if(response.status === 200){
                    toastr.success("Password updated successfully");
                }

                else if(response.status === 401){
                    toastr.error("Current password is incorrect");
                }

                else {
                    toastr.error("Update failed");
                }
                location.reload();
            },
            error: function(xhr) {
                toastr.error("Something went wrong");
            }
        });
    });
</script>

@endsection
