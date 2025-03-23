{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glowthentic Controll Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .login-container {
            display: flex;
            width: 70%;
            max-width: 900px;
            height: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .left {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
            animation: fadeInLeft 1.5s ease-in-out;
        }

        .left img {
            width: 100%;
            max-width: 100%;
            height: 100%;
        }

        .right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            animation: fadeInRight 1.5s ease-in-out;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 8px;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 90%;
                height: auto;
            }

            .left {
                height: 200px;
                justify-content: center;
            }

            .left img {
                width: 70%;
                max-width: 300px;
            }

            .right {
                padding: 20px;
            }
        }
    </style>
</head>

<body>



    <div class="login-container">
        <!-- Left Side (Animated Image) -->
        <div class="left">
            <img src="{{ asset('backend/assets/images/login.gif') }}" alt="Login Image">
        </div>

        <!-- Right Side (Login Form) -->
        <div class="right">
            <h3 class="mb-4">Welcome Back</h3>
            <form id="login_data">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <a class="btn btn-primary login">Login</a>
            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).on('click', '.login', function(e) {
            e.preventDefault();
            var Formdata = new FormData($('#login_data')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('login') }}",
                type: 'POST',
                data: Formdata,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response.status == 200) {
                        window.location.href = "{{ route('admin.dashboard') }}";
                    }

                },
                error: function (xhr) {
                        $('.error-message').remove();

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                let inputField = $('[name="' + key + '"]');
                                inputField.after('<div class="text-danger error-message">' + value[0] + '</div>');
                            });
                        }
                        else if (xhr.status === 401) {
                            console.log("hello");
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                toastr.error(xhr.responseJSON.message);
                            } else {
                                toastr.error("Invalid credentials.");
                            }
                        }
                    }

            });
        });
    </script>

</body>

</html>
