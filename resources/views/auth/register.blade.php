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
                        <h1>Just one Click Away!</h1>
                        <form class="my-login-validation" autocomplete="off" action="{{ route('register') }}"
                            method="post">
                            @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::get('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input placeholder="Full Name" type="text" class="form-control" id="name"
                                    aria-describedby="name" name="name" autofocus placeholder="Enter name"
                                    value="{{ old('name') }}" />
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input placeholder="Email" type="email" name="email" class="form-control"
                                    id="email" aria-describedby="emailHelp" placeholder="Enter email"
                                    value="{{ old('email') }}" />
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input placeholder="Password" type="password" class="form-control" name="password"
                                    id="password" data-eye placeholder="Enter password" />
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="form-label">Retype Password</label>
                                <input placeholder="Retype Password" type="password" class="form-control"
                                    id="password-confirm" name="password_confirmation" data-eye
                                    placeholder="Enter confirm password" />
                                <span class="text-danger">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" class="auth-btn">Register</button>
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
