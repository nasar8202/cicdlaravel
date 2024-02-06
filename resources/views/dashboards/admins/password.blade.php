@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Settings')

@section('content')
    <h1 class="main-heading">Change Password</h1>
    <form action="{{ route('adminChangePassword') }}" method="POST" id="changePasswordAdminForm">
        <div class="profile-main-wrapper">
            <div class="row no-gutters align-items-center">
                <div class="col-lg-7">
                    <div class="profile-form">
                        <div class="row no-gutters">
                            <div class="col-lg-12">
                                <div class="mb-3 mt-3">
                                    <label for="inputName" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="inputName"
                                        placeholder="Enter current password" name="oldpassword" minlength="3"
                                        maxlength="180" />
                                    <span class="text-danger error-text oldpassword_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mt-3">
                                    <label for="newpassword" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="newpassword"
                                        placeholder="Enter new password" name="newpassword" minlength="3"
                                        maxlength="180" />
                                    <span class="text-danger error-text newpassword_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mt-3">
                                    <label for="mobile" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="ReEnter new password"
                                        name="cnewpassword" id="cnewpassword" minlength="3" maxlength="180" />
                                    <span class="text-danger error-text cnewpassword_error"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-5">
                                <button class="primary-btn" type="submit">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="rightImg">
                        <img src="assets/lock.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
