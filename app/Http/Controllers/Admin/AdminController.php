<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App\Models\User;
use App\Models\Country;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AddInformation;
use App\Models\PropertySubType;
use App\Models\FeatureAndAmenity;
use App\Models\ContactInformation;
use App\Models\LocationAndPurpose;
use Illuminate\Support\Facades\DB;
use App\Models\PropertyImageAndVideo;

class AdminController extends Controller
{
    public function registeredUsers()
    {
        $registeredUsers = User::where('role', 2)->get();
        return view('dashboards.admins.users', compact('registeredUsers'));
    }
    function index()
    {
        $registeredUsers = User::where('role', 2)->count();
        $activeProperties = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->where('status', 'Active')->count();
        $soldProperties = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->where('status', 'Sold')->count();

        $allProperties = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->where('status', 'Sold')->get();

        //dd($activeProperties, $soldProperties);
        return view('dashboards.admins.index', compact('registeredUsers', 'soldProperties', 'activeProperties', 'allProperties'));
    }

    public function getUserGrowthData()
    {
        $dailyData = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereDate('created_at', '>=', now()->subDays(7)) // Assuming you want data for the last 7 days
            ->groupBy('date')
            ->orderByRaw('date')
            ->pluck('count');

        return response()->json($dailyData);
    }

    public function getNumberOfListingsData()
    {
        // Fetch the number of listings data from your database
        $propertyTypes = ["Sell", "Rent"]; // Replace with actual property types
        //$numberOfListings = Property::whereIn('purpose_type', $propertyTypes)->count();
        $numberOfListings = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->whereIn('purpose_type', $propertyTypes)->count();
        return response()->json([
            'propertyTypes' => $propertyTypes,
            'numberOfListings' => $numberOfListings,
        ]);
    }
    public function getStates($countryId)
    {
        $country = Country::where('name', $countryId)->first();

        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        $states = $country->states;

        return response()->json($states);
    }

    function profile()
    {
        $countries = Country::where('status', 'Active')->get();
        return view('dashboards.admins.profile', compact('countries'));
    }

    public function userManagement($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $countries = Country::where('status', 'Active')->get();
        return view('dashboards.admins.userManagement', compact('countries', 'user'));
    }
    public function getChangePassword()
    {
        return view('dashboards.admins.password');
    }
    function settings()
    {
        return view('dashboards.admins.settings');
    }

    function updateInfo(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            // 'favoritecolor'=>'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'whatsapp_number' => $request->whatsapp_number,
                'dialing_code' => $request->address,
                'country' => $request->country,
                'state' => $request->state,
                'update_details' => $request->update_details,
            ]);

            if (!$query) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile info has been update successfuly.']);
            }
        }
    }

    function updatePicture(Request $request)
    {
        $path = 'users/images/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        //Upload new image
        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, upload new picture failed.']);
        } else {
            //Get Old picture
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

            if ($oldPicture != '') {
                if (\File::exists(public_path($path . $oldPicture))) {
                    \File::delete(public_path($path . $oldPicture));
                }
            }

            //Update DB
            $update = User::find(Auth::user()->id)->update(['picture' => $new_name]);

            if (!$upload) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, updating picture in db failed.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile picture has been updated successfully']);
            }
        }
    }


    function changePassword(Request $request)
    {
        //Validate form
        $validator = \Validator::make($request->all(), [
            'oldpassword' => [
                'required', function ($attribute, $value, $fail) {
                    if (!\Hash::check($value, Auth::user()->password)) {
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'newpassword' => 'required|min:8|max:30',
            'cnewpassword' => 'required|same:newpassword'
        ], [
            'oldpassword.required' => 'Enter your current password',
            'oldpassword.min' => 'Old password must have atleast 8 characters',
            'oldpassword.max' => 'Old password must not be greater than 30 characters',
            'newpassword.required' => 'Enter new password',
            'newpassword.min' => 'New password must have atleast 8 characters',
            'newpassword.max' => 'New password must not be greater than 30 characters',
            'cnewpassword.required' => 'ReEnter your new password',
            'cnewpassword.same' => 'New password and Confirm new password must match'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $update = User::find(Auth::user()->id)->update(['password' => \Hash::make($request->newpassword)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, Failed to update password in db']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully']);
            }
        }
    }
}
