<?php

namespace App\Http\Controllers\User;

use App\Models\Country;
use App\Models\Property;
use App\Models\PriceAndArea;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\AddInformation;
use App\Models\FeatureAndAmenity;
use App\Models\ContactInformation;
use App\Models\LocationAndPurpose;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyImageAndVideo;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserPropertyManagementController extends Controller
{
    //
    public function alitest()
    {
        $myListingProperties = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->paginate();
        return $myListingProperties;
        // dd($myListingProperties);
        return view('dashboards.users.properties.myListingProperties', compact('myListingProperties'));
    }
    public function addPropertyDetailsForm()
    {
        $PropertyTypes = PropertyType::where('status', 'active')->get();
        $countries = Country::where('status', 'Active')->get();
        return view('dashboards.users.properties.addPropertyDetailsForm', compact('PropertyTypes', 'countries'));
    }
    public function getStatesForProperty($countryId)
    {
        $country = Country::where('id', $countryId)->first();

        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        $states = $country->states;

        return response()->json($states);
    }
    public function uploadVideo(Request $request)
    {
        $videoUrls = [];

        foreach ($request->file('videos') as $video) {
            // Upload the video to Cloudinary
            $upload = Cloudinary::upload($video->getRealPath(), ['resource_type' => 'video']);
            // Get the URL of the uploaded video from the Cloudinary response
            $videoUrl = $upload->getSecurePath();
            // Save the URL in an array
            $videoUrls[] = $videoUrl;
        }

        return response()->json($videoUrls);
    }
    public function uploadImage(Request $request)
    {
        $imageUrls  = [];

        foreach ($request->file('images') as $image) {
            // Upload the image to Cloudinary
            $upload = Cloudinary::upload($image->getRealPath());

            // Get the URL of the uploaded image from the Cloudinary response
            $imageUrl = $upload->getSecurePath();
            // Save the URL in an array
            $imageUrls[] = $imageUrl;
        }
        return response()->json($imageUrls);
    }
    public function addPropertyPost(Request $request)
    {
        // Validation rules
        $rules = [
            'selected_tab' => 'required',
            'property_type' => 'required',
            'subPropertyType' => 'required',
            'country' => 'required',
            'state' => 'required',
            'street_address' => 'required',
            'area_and_size' => 'required',
            'units' => 'required',
            'price' => 'required',
            'currency' => 'required',
            'bed_rooms' => 'required',
            'bath_rooms' => 'required',
            'additional_features' => 'required',
            'title' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required|numeric',
            'image_paths' => 'required',
          
            'video_paths' => 'required',
          
        ];

       

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($request->all());
        $image_paths = explode(",", $request->image_paths[0]);

        //  dd($request->all());
        set_time_limit(300);
        try {
            DB::beginTransaction();
            $locationAndPurpose = new LocationAndPurpose();
            $locationAndPurpose->purpose_type = $request->selected_tab;
            $locationAndPurpose->property_type = $request->property_type;
            $locationAndPurpose->property_sub_type = $request->subPropertyType;
            $locationAndPurpose->country = $request->country;
            $locationAndPurpose->states = $request->state;
            $locationAndPurpose->street_address = $request->street_address;
            $locationAndPurpose->save();

            $location_and_purpose_id = $locationAndPurpose->id;

            $priceAndArea = new PriceAndArea();
            $priceAndArea->area_and_size = $request->area_and_size;
            $priceAndArea->price = $request->price;
            $priceAndArea->units = $request->units;
            $priceAndArea->currency = $request->currency;
            $priceAndArea->save();

            $price_and_area_id = $priceAndArea->id;

            $featureAndAmenity = new FeatureAndAmenity();
            $featureAndAmenity->bed_rooms =  $request->bed_rooms;
            $featureAndAmenity->bath_rooms  = $request->bath_rooms;
            $featureAndAmenity->additional_features  = $request->additional_features;
            $featureAndAmenity->bed_rooms  = $request->bed_rooms;
            $featureAndAmenity->save();

            $feature_and_amenity_id = $featureAndAmenity->id;

            $addInformation = new AddInformation();
            $addInformation->title = $request->title;
            $addInformation->description = $request->description;
            $addInformation->save();

            $add_information_id = $addInformation->id;

            $contactInformation = new ContactInformation();
            $contactInformation->email = $request->email;
            $contactInformation->contact_number = $request->contact_number;
            $contactInformation->save();

            $contact_information_id = $contactInformation->id;

            $property = new Property();
            $property->user_id  =  Auth::user()->id;
            $property->purpose_type  = $request->selected_tab;
            $property->location_and_purpose_id = $location_and_purpose_id;
            $property->price_and_area_id = $price_and_area_id;
            $property->feature_and_amenity_id = $feature_and_amenity_id;
            $property->add_information_id = $add_information_id;
            $property->contact_information_id = $contact_information_id;
            $property->source_url = $image_paths[0];
            $property->status = "Active";
            $property->save();

            $property_id = $property->id;
            $image_paths = explode(",", $request->image_paths[0]);
            foreach ($image_paths as $path) {
                $source_url =  $path;
                $image = new PropertyImageAndVideo();
                $image->source_type = "images"; // Adjust as needed
                $image->source_url = $source_url;
                $image->property_id = $property_id;
                $image->save();
            }


            $video_paths = explode(",", $request->video_paths[0]);
            foreach ($video_paths as $path) {
                $source_url =  $path;
                $image = new PropertyImageAndVideo();
                $image->source_type = "videos"; // Adjust as needed
                $image->source_url = $source_url;
                $image->property_id = $property_id;
                $image->save();
            }


            // $imageUrls = [];
            // $videoUrls = [];

            // // Loop through each uploaded file
            // foreach ($request->file('images') as $image) {
            //     // Upload the image to Cloudinary
            //     $upload = Cloudinary::upload($image->getRealPath());

            //     // Get the URL of the uploaded image from the Cloudinary response
            //     $imageUrl = $upload->getSecurePath();

            //     // Optionally, you can also get the public ID or other information
            //     $publicId = $upload->getPublicId();
            //     $version = $upload->getVersion();

            //     // Save the URL in an array
            //     $imageUrls[] = $imageUrl;

            //     $image = new PropertyImageAndVideo();
            //     $image->source_type = "images"; // Adjust as needed
            //     $image->source_url = $imageUrl;
            //     $image->property_id = $property_id;

            //     $image->save();
            //     // Save images to the database
            //     //$this->saveImage($request, "images", $imageUrl);
            // }

            // Loop through each uploaded file
            // foreach ($request->file('videos') as $video) {
            //     // Upload the image to Cloudinary
            //     $upload = Cloudinary::uploadVideo($video->getRealPath());

            //     // Get the URL of the uploaded image from the Cloudinary response
            //     $videoUrl = $upload->getSecurePath();

            //     // Optionally, you can also get the public ID or other information
            //     $publicId = $upload->getPublicId();
            //     $version = $upload->getVersion();

            //     // Save the URL in an array
            //     $videoUrls[] = $videoUrl;

            //     $video = new PropertyImageAndVideo();
            //     $video->source_type = "videos"; // Adjust as needed
            //     $video->source_url = $videoUrl;
            //     $video->property_id = $property_id;
            //     $video->save();
            //     // Save images to the database
            //     //$this->saveImage($request, "images", $imageUrl);
            // }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
        set_time_limit(0);

        return redirect()->back()->with('message', ' Property added successfully.');
    }

    public function myListingProperties()
    {
        $myListingProperties = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->where('user_id', Auth::user()->id)->get();
        // dd($myListingProperties);
        return view('dashboards.users.properties.myListingProperties', compact('myListingProperties'));
    }

    public function detailMyListingProperties($id)
    {
        $detailMyListingProperties = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->find($id);
        //return view('dashboards.admins.properties.propertyDetail', compact('propertyDetails'));
        // dd($myListingProperties);
        return view('dashboards.users.properties.detailMyListingProperties', compact('detailMyListingProperties'));
    }

    public function userSavedPropertiesList()
    {
        $locationAndPurposes = LocationAndPurpose::get();
        $countries = Country::with('states')->get();
        $propertyTypes = PropertyType::where('status', 'Active')->get();
        $userId = auth()->id();
        $savedProperties = Property::whereHas('favourites', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with([
                'locationAndPurpose',
                'priceAndArea',
                'featureAndAmenity',
                'addInformation',
                'contactInformation',
                'propertyImageAndVideos',
                'user',
                'favourites'
            ])
            ->get();

        return view('dashboards.users.properties.userSavedPropertiesList', compact('savedProperties', 'locationAndPurposes', 'countries', 'propertyTypes'));
    }

    public function userSavedPropertyDetail($id)
    {
        $userId = auth()->id();
        $savedProperty = Property::where('id', $id)->whereHas('favourites', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with([
                'locationAndPurpose',
                'priceAndArea',
                'featureAndAmenity',
                'addInformation',
                'contactInformation',
                'propertyImageAndVideos',
                'user',
                'favourites'
            ])
            ->first();
        $property = Property::findOrFail($id);
        $property->increment('views');
        // dd($savedProperty);
        return view('dashboards.users.properties.userSavedPropertyDetail', compact('savedProperty'));
    }


    public function filterAllProperties(Request $request)
    {

        $query = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ]);

        $purpose_type = $request->input('purpose_type');
        $property_type = $request->input('property_type');
        $area_and_size = $request->input('area_and_size');
        $country = $request->input('country');
        $state = $request->input('state');
        $price = $request->input('price');
        $beds = $request->input('beds');
        $baths = $request->input('baths');
        $keywords = $request->input('keywords');

        if (!empty($purpose_type)) {
            $query->whereHas('locationAndPurpose', function ($query) use ($purpose_type) {
                $query->where('purpose_type', $purpose_type);
            });
        }

        if (!empty($property_type)) {
            $query->whereHas('locationAndPurpose', function ($query) use ($property_type) {
                $query->where('property_type', $property_type);
            });
        }

        if (!empty($price)) {
            $query->whereHas('priceAndArea', function ($query) use ($price) {
                $query->where('price', $price);
            });
        }
        if (!empty($country)) {
            $query->whereHas('locationAndPurpose', function ($query) use ($country) {
                $query->where('country', $country);
            });
        }
        if (!empty($state)) {
            $query->whereHas('locationAndPurpose', function ($query) use ($state) {
                $query->where('states', $state);
            });
        }

        if (!empty($area_and_size)) {
            $query->whereHas('priceAndArea', function ($query) use ($area_and_size) {
                $query->where('area_and_size', $area_and_size);
            });
        }
        if (!empty($beds)) {
            $query->whereHas('featureAndAmenity', function ($query) use ($beds) {
                $query->where('bed_rooms', $beds);
            });
        }
        if (!empty($baths)) {
            $query->whereHas('featureAndAmenity', function ($query) use ($baths) {
                $query->where('bath_rooms', $baths);
            });
        }
        if (!empty($keywords)) {
            $query->whereHas('addInformation', function ($query) use ($keywords) {
                $query->where('title', 'LIKE', '%' . $keywords . '%');
            });
        }

        $result = $query->get();
        // dd($result);
        return response()->json(['data' => $result]);
    }

    public function filterSavedProperties(Request $request)
    {


        $userId = Auth::user()->id;

        $query = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->whereHas('favourites', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });

        $purpose_type = $request->input('purpose_type');
        $property_type = $request->input('property_type');
        $area_and_size = $request->input('area_and_size');
        $country = $request->input('country');
        $state = $request->input('state');
        $price = $request->input('price');
        $beds = $request->input('beds');
        $baths = $request->input('baths');
        $keywords = $request->input('keywords');

        if (!empty($purpose_type)) {
            $query->whereHas('locationAndPurpose', function ($query) use ($purpose_type) {
                $query->where('purpose_type', $purpose_type);
            });
        }

        if (!empty($property_type)) {
            $query->whereHas('locationAndPurpose', function ($query) use ($property_type) {
                $query->where('property_type', $property_type);
            });
        }

        if (!empty($price)) {
            $query->whereHas('priceAndArea', function ($query) use ($price) {
                $query->where('price', $price);
            });
        }
        if (!empty($country)) {
            $query->whereHas('locationAndPurpose', function ($query) use ($country) {
                $query->where('country', $country);
            });
        }
        if (!empty($state)) {
            $query->whereHas('locationAndPurpose', function ($query) use ($state) {
                $query->where('states', $state);
            });
        }

        if (!empty($area_and_size)) {
            $query->whereHas('priceAndArea', function ($query) use ($area_and_size) {
                $query->where('area_and_size', $area_and_size);
            });
        }
        if (!empty($beds)) {
            $query->whereHas('featureAndAmenity', function ($query) use ($beds) {
                $query->where('bed_rooms', $beds);
            });
        }
        if (!empty($baths)) {
            $query->whereHas('featureAndAmenity', function ($query) use ($baths) {
                $query->where('bath_rooms', $baths);
            });
        }
        if (!empty($keywords)) {
            $query->whereHas('addInformation', function ($query) use ($keywords) {
                $query->where('title', 'LIKE', '%' . $keywords . '%');
            });
        }

        $result = $query->get();
        // dd($result);
        return response()->json(['data' => $result]);
    }
}
