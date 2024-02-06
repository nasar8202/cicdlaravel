<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professional Choice Reality</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Slick CSS  -->
    <link rel="icon" href="{{ URL::asset('assets/favicon.png') }}" type="image/x-icon" defer>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <!--font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/dashboard/css/style.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/dashboard/css/responsive.css') }}" />
</head>
<style>
    .favorited.fa-solid {
        color: red;
        /* You can customize the color for the favorite state */
    }
</style>

<body>
    <main>
        <header>
            <div class="container-1800">
                <div class="row align-items-center">
                    <div class="col-lg-1 col-md-1">
                        <div class="headerLogo">
                            <img src="{{ URL::asset('assets/img/header-logo.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3">
                        <div class="ManuBar">
                            <ul>
                                <li><a href="">Buy</a></li>
                                <li><a href="">Rent</a></li>
                                <li><a href="">Sell</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3">
                        <div class="headersearchIcon">
                            <form action="" method="post">
                                <button type="submit" class="std-btn"><i class="fa fa-search"
                                        aria-hidden="true"></i></button>
                                <!--<a type="submit" href="#" class="std-btn"><i class="fa fa-search" aria-hidden="true"></i></a>-->
                                <input type="search" placeholder="Search" />
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="header-iconDiv">
                            <div class="header-btn">
                                <a href="{{ route('user.addPropertyDetailsForm') }}">Add Property </a>
                            </div>
                            <div class="hIcon">
                                <!--<a href="">-->
                                <!--    <img src="{{ URL::asset('assets/img/world.png') }}" alt="" />-->
                                <!--</a>-->
                                <!--<a href="">-->
                                <!--    <img src="{{ URL::asset('assets/img/design_setting.png') }}" alt="" />-->
                                <!--</a>-->
                                <a href="{{ route('user.profile') }}">
                                    <img src="{{ URL::asset('assets/img/vector.png') }}" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Banner Section  -->
        <section class="banner-section">
            <div class="container-1416">

                <div class="search-property">
                    <form>
                        <input type="hidden" name="_token" value="bfiv1blFHk0IB0RuDOxzQamGNaftv9RbO7cCiSym">
                        <div class="profile-main-wrapper bg-image-selects">
                            <div class="search-property-form profile-form mt-0">
                                <div class="row">
                                    <div class="col-lg-2-4 col-md-6 col-12">
                                        <div class="mb-4">
                                            <select class="form-control" name="purpose_type" id="purpose_type">
                                                <option value="">Purpose</option>
                                                <option value="Sell">Sale</option>
                                                <option value="Rent">Rent</option>
                                                <option value="Buy">Buy</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2-4 col-md-6 col-12">
                                        <div class="mb-4">
                                            <select class="form-control" name="country" id="country">
                                                <option value="">Country</option>
                                                @forelse($countries as $country)
                                                    <option value="{{ $country->id }}">
                                                        {{ $country->name }}</option>

                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2-4 col-md-6 col-12">
                                        <div class="mb-4">
                                            <select class="form-control" name="state" id="state">
                                                <option value="">States</option>
                                                @foreach ($countries as $country)
                                                    <optgroup label="{{ $country->name }}">
                                                        @foreach ($country->states as $state)
                                                            <option value="{{ $state->id }}">{{ $state->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2-4 col-md-6 col-12">
                                        <div class="mb-4">
                                            <select class="form-control" id="property_type" name="property_type">
                                                <option value="">Property Type</option>
                                                <option value="Home">Home</option>
                                                <option value="Plots">Plots</option>
                                                <option value="Commercial">Commercial</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2-4 col-md-6 col-12">
                                        <div class="mb-4">
                                            <select class="form-control" name="area_and_size" id="area_and_size">
                                                <option value="">Size Range</option>
                                                @foreach (range(1, 20) as $number)
                                                    <option value="{{ $number }}">{{ $number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4-8 col-md-6 col-12">
                                        <div class="mb-4">
                                            <select class="form-control" name="price" id="price">
                                                <option value=""> Price Range</option>
                                                @php
                                                    $limit = 50000;
                                                    $gap = 500;
                                                @endphp

                                                @for ($i = $gap; $i <= $limit; $i += $gap)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2-4 col-md-6 col-12">
                                        <div class="mb-4">
                                            <select class="form-control" name="beds" id="beds">
                                                <option value="">Beds</option>
                                                <option value="Studio">Studio</option>
                                                @foreach (range(1, 10) as $number)
                                                    <option value="{{ $number }}">{{ $number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2-4 col-md-6 col-12">
                                        <div class="mb-4">
                                            <select class="form-control" id="baths" name="baths">
                                                <option value="">Baths</option>
                                                @foreach (range(1, 6) as $number)
                                                    <option value="{{ $number }}">{{ $number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2-4 col-md-6 col-12">
                                        <div class="mb-4">
                                            <input type="text" name="keywords" id="keywords"
                                                placeholder="Keywords" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button id="filterAllPoperties" class="primary-btn">Save Search</button>
                            </div>
                        </div>
                    </form>
                    <p id="error_empty"></p>
                </div>
            </div>
        </section>

        <section class="all-properties">
            <div class="container">
                <div class="bannerHtext browse-htext recent-htext">
                    <h1>All Properties</h1>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row" id="resultContainer">
                            @foreach ($myListingProperties as $property)
                                <div class="recent-inner col-lg-4 col-md-6 col-12 mx-0">
                                    <div class="viewedMain">
                                        <div class="view-img">
                                            <a
                                                href="{{ route('admin.adminSavedPropertyDetail', ['id' => $property->id]) }}">
                                                <img src="{{ $property->source_url }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="viewsub">
                                            <div class="view-text">
                                                <h4>
                                                    <a
                                                        href="{{ route('admin.adminSavedPropertyDetail', ['id' => $property->id]) }}">
                                                        {{ $property->addInformation->title }}
                                                    </a>

                                                </h4>
                                            </div>

                                            <div class="homeForsales">
                                                <img src="{{ asset('assets/img/eva_pin-outline (2).png') }}"
                                                    alt="" />
                                                <h3>{{ $property->locationAndPurpose->street_address }}</h3>


                                            </div>
                                            <div class="view-MainDiv">
                                                <div class="view-subdiv">
                                                    <h6>{{ $property->featureAndAmenity->bed_rooms }}</h6>
                                                    <img src="{{ asset('assets/bed.png') }}" alt="" />
                                                </div>
                                                <div class="view-subdiv">
                                                    <h6>{{ $property->featureAndAmenity->bath_rooms }}</h6>
                                                    <img src="{{ asset('assets/shower.png') }}" alt="" />
                                                </div>
                                            </div>
                                            <div class="price-Div">
                                                <span>{{ $property->priceAndArea->currency }}
                                                    {{ $property->priceAndArea->price }}</span>
                                                <i class="fa-regular fa-heart {{ $property->isFavorited ? 'favorited fa-solid' : '' }}"
                                                    data-property-id="{{ $property->id }}" id="heartIcon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="subscribe-to-newsletter">
                            <h3>Subscribe to Newsletter</h3>
                            <h6>Announcement</h6>
                            <p>Only one block from 2 Talwar, this pristine 5 bedroom plus office, 5 bathroom 350sq yards
                                house is available for sale. Upon entering you are welcomed into an expansive open
                                living space that flows into the dining area with oversized open windows and high beamed
                                ceilings, perfect for entertaining or relaxing.</p>
                            <div class="subscribe-ads">
                                <h3>Ads</h3>
                                <img src="{{ asset('assets/img/ads2.png') }}" alt="" />
                                <img src="{{ asset('assets/img/ads2.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="viewed-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bannerHtext browse-htext recent-htext">
                            <h1>Recently Viewed Properties</h1>
                        </div>
                        <div class="viewedRow slider-properties">
                            @foreach ($myListingProperties as $property)
                                <div class="recent-inner">
                                    <div class="viewedMain">
                                        <div class="view-img">
                                            <a
                                                href="{{ route('admin.adminSavedPropertyDetail', ['id' => $property->id]) }}">
                                                <img src="{{ $property->source_url }}" alt="" />
                                            </a>

                                        </div>
                                        <div class="viewsub">

                                            <div class="view-text">
                                                <h4>
                                                    <a
                                                        href="{{ route('admin.adminSavedPropertyDetail', ['id' => $property->id]) }}">
                                                        {{ $property->addInformation->title }}
                                                    </a>

                                                </h4>

                                            </div>

                                            <div class="homeForsales">
                                                <img src="{{ asset('assets/img/eva_pin-outline (2).png') }}"
                                                    alt="" />
                                                <h3>{{ $property->locationAndPurpose->street_address }}</h3>


                                            </div>
                                            <div class="view-MainDiv">
                                                <div class="view-subdiv">
                                                    <h6>{{ $property->featureAndAmenity->bed_rooms }}</h6>
                                                    <img src="{{ asset('assets/bed.png') }}" alt="" />

                                                </div>
                                                <div class="view-subdiv">
                                                    <h6>{{ $property->featureAndAmenity->bath_rooms }}</h6>
                                                    <img src="{{ asset('assets/shower.png') }}" alt="" />

                                                </div>
                                            </div>
                                            <div class="price-Div">
                                                <span>{{ $property->priceAndArea->currency }}
                                                    {{ $property->priceAndArea->price }}</span>
                                                <i class="fa-regular fa-heart {{ $property->isFavorited ? 'favorited fa-solid' : '' }}"
                                                    data-property-id="{{ $property->id }}" id="heartIcon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- popular-section -->
        <section class="popular-section">
            <div class="container">
                <div class="row">
                    <div class="div-col-lg-12">
                        <div class="bannerHtext browse-htext recent-htext">
                            <h1>Popular Location</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="populartab-wrap">
                        <ul class="nav nav-tabs" id="populartab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="popular-tab1" data-bs-toggle="tab"
                                    data-bs-target="#popular1" type="button" role="tab"
                                    aria-controls="popular1" aria-selected="true">
                                    For Sales
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="popular-tab2" data-bs-toggle="tab"
                                    data-bs-target="#popular2" type="button" role="tab"
                                    aria-controls="popular2" aria-selected="false">
                                    to rent
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="popularTabContent">
                        <div class="tab-pane fade show active" id="popular1" role="tabpanel"
                            aria-labelledby="popular-tab1">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="popular-tabs">
                                        <ul>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="popular-tabs">
                                        <ul>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="popular-tabs">
                                        <ul>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="popular-tabs">
                                        <ul>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                            <li>
                                                <a href="">Albuquerque real estate</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="popular2" role="tabpanel" aria-labelledby="popular-tab2">
                            ..........BLANK............
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- newsletter-section -->
        <section class="newsletter-section">
            <div class="container">
                <div class="newsletter-wrapper">

                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                            <div class="mainNewsDiv">
                                <div class="news-letterText">
                                    <h4>Sign in to Newsletter</h4>
                                    <p>Save you time and easily rent ot sell your property with the lowest<br>
                                        commission on
                                        the real estate market.
                                    </p>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="email">Email</label><input type="email" id="email"
                                            placeholder="Email">
                                    </div>
                                    <div class="form-group HeaderBtn footerbtn">
                                        <input type="submit" name="SEND" class="std-btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer-section -->
        <section class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-logo">
                            <a href="">
                                <img src="{{ asset('assets/img/footer-logo.png') }}" alt="" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="footer-manuBar">
                            <h6>Company</h6>
                            <ul>
                                <li>
                                    <a href="">About Us</a>
                                </li>
                                <li>
                                    <a href="">Contact Us</a>
                                </li>
                                <li>
                                    <a href="">Help & Support</a>
                                </li>
                                <li>
                                    <a href="">Terms Of Use</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="footer-manuBar">
                            <h6>Connect</h6>
                            <ul>
                                <li>
                                    <a href="">Blog</a>
                                </li>
                                <li>
                                    <a href="">News</a>
                                </li>
                                <li>
                                    <a href="">Forum</a>
                                </li>
                                <li>
                                    <a href="">Add Property</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-manuBar">
                            <h6>Contact us</h6>
                            <ul class="contactDiv">
                                <li>
                                    <a href="" target="_blank">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>20 Cooper Square, New York, NY 10003, USA</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:(123-456-7890">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <span>123-456-7890</span>
                                    </a>
                                </li>
                                <li><a href="mailto:info@professionalchoicereality.com">
                                        <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                                        <span>info@professionalchoicereality.com</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-manuBar">
                            <h6>Get Connected</h6>
                            <ul>
                                <li>
                                    <a href="">Facebook</a>
                                </li>
                                <li>
                                    <a href="">Instagram</a>
                                </li>
                                <li>
                                    <a href="">YouTube</a>
                                </li>
                                <li>
                                    <a href="">Linkedin</a>
                                </li>
                                <li>
                                    <a href="">Twitter</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
        <section class="end-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="end-mainDiv">
                            <div class="end-text">
                                <p>© Copyright 2023 Professional Choice Reality. All Rights Reserved</p>
                            </div>
                            <div class="end-subDiv">
                                <p>Terms & Conditions</p>
                                <p>Privacy Policy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bootstrap Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="loginModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Login Required</h5>
                        <button type="button" class="close" data-dismiss="modal" id="closeBtn"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>You must be logged in to favorite this property <a href="{{ route('login') }}">log
                                in</a></p>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SLICK JS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/js/fontawesome.min.js"></script>

    <!-- JQuery  -->
    <script>
        var appUrl = "{{ config('app.url') }}";
        $(document).ready(function() {

            // Event listener for country dropdown change
            $('#inputCountry').on('change', function() {
                var countryId = $(this).val();
                var stateDropdown = $('#inputState');

                // Reset and disable the state dropdown
                stateDropdown.html('<option value="">Select a state</option>').prop('disabled', true);

                // If a country is selected, fetch and populate states using AJAX
                if (countryId) {
                    var ajaxUrl = appUrl + 'get-states/' + countryId;
                    $.ajax({
                        url: ajaxUrl,
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                // Enable the state dropdown and populate options
                                stateDropdown.prop('disabled', false);
                                $.each(data, function(index, state) {
                                    stateDropdown.append($('<option>', {
                                        value: state.name,
                                        text: state.name
                                    }));
                                });
                            }
                            // Optionally handle the case where states are empty
                            // else {
                            //     stateDropdown.hide(); // Hide the state dropdown
                            // }
                        },
                        error: function() {
                            console.error('Failed to fetch states.');
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".tabsRow").slick({
                dots: false,
                arrow: true,
                infinite: true,
                speed: 1000,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
            });


            $(".slider-properties").slick({
                dots: false,
                arrow: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true,
                        },
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ],
            });

            $(".slider-Global").slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                variableWidth: true,
                autoplay: false,
                prevArrow: false,
                nextArrow: false,
            });
        });
    </script>
    <script>
        $(document).on("click", '#closeBtn', function() {
            $('#loginModal').modal('hide');
        });
        $(document).on("click", ".fa-heart", function() {

            @auth
            // Perform the favorite action or any other logic here
            // For example, you can make an AJAX request to update the favorite status


            var propertyId = $(this).data('property-id');
            var isFavorited = $(this).hasClass('favorited'); // Check if the heart is already favorited
            var actionUrl = isFavorited ? '{{ route('unlike') }}' : '{{ route('like') }}';

            var abcd = $(this);
            $.ajax({
                url: actionUrl,
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    propertyId: propertyId
                },
                success: function(response) {
                    console.log("response", response);
                    if (isFavorited) {
                        // If it was favorited, remove the 'favorite' class
                        abcd.removeClass('favorited');
                        abcd.removeClass('fa-solid');
                        abcd.addClass('fa-regular');
                    } else {
                        // If it was not favorited, add the 'favorite' class
                        abcd.addClass('favorited');
                        abcd.addClass('fa-solid');
                        abcd.removeClass('fa-regular');
                    }
                },
                error: function(response) {
                    console.log('Error: ' + response);
                }
            });
            // alert('Property favorited!');
        @else
            // Redirect the user to the login page
            // window.location.href = "{{ route('login') }}";
            $('#loginModal').modal('show');
        @endauth
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#filterAllPoperties").click(function(e) {
                e.preventDefault();
                var purpose_type = $("#purpose_type").val();
                var country = $("#country").val();
                var state = $("#state").val();
                var property_type = $("#property_type").val();
                var area_and_size = $("#area_and_size").val();
                // var units = $("#units").val();
                var price = $("#price").val();
                var beds = $("#beds").val();
                var baths = $("#baths").val();
                var keywords = $("#keywords").val();
                if ((purpose_type == 0 || purpose_type == null) && (country == 0 || country == null) && (
                        state == 0 || state == null) && (property_type == 0 || property_type == null) && (
                        area_and_size == 0 || area_and_size == null) && (
                        price == 0 || price == null) && (
                        beds == 0 || beds == null) && (
                        baths == 0 || baths == null) && (
                        keywords == 0 || keywords == null)) {
                    $("#error_empty").text('At least 1 filter required')
                } else {
                    $("#error_empty").text('')

                    $.ajax({
                        url: 'user/filter-all-properties',
                        method: 'get',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            purpose_type: purpose_type,
                            country: country,
                            state: state,
                            property_type: property_type,
                            area_and_size: area_and_size,
                            price: price,
                            beds: beds,
                            baths: baths,
                            keywords: keywords
                        },
                        success: function(response) {
                            // Assuming the response has a 'data' property
                            var resultData = response.data;


                            // Clear existing content in #resultContainer
                            $("#resultContainer").html('');
                            // Example: Loop through resultData and append HTML content to #resultContainer
                            if (resultData.length != 0) {
                                resultData.forEach(function(item) {
                                    var htmlContent =
                                        '<div class="recent-inner col-md-6 col-12 mx-0"><div class="viewedMain">';
                                    htmlContent +=
                                        '<div class="view-img"><a href="{{ route('user.detailMyListingProperties', '') }}/' +
                                        item.id + '"><img src="' +
                                        item.source_url + '" alt="" /></a></div>';

                                    htmlContent +=
                                        '<div class="viewsub"><div class="view-text"><h4><a href="{{ route('user.detailMyListingProperties', '') }}/' +
                                        item.id + '">' +
                                        item.add_information.title +
                                        '</a></h4></div><div class="homeForsales"><img src="{{ asset('assets/img/eva_pin-outline (2).png') }}" alt="" />';
                                    htmlContent +=
                                        '<h3>' + item.location_and_purpose
                                        .street_address + '</h3></div>';
                                    htmlContent +=
                                        '<div class="view-MainDiv"><div class="view-subdiv"><h6>' +
                                        item.feature_and_amenity.bed_rooms +
                                        '</h6><img src="{{ asset('assets/bed.png') }}" alt="" /></div>';
                                    htmlContent +=
                                        '<div class="view-subdiv"><h6>' + item
                                        .feature_and_amenity.bath_rooms +
                                        '</h6><img src="{{ asset('assets/shower.png') }}" alt="" /></div></div>';
                                    htmlContent +=
                                        '<div class="price-Div"><span>' + item
                                        .price_and_area.currency + '.' +
                                        item.price_and_area.price + '</span>';
                                    htmlContent +=
                                        '<i class="fa-regular fa-heart ' + (item
                                            .isFavorited ? 'favorited fa-solid' : '') +
                                        '" data-property-id="' + item.id +
                                        '" id="heartIcon"></i></div></div></div></div>';

                                    // Append the generated HTML content to #resultContainer
                                    $("#resultContainer").append(htmlContent);
                                });

                            } else {


                                var htmlContent =
                                    '<div class="col-lg-4 col-md-6 col-12"><div class="listing-box">No Property Found!';

                                htmlContent += '</div></div>';

                                // Append the generated HTML content to #resultContainer
                                $("#resultContainer").append(htmlContent);

                            }


                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

            })
        })
    </script>
</body>

</html>
