<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Property;
use App\Models\Favourite;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\LocationAndPurpose;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function unlike(Request $request)
    {
        $userId = auth()->id();
        $property_id = $request->input('propertyId');

        // Check if the user has liked the vehicle
        $liked = DB::table('favourites')
            ->where('user_id', $userId)
            ->where('property_id', $property_id)
            ->exists();

        if ($liked) {
            // If the user has liked the vehicle, remove the like
            DB::table('favourites')
                ->where('user_id', $userId)
                ->where('property_id', $property_id)
                ->delete();

            return response()->json(['message' => 'Unliked']);
        } else {
            // If the user hasn't liked the vehicle, no action is needed
            return response()->json(['message' => 'Not liked']);
        }
    }
    public function like(Request $request)
    {
        // DB::beginTransaction();
        try {
            $userId = auth()->id();

            // Check if the user has already liked the property
            $liked = DB::table('favourites')
                ->where('user_id', $userId)
                ->where('property_id', $request->propertyId)
                ->exists();

            if ($liked) {
                DB::table('favourites')
                    ->where('user_id', $userId)
                    ->where('property_id', $request->propertyId)
                    ->delete();

                return response()->json(['message' => 'Unliked']);
            } else {
                $favourite = new Favourite();
                $favourite->user_id = $userId;
                $favourite->property_id =  $request->propertyId;
                $favourite->save();

                // DB::table('favourites')->insert([
                //     'user_id' => $userId,
                //     'property_id' => $request->propertyId,
                // ]);

                return response()->json(['message' => 'Liked']);
            }
        } catch (\Exception $e) {
            // DB::rollBack();
            return response()->json(['error' => 'Error processing request'], 500);
        }
        // DB::commit();
    }

    function index()
    {
        $userId = auth()->id();
        $myListingProperties = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->get()
        ->map(function ($property) use ($userId) {
            $property->isFavorited = Favourite::where('user_id', $userId)
                ->where('property_id', $property->id)
                ->exists();
            return $property;
        });
        $countries = Country::where('status', 'Active')->get();
        $getallProperties = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->get();
        $locationAndPurposes = LocationAndPurpose::get();
        $propertyTypes = PropertyType::where('status', 'Active')->get();
        // dd($myListingProperties);
        // return $myListingProperties;
        return view('dashboards.users.index', compact('myListingProperties','countries','locationAndPurposes','propertyTypes'));
    }

    function profile()
    {
        $countries = Country::where('status', 'Active')->get();
        return view('dashboards.users.profile', compact('countries'));
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
    public function getChangePassword()
    {
        return view('dashboards.users.password');
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

    function settings()
    {
        return view('dashboards.users.settings');
    }
}
