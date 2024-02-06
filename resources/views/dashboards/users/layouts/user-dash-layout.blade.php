<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Professional Choice Reality</title>
    <title>@yield('title')</title>
    <!----- bootstrap ---->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap4.5.css') }}" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ URL::asset('links/fontawesome/css/all.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.css') }}">
    <!-- data table  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <!-- slick slider  -->
    <link rel="stylesheet" href="{{ URL::asset('css/slick.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/slick-theme.css') }}" />
    <!-- custom css -->
    <link rel="icon" href="{{ URL::asset('assets/favicon.png') }}" type="image/x-icon" defer>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

    <section class="main-wrapper">
        <aside class="sidebar">
            <div class="collapse-icon">
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </div>

            <div class="brand">
                <a href="{{ route('user.dashboard') }}"><img src="{{ URL::asset('assets/logo.png') }}"
                        alt="" /></a>
                <div class="sidecollapse-logo">
                    <a href="#"><img src="{{ URL::asset('assets/favicon.png') }}" alt="" /></a>
                </div>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('user.profile') }}"
                            class=" {{ request()->is('user/profile*') ? 'active' : '' }}"><i class="fa fa-user"
                                aria-hidden="true"></i> My
                            Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('userGetChangePassword') }}"
                            class=" {{ request()->is('user/userGetChangePassword*') ? 'active' : '' }}"><i
                                class="fa fa-unlock-alt" aria-hidden="true"></i> Password</a>
                    </li>
                    <!--<li>-->
                    <!--    <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Preferences</a>-->
                    <!--</li>-->
                    <li>
                        <a href="{{ route('user.userSavedPropertiesList') }}"><i class="fa fa-home"
                                aria-hidden="true"></i> Saved Properties</a>
                    </li>
                    <li>
                        <a href="{{ route('user.myListingProperties') }}"><i class="fa fa-list" aria-hidden="true"></i>
                            My Listings</a>
                    </li>


                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="main-content">
            <header class="header">
                <div class="header-wrapper">
                    <form action="" method="post">
                        <div class="form-inner">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <input type="search" class="form-control" placeholder="Search" />
                        </div>
                    </form>
                    <a href="{{ route('user.addPropertyDetailsForm') }}">
                        <button class="primary-btn" type="submit">
                            Add property </button></a>
                    <div class="topbar">
                        <div class="notification">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <span></span>
                        </div>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <img src="{{ Auth::user()->picture }}" alt="User Image"
                            class="img-circle elevation-2 admin_picture" />
                    </div>
                </div>
            </header>
            <section class="content">
                @yield('content')
            </section>
        </div>
    </section>

    <!-- jquery -->
    <script src="{{ URL::asset('js/jquery-3.6.0.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <!-- slick slider  -->
    <script src="{{ URL::asset('js/slick.js') }}"></script>
    <!-- Data Table  -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <!-- chartjs  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <!-- custom js -->
    <script src="{{ URL::asset('js/custom.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <!-- In your Blade view or layout -->
<script>
    var appUrl = "{{ config('app.url') }}";
</script>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {

            /* UPDATE ADMIN PERSONAL INFO */

            $('#AdminInfoForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $('.admin_name').each(function() {
                                $(this).html($('#AdminInfoForm').find($(
                                    'input[name="name"]')).val());
                            });
                            alert(data.msg);
                        }
                    }
                });
            });



            $(document).on('click', '#change_picture_btn', function() {
                $('#admin_image').click();
            });


            $('#admin_image').ijaboCropTool({
                preview: '.admin_picture',
                setRatio: 1,
                allowedExtensions: ['jpg', 'jpeg', 'png'],
                buttonsText: ['CROP', 'QUIT'],
                buttonsColor: ['#30bf7d', '#ee5155', -15],
                processUrl: '{{ route('userPictureUpdate') }}',
                withCSRF: ['_token', '{{ csrf_token() }}'],
                onSuccess: function(message, element, status) {
                    alert(message);
                },
                onError: function(message, element, status) {
                    alert(message);
                }
            });


            $('#changePasswordAdminForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $('#changePasswordAdminForm')[0].reset();
                            alert(data.msg);
                        }
                    }
                });
            });


        });
    </script>
   


    @stack('child-scripts')
</body>

</html>
