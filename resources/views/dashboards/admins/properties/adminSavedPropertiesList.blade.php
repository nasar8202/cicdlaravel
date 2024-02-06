@extends('dashboards.admins.layouts.admin-dash-layout')
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
    </div>
    <h1 class="main-heading mt-5">Saved Properties</h1>
    <div class="listing-wrapper">
        <div class="row" id="resultContainer">
            <div class="col-lg-4 col-md-6 col-12">
                
            <div class="listing-box">
                <div class="list-img">
                    <a href="{{ route('admin.adminSavedPropertyDetail', 1) }}"><img
                            src="{{ URL::asset('assets/house1.png') }}" alt="" /></a>
                </div>
                <div class="list-content">
                    <a href="{{ route('admin.adminSavedPropertyDetail', 1) }}">
                        <h2>2066 Crist Drive</h2>
                    </a>
                    <p><i class="fa-solid fa-location-dot"></i> 110 Treillage Ln, Peachtree City, GA 30269</p>
                    <div class="room-spec">
                        <h3>3 <i class="fa fa-bed" aria-hidden="true"></i></h3>
                        <h3>3 <i class="fa fa-shower" aria-hidden="true"></i></h3>
                        <h3><i class="fa fa-arrows-v" aria-hidden="true"></i> 250 Sq.Yd.</h3>
                    </div>
                    <div class="price-fav">
                        <h2 class="price">$395,000</h2>
                        <div class="hearts">
                            <i class="fa-regular fa-heart"></i>
                            <!-- <i class="fa fa-heart" aria-hidden="true"></i> -->
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
                        // Clear existing content in #resultContainer
                        $("#resultContainer").html('');
                        // Example: Loop through resultData and append HTML content to #resultContainer
                        if (resultData.length != 0) {
                            // alert(43)
                            resultData.forEach(function(item) {
                                var htmlContent =
                                    '<div class="col-lg-4 col-md-6 col-12"><div class="listing-box">';
                                htmlContent +=
                                    '<div class="list-img"><a href=""><img src="' + item
                                    .source_url + '" alt="" /></a></div>';
                                htmlContent +=
                                    '<div class="list-content"><a href="{{ route('admin.adminSavedPropertyDetail', 1) }}"><h2>' +
                                    item.title +
                                    '</h2></a><p><i class="fa-solid fa-location-dot"></i> ' +
                                    item.street_address +
                                    '</p><div class="room-spec"><h3>' + item.bed_rooms +
                                    '<i class="fa fa-bed" aria-hidden="true"></i></h3><h3>' +
                                    item.bath_rooms +
                                    ' <i class="fa fa-shower" aria-hidden="true"></i></h3><h3><i class="fa fa-arrows-v" aria-hidden="true"></i> ' +
                                    item.area_and_size + '.' + item.units +
                                    '</h3></div><div class="price-fav"><h2 class="price">' +
                                    item.currency + '.' + item.price +
                                    '</h2><div class="hearts"><i class="fa-regular fa-heart"></i></div></div></div>';
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
            })
        })
    </script>
@endpush
