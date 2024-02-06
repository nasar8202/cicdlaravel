<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professional Choice Reality</title>
    <!----- bootstrap ---->

    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap4.5.css') }}">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ URL::asset('css/all.css') }} " />
    <!-- slick slider  -->
    <link rel="stylesheet" href="{{ URL::asset('css/slick.css') }} " />
    <link rel="stylesheet" href="{{ URL::asset('css/slick-theme.css') }} " />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }} " />
    <link rel="icon" type="x/icon" href="{{ URL::asset('assets/favicon.png') }} " />
</head>

<body>
    <section class="authentication-sec">
        <div class="container-large">
            <div class="auth-wrapper">
                <div class="auth-col"></div>
                <div class="auth-col form-col">
                    <div class="form-look">
                        <h1>Just one Click Away!</h1>
                        <form class="my-login-validation" autocomplete="off" action="{{ route('login') }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input placeholder="Email" type="email" name="email" class="form-control"
                                    id="email" aria-describedby="emailHelp" />
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input placeholder="Password" type="password" name="password" class="form-control"
                                    id="password" />
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember" />
                                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                            </div>
                            <button type="submit" class="auth-btn">Login</button>
                        </form>
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
                    </div>
                    <div class="login-bottom">
                        <div class="ask-to-wish">
                            <a href="{{ route('password.request') }}">Forget Password?</a>
                            <a href="{{ route('register') }}">Want to Sign up?</a>
                        </div>
                        <h2 class="continue-with">or continue with</h2>
                        <div class="thirdparty-login">
                            <button><img src="{{ URL::asset('assets/Facebook.png')}}" alt="" /><a
                                    href="{{ url('redirect/facebook') }}"> Facebook <a></button>
                            <button><img src="{{ URL::asset('assets/Google.png')}}" alt="" /><a
                                    href="{{ url('redirect/google') }}"> Google </a></button>
                        </div>
                    </div>

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
