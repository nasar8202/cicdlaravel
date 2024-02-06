@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'My Listings')

@section('content')
    <h1 class="main-heading">My Listing Properties</h1>
    <div class="listing-wrapper">
        <div class="row">
            @forelse($myListingProperties as $myListingProperty)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="listing-box">
                        <div class="list-img">
                            <a href="{{ route('user.detailMyListingProperties', $myListingProperty->id) }}"><img
                                    src="{{ $myListingProperty->source_url }}" alt="" /></a>
                        </div>
                        <div class="list-content">
                            <a href="{{ route('user.detailMyListingProperties', $myListingProperty->id) }}">
                                <h2>{{ $myListingProperty->addInformation->title }}</h2>
                            </a>
                            <p><i class="fa-solid fa-location-dot"></i>
                                {{ $myListingProperty->locationAndPurpose->street_address }}</p>
                            <div class="room-spec">
                                <h3> {{ $myListingProperty->featureAndAmenity->bed_rooms }}<i class="fa fa-bed"
                                        aria-hidden="true"></i></h3>
                                <h3> {{ $myListingProperty->featureAndAmenity->bed_rooms }}<i class="fa fa-shower"
                                        aria-hidden="true"></i></h3>
                                <h3><i class="fa fa-arrows-v" aria-hidden="true"></i>
                                    {{ $myListingProperty->priceAndArea->area_and_size }}
                                    {{ $myListingProperty->priceAndArea->units }}</h3>
                            </div>
                            <div class="price-fav">
                                <h2 class="price"> {{ $myListingProperty->priceAndArea->currency }}
                                    {{ $myListingProperty->priceAndArea->price }}</h2>
                                <div class="hearts">
                                    <i class="fa-regular fa-heart"></i>
                                    <!-- <i class="fa fa-heart" aria-hidden="true"></i> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12 col-md-6 col-12">
                    <div class="listing-box">

                        <div class="list-content">
                            No Property Found!
                        </div>
                    </div>
                </div>
            @endforelse


        </div>
    </div>
@endsection
