@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="profile">
                <div class="profile-img">
                    <img id="dp" src="{{ Auth::user()->picture }}"
                        class="profile-user-img img-fluid img-circle admin_picture" alt="User profile picture" />

                    <label for="profile-image"><input type="file" name="admin_image" id="admin_image" class="d-none" />
                        <span class="fa-solid fa-camera" id="change_picture_btn"></span> </label>

                </div>
                <div class="profile-content">
                    <h1>{{ Auth::user()->name }}</h1>
                    <h2>{{ Auth::user()->email }}</h2>
                </div>
            </div>

        </div>
    </div>
    <form action="{{ route('adminUpdateInfo') }}" id="AdminInfoForm" method="post">
        <div class="profile-main-wrapper">

            <div class="profile-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="John Doe" name="name"
                                minlength="3" value="{{ Auth::user()->name }}" maxlength="180" required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                name="email" minlength="3" maxlength="180" value="{{ Auth::user()->email }}" required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3 mt-3">
                            <label for="inputName2" class="form-label">Mobile</label>
                            <input type="number" class="form-control" id="mobile" placeholder="Mobile"
                                value="{{ Auth::user()->mobile_number }}" name="mobile_number" minlength="3"
                                maxlength="180" required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3 mt-3">
                            <label for="whatsapp" class="form-label">Whatsapp</label>
                            <input type="number" class="form-control" id="whatsapp" placeholder="Whatsapp"
                                value="{{ Auth::user()->whatsapp_number }}" name="whatsapp_number" minlength="3"
                                maxlength="180" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3 mt-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Address"
                                value="{{ Auth::user()->dialing_code }}" name="address" minlength="3" maxlength="1000"
                                required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3 mt-3">
                            <label for="whatsapp" class="form-label">Country</label>
                            <select class="form-control" id="inputCountry" name="country">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->name }}" @if ($country->name == Auth::user()->country) selected @endif>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text country_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3 mt-3">
                            <label for="whatsapp" class="form-label">State</label>
                            <select class="form-control" id="inputState" name="state"
                                @if (Auth::user()->state) disabled @endif>
                                @if (Auth::user()->state)
                                    <option value="{{ Auth::user()->state }}" selected>{{ Auth::user()->state }}
                                    </option>
                                @else
                                    <option value="">Select a country first</option>
                                @endif
                            </select>
                            <span class="text-danger error-text state_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-check-inline">
                            <label class="form-check-label"> <input type="checkbox" class="form-check-input"
                                    value="1" name="update_details"
                                    @if (Auth::user()->update_details == 1) checked @endif />Update details in all property
                                listings
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="primary-btn" type="submit">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
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
                     var ajaxUrl = appUrl + 'admin/get-states/' + countryId;
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

@endsection
