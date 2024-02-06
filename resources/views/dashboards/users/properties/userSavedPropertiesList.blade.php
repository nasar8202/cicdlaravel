@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'Saved Properties list')

@section('content')
    <h1 class="main-heading">Search Property</h1>
    <div class="search-property">
        <form>
            @csrf
            <div class="profile-main-wrapper">
                <div class="search-property-form profile-form mt-0">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <select class="form-control" name="purpose_type" id="purpose_type">
                                    <option value="">Purpose Type</option>
                                    <option value="Sell">Sale</option>
                                    <option value="Rent">Rent</option>
                                    <option value="Buy">Buy</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
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
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <select class="form-control" name="state" id="state">
                                    <option value="">States</option>
                                    @foreach ($countries as $country)
                                        <optgroup label="{{ $country->name }}">
                                            @foreach ($country->states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <select class="form-control" id="property_type" name="property_type">
                                    <option value="">Property Type</option>
                                    @foreach ($propertyTypes as $propertyType)
                                        <option value="{{ $propertyType->title }}">{{ $propertyType->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <select class="form-control" name="area_and_size" id="area_and_size">
                                    <option value="">Size Range</option>
                                    @foreach (range(1, 20) as $number)
                                        <option value="{{ $number }}">{{ $number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
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
                        <div class="col-lg-2">
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
                        <div class="col-lg-2">
                            <div class="mb-4">
                                <select class="form-control" id="baths" name="baths">
                                    <option value="">Baths</option>
                                    @foreach (range(1, 6) as $number)
                                        <option value="{{ $number }}">{{ $number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <input type="text" name="keywords" id="keywords" placeholder="Keywords"
                                    class="form-control" />
                            </div>
                        </div>
                        {{-- <div class="col-lg-2">
                            <div class="mb-4">
                                <select class="form-control" required>
                                    <option disabled>More Filters</option>
                                    <option>More Filters</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-4">
                                <select class="form-control" required>
                                    <option disabled>Saved Searches</option>
                                    <option>Saved Searches</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <button id="filterData" class="primary-btn">Save Search</button>
                </div>
            </div>
        </form>
        <p id="error_empty"></p>
    </div>
    <div class="search-saved-property">
        <div class="row">
            <div class="col-md-9">
                <div class="sarch-properties">
                    {{-- <div class="top row justify-content-between align-items-center">
                        <div class="col-lg-4">
                            <p>1 to 25 of 24423 Homes</p>
                        </div>
                        <div class="col-lg-4">
                            <form action="">
                                <div class="">
                                    <select class="form-control" required>
                                        <option disabled>Newest</option>
                                        <option>Newest</option>
                                        <option>Featured</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2 text-right">
                            <span class="menu-icon"><i class="fa-solid fa-bars"></i></span>
                        </div>
                    </div> --}}
                    <h1 class="main-heading">Saved Properties</h1>
                    <div class="listing-wrapper">
                        <div class="row" id="resultContainer">
                            @forelse($savedProperties as $savedProperty)
                                <div class="col-md-6 col-12">
                                    <div class="listing-box">
                                        <div class="list-img">
                                            <a href="{{ route('user.userSavedPropertyDetail', $savedProperty->id) }}"><img
                                                    src="{{ $savedProperty->source_url }}" alt="" /></a>
                                        </div>
                                        <div class="list-content">
                                            <div class="sarch-page-listing-title">
                                                <a href="{{ route('user.userSavedPropertyDetail', $savedProperty->id) }}">
                                                    <h2>{{ $savedProperty->addInformation->title }}</h2>
                                                </a>
                                                <div class="hearts">
                                                    <i class="fa-heart fa-solid"></i>
                                                </div>
                                            </div>
                                            <p><i class="fa-solid fa-location-dot"></i>
                                                {{ $savedProperty->locationAndPurpose->street_address }}</p>
                                            <div class="room-spec">
                                                <h3>{{ $savedProperty->featureAndAmenity->bed_rooms }} <i class="fa fa-bed"
                                                        aria-hidden="true"></i></h3>
                                                <h3>{{ $savedProperty->featureAndAmenity->bath_rooms }} <i
                                                        class="fa fa-shower" aria-hidden="true"></i></h3>
                                                <h3><i class="fa fa-arrows-v" aria-hidden="true"></i>
                                                    {{ $savedProperty->priceAndArea->area_and_size }}
                                                    {{ $savedProperty->priceAndArea->units }} </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-6 col-12">
                                    <div class="listing-box">

                                        <div class="list-content">
                                            No Property Found!
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="subscribe-newsletter">
                    <h2>Subscribe to Newsletter</h2>
                    <h3>Announcement</h3>
                    <p>
                        Only one block from 2 Talwar, this pristine 5 bedroom plus office, 5 bathroom 350sq yards house is
                        available for sale. Upon entering you are welcomed into an expansive open living
                        space that flows into the dining area with oversized open windows and high beamed ceilings, perfect
                        for entertaining or relaxing.
                    </p>
                    <div class="ads row">
                        <div class="col-6">
                            <div class="ad-img">
                                <img src="{{ URL::asset('assets/1.png') }}" alt="" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ad-img">
                                <img src="{{ URL::asset('assets/2.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('child-scripts')
    <script>
        $(document).ready(function() {
            $("#filterData").click(function(e) {
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
                        url: 'filter-saved-properties',
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

                            console.log("rsu", resultData.length);
                            console.log("ttttt", resultData);
                            // Clear existing content in #resultContainer
                            $("#resultContainer").html('');
                            // Example: Loop through resultData and append HTML content to #resultContainer
                            if (resultData.length != 0) {

                                resultData.forEach(function(item) {
                                    console.log("item", item)
                                    var htmlContent =
                                        '<div class="col-md-6 col-12 "><div class="listing-box">';
                                    htmlContent +=
                                        '<div class="list-img"><a href="{{ route('user.detailMyListingProperties', '') }}/' +
                                        item.id + '"><img src="' +
                                        item.source_url + '" alt="" /></a></div>';

                                    htmlContent +=
                                        '<div class="list-content"><a href="{{ route('user.detailMyListingProperties', '') }}/' +
                                        item.id + '"><h2>' +
                                        item.add_information.title +
                                        '</h2></a><p><i class="fa-solid fa-location-dot"></i> ' +
                                        item.location_and_purpose.street_address +
                                        '</p><div class="room-spec"><h3>' + item
                                        .feature_and_amenity.bed_rooms +
                                        '<i class="fa fa-bed" aria-hidden="true"></i></h3><h3>' +
                                        item.feature_and_amenity.bath_rooms +
                                        ' <i class="fa fa-shower" aria-hidden="true"></i></h3><h3><i class="fa fa-arrows-v" aria-hidden="true"></i> ' +
                                        item.price_and_area.area_and_size + '.' + item
                                        .price_and_area.units +
                                        '</h3></div><div class="price-fav"><h2 class="price">' +
                                        item.price_and_area.currency + '.' + item
                                        .price_and_area.price +
                                        '</h2><div class="hearts"><i class="fa-heart fa-solid"></i></div></div></div>';
                                    htmlContent += '</div></div>';

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
@endpush
