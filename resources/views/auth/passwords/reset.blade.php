<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professional Choice Reality</title>
    <!----- bootstrap ---->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap4.5.css') }}" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ URL::asset('css/all.css') }}" />
    <!-- slick slider  -->
    <link rel="stylesheet" href="{{ URL::asset('css/slick.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/slick-theme.css') }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
    <link rel="icon" type="x/icon" href="{{ URL::asset('assets/favicon.png') }}" />
</head>

<body>
    <section class="authentication-sec">
        <div class="container-large">
            <div class="auth-wrapper">
                <div class="auth-col"></div>
                <div class="auth-col form-col">
                    <div class="form-look">
                        <h1>Reset Password!</h1>
                        <form method="POST" class="my-login-validation" novalidate=""
                            action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>

                                <input id="email" type="email" class="form-control" name="email"
                                    placeholder="Email address" value="{{ $email ?? old('email') }}">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="Newpassword" class="form-label">New Password</label>
                                <input id="password" type="password" class="form-control" name="password"
                                    placeholder="Enter new password">
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Enter confirm password">
                                <span class="text-danger">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" class="auth-btn">Reset Password</button>
                        </form>
                    </div>
                    <h2 class="existing-account">Already have an account? <a href="{{ route('login') }}">Log In</a>
                    </h2>
                    <div class="policies">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Services</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jquery -->
    <script src="{{ URL::asset('js/jquery-3.6.0.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <!-- slick slider  -->
    <script src="{{ URL::asset('js/slick.js') }}"></script>
    <!-- custom js -->
    <script src="{{ URL::asset('js/custom.js') }}"></script>
</body>

</html>
