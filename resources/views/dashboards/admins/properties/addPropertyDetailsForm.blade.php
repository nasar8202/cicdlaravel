@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Professional')

@section('content')
    <form action="{{ route('admin.addPropertyPost') }}" method="post">
        @csrf
        <h1 class="main-heading">Location & Purpose</h1>
        <div class="whitebg-with-shadow select-purpose-wrap">
            <h2 class="head">Select Purpose</h2>
            <div class="purpose-tabs">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#sell"><img
                                src="{{ URL::asset('assets/sell.png') }}" alt="" /> Sell</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#rent"><img src="{{ URL::asset('assets/rent.png') }}" alt="" />
                            Rent</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="sell"></div>
                    <div class="tab-pane" id="rent">
                </div>
                </div>
                <div class="onclick-get-this-html">
                    <div class="purpose-inner">
                            <input type="hidden" name="selected_tab" id="selected_tab" value="Sell">
                            <h2 class="head">Select Property Type</h2>
                            <div class="purpose-inner-tab">
                                <ul class="nav nav-pills">
                                    @foreach ($PropertyTypes as $key => $propertyType)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $key === 0 ? 'active' : '' }}" data-toggle="pill" onclick="updateHiddenInput('{{ $propertyType->title }}')" href="#{{ Str::slug($propertyType->title) }}2">{{ $propertyType->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" name="property_type" id="property_type" value="{{ $PropertyTypes[0]->title }}">
                                <div class="tab-content">
                                    @foreach ($PropertyTypes as $key => $propertyType)
                                        <div class="tab-pane {{ $key === 0 ? 'active' : '' }}" id="{{ Str::slug($propertyType->title) }}2">
                                            <div class="property-type home-type">
                                                @if ($propertyType->propertySubTypes->isEmpty())
                                                    <p>No subproperty types found for {{ $propertyType->title }}.</p>
                                                @else
                                                    @foreach ($propertyType->propertySubTypes as $subPropertyType)
                                                        <label><input type="radio"
                                                                onclick="propertySubTypes('{{ $subPropertyType->title }}')"
                                                                name="sub_type" required /> <span
                                                                class="active-bg">{{ $subPropertyType->title }}</span></label>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    <input type="hidden" name="subPropertyType" id="subPropertyType" value="{{ $subPropertyType->title }}">
                                </div>
                            </div>
                            <h2 class="head">Location Details</h2>
                            <div class="location-detail-wrap">
                                <div class="profile-main-wrapper">
                                    <div class="profile-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="">
                                                    <label class="form-label">Country</label>
                                                    <select class="form-control" id="inputCountry" name="country">
                                                        @forelse ($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}
                                                            </option>
                                                        @empty
                                                            <option value="">No Country Found!
                                                            </option>
                                                        @endforelse
                                                    </select>
                                                    <span class="text-danger error-text country_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="">
                                                    <label class="form-label">State</label>
                                                    <select class="form-control" id="inputState" name="state" disabled>
                                                        <option value="">Select a country first</option>
                                                    </select>
                                                    <span class="text-danger error-text state_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mt-3">
                                                    <label for="name" class="form-label">Street Address</label>
                                                    <input type="text" class="form-control" id="street_address"
                                                        placeholder="Type Street Address here" name="street_address"
                                                        minlength="3" maxlength="180" required />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <img src="{{ URL::asset('assets/map.png') }}" alt="" width="100%"
                                                    class="mt-3" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <h1 class="main-heading mt-5">Price and Area</h1>
        <div class="whitebg-with-shadow">
            <h2 class="head">Select Purpose</h2>
            <div class="price-area">
                <div class="profile-form">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-4">
                                <label class="form-label">Area Size</label>
                                <select class="form-control" name="area_and_size" id="area_and_size">
                                    <option disabled selected>Enter Unit</option>
                                    @foreach (range(1, 20) as $number)
                                        <option value="{{ $number }}">{{ $number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-4">
                                <label class="form-label">Select Unit</label>
                                <select class="form-control" name="units" id="units">
                                    <option disabled selected>Sq. Ft.</option>
                                    @foreach (range(1, 20) as $number)
                                        <option value="{{ $number }}">{{ $number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="">
                                <label class="form-label">Price</label>
                                <select class="form-control" name="price" id="price">
                                    <option disabled selected>Enter Price</option>
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
                        <div class="col-md-2">
                            <div class="">
                                <label class="form-label">Select Currency</label>
                                <select class="form-control" name="currency" id="currency">
                                    <option value="USD">USD</option>
                                    <option value="INR">INR</option>
                                    <option value="PKR">PKR</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="main-heading mt-5">Feature & Amenities</h1>
        <div class="whitebg-with-shadow big-padding-right">
            <div class="feature-wrap">
                <h2 class="head">Bedrooms</h2>
                <div class="property-type commercial-type mb-4">
                    <label><input type="radio" name="bed_rooms" value="Studio" required />
                        <span class="active-bg">Studio</span></label>
                    <label><input type="radio" name="bed_rooms" value="1" required />
                        <span class="active-bg">01</span></label>
                    <label><input type="radio" name="bed_rooms" value="2" required />
                        <span class="active-bg">02</span></label>
                    <label><input type="radio" name="bed_rooms" value="3" required />
                        <span class="active-bg">03</span></label>
                    <label><input type="radio" name="bed_rooms" value="4" required />
                        <span class="active-bg">04</span></label>
                    <label><input type="radio" name="bed_rooms" value="5" required />
                        <span class="active-bg">05</span></label>
                    <label><input type="radio" name="bed_rooms" value="6" required />
                        <span class="active-bg">06</span></label>
                    <label><input type="radio" name="bed_rooms" value="7" required />
                        <span class="active-bg">07</span></label>
                    <label><input type="radio" name="bed_rooms" value="8" required />
                        <span class="active-bg">08</span></label>
                    <label><input type="radio" name="bed_rooms" value="9" required />
                        <span class="active-bg">09</span></label>
                    <label><input type="radio" name="bed_rooms" value="10" required />
                        <span class="active-bg">10</span></label>
                    <label><input type="radio" name="bed_rooms" value="10+" required />
                        <span class="active-bg">10+</span></label>
                </div>

                <h2 class="head">Bathrooms</h2>
                <div class="property-type commercial-type mb-4">
                    <label><input type="radio" name="bath_rooms" value="1" required />
                        <span class="active-bg">01</span></label>
                    <label><input type="radio" name="bath_rooms" value="2" required />
                        <span class="active-bg">02</span></label>
                    <label><input type="radio" name="bath_rooms" value="3" required />
                        <span class="active-bg">03</span></label>
                    <label><input type="radio" name="bath_rooms" value="4" required />
                        <span class="active-bg">04</span></label>
                    <label><input type="radio" name="bath_rooms" value="5" required />
                        <span class="active-bg">05</span></label>
                    <label><input type="radio" name="bath_rooms" value="6" required />
                        <span class="active-bg">06</span></label>
                </div>
                <h2 class="head mb-2">Feature and Amenities</h2>
                <p>Add additional features e.g. parking spaces, waste disposal, internet etc.</p>
                <textarea name="additional_features" placeholder="Feature and Amenities" id="" cols="30"
                    rows="4" class="form-control" required></textarea>
            </div>
        </div>
        <h1 class="main-heading mt-5">Ad Information</h1>
        <div class="whitebg-with-shadow big-padding-right">
            <div class="price-area">
                <div class="profile-form mt-0">
                    <div class="mb-4">
                        <label class="form-label">Title</label>
                        <input type="text" placeholder="Enter Property Title" name="title" class="form-control"
                            required />
                    </div>
                    <div class="">
                        <label class="form-label">Description</label>
                        <textarea name="description" placeholder="Describe your property, it’s feature, area it is in etc." id=""
                            cols="30" rows="5" class="form-control" required></textarea>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="main-heading mt-5">Property Images & Videos</h1>
        <div class="whitebg-with-shadow">
            <div class="property-img-wrap">
                <h2 class="head">Upload Images of your Property</h2>
                <div class="property-img-inner">
                    <div class="upload-btn-wrap">
                        <label><input type="file" id="property-img" name="images[]" multiple
                                accept="image/png, image/jpeg" required />+ Upload Images</label>
                        <p>Max size 5MB, .jpg .png only</p>
                    </div>
                    <input type="hidden" id="image-paths" name="image_paths[]" />
                    <div id="property-images"></div>
                    <button class="primary-btn mt-3" id="uploadButton">Upload Images</button>
                </div>
                <h2 class="head mt-5">Add Videos of your Property</h2>
                <div class="property-img-inner property-video-wrap">
                    <div class="upload-btn-wrap">
                        <label><input type="file" id="property-video" name="videos[]" multiple accept="video/*"
                                required />+ Upload
                            Video</label>
                    </div>
                    <div id="property-videos"></div>
                    <input type="hidden" id="video-paths" name="video_paths[]" />
                    <button class="primary-btn mt-3" id="uploadVideoButton">Upload Videos</button>
                </div>
            </div>
        </div>
        <h1 class="main-heading mt-5">Contact Information</h1>
        <div class="whitebg-with-shadow big-padding-right">
            <div class="contact-info">
                <div class="profile-form mt-0">
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" placeholder="Type Email Here" name="email" class="form-control"
                            required />
                    </div>
                    <div class="">
                        <label class="form-label">Mobile</label>
                        <input type="number" placeholder="Mobile" name="contact_number" class="form-control"
                            required />
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="primary-btn mt-5">Submit Property Ad</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Event listener for country dropdown change
            $('#inputCountry').on('change', function() {
                var countryId = $(this).val();
                var stateDropdown = $('#inputState');

                // Reset and disable the state dropdown
                stateDropdown.html('<option value="">Select a state</option>').prop('disabled', true);

                // If a country is selected, fetch and populate states using AJAX
                if (countryId) {
                    var ajaxUrl = appUrl + 'admin/get-states-for-property/' + countryId;
                    $.ajax({
                        url: ajaxUrl,
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                // Enable the state dropdown and populate options
                                stateDropdown.prop('disabled', false);
                                $.each(data, function(index, state) {
                                    stateDropdown.append($('<option>', {
                                        value: state.id,
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
    <script>
        function updateHiddenInput(tabTitle) {
            // Update the hidden input field with the selected tab value
            document.getElementById('property_type').value = tabTitle;
        }

        function propertySubTypes(tabTitle) {

            document.getElementById('subPropertyType').value = tabTitle;
        }
    </script>
    <script>
        // Array to store image paths
        var imagePaths = [];

        $('#uploadButton').click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            var files = $('#property-img')[0].files;

            for (var i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }
            var uploadImage = appUrl + 'admin/uploadImage';
            $.ajax({
                url: uploadImage, // Replace with your Laravel route for handling file upload
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle the response (routes) here
                    console.log(response);
                    // Update the hidden field with image paths
                    imagePaths = response;
                    $('#image-paths').val(imagePaths.join(','));

                    // Display image routes
                    //  displayImageRoutes(imagePaths);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // function displayImageRoutes(routes) {
        //     var imageContainer = $('#property-images');
        //     imageContainer.empty();

        //     $.each(routes, function(index, route) {
        //         // Create image elements and append to the container
        //         var imgElement = $('<img>').attr('src', route).attr('alt', 'Image');
        //         imageContainer.append(imgElement);
        //     });
        // }

        var videoUrls = [];

        $('#uploadVideoButton').click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            var files = $('#property-video')[0].files;

            for (var i = 0; i < files.length; i++) {
                formData.append('videos[]', files[i]);
            }
            var uploadVideo = appUrl + 'admin/uploadVideo';
            $.ajax({
                url: uploadVideo, // Replace with your Laravel route for handling video upload
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    videoUrls = response;
                    // Assuming you have a hidden field for video URLs
                    $('#video-paths').val(videoUrls.join(','));

                    // Display video routes
                    // displayVideoRoutes(videoUrls);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Add a function to display video routes if needed
        // function displayVideoRoutes(routes) {
        //     var videoContainer = $('#property-videos');
        //     videoContainer.empty();
        //
        //     $.each(routes, function(index, route) {
        //         var videoElement = $('<video controls>').attr('src', route).attr('type', 'video/mp4');
        //         videoContainer.append(videoElement);
        //     });
        // }
        
        $('.purpose-tabs > .nav-pills > .nav-item > .nav-link').on('click', function() {
            var clickedLinkText = $(this).text().trim();
            $('.onclick-get-this-html input#selected_tab').val(clickedLinkText);
        });
    </script>

@endsection
