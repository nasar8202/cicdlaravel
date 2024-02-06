<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\Property;
use App\Models\PriceAndArea;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\AddInformation;
use App\Models\PropertySubType;
use App\Models\FeatureAndAmenity;
use App\Models\ContactInformation;
use App\Models\LocationAndPurpose;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyImageAndVideo;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManagePropertyController extends Controller
{
    public function addPropertyForm()
    {
        return view('dashboards.admins.manageProperties.propertyType.addPropertyForm');
    }

    public function addPropertyType(Request $request)
    {
        try {
            DB::beginTransaction();

            $addProperty = new PropertyType();
            $addProperty->title = $request->title;
            $addProperty->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add property. Please try again.'); // Redirect with an error message.
        }

        return redirect()->back()->with('message', 'Property added successfully.');
    }

    public function listPropertyTypes()
    {

        $listPropertyTypes = PropertyType::where('status', 'active')->get();
        return view('dashboards.admins.manageProperties.propertyType.listPropertyTypes', compact('listPropertyTypes'));
    }

    public function editPropertyTypeForm($id)
    {
        try {

            $editPropertyTypeForm =  PropertyType::where('id', $id)->first();
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Failed to add property. Please try again.'); // Redirect with an error message.
        }
        return view('dashboards.admins.manageProperties.propertyType.editPropertyTypeForm', compact('editPropertyTypeForm'));
    }

    public function editPropertyType(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $editProperty =  PropertyType::where('id', $id)->first();
            $editProperty->title = $request->title;
            $editProperty->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update property. Please try again.'); // Redirect with an error message.
        }

        return redirect()->route('admin.listPropertyTypes')->with('message', 'Property updated successfully.');
    }

    public function deletePropertyType($id)
    {
        try {

            $PropertyType =  PropertyType::where('id', $id)->delete();
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Failed to delete property. Please try again.'); // Redirect with an error message.
        }
        return redirect()->route('admin.listPropertyTypes')->with('error', 'Property deleted successfully.');
    }

    public function addSubPropertyForm()
    {
        $listPropertyTypes = PropertyType::where('status', 'active')->get();
        return view('dashboards.admins.manageProperties.propertySubType.addSubPropertyForm', compact('listPropertyTypes'));
    }
    public function addSubPropertyType(Request $request)
    {
        try {
            DB::beginTransaction();

            $addSubProperty = new PropertySubType();
            $addSubProperty->property_type_id = $request->PropertyTypeId;
            $addSubProperty->title = $request->title;
            $addSubProperty->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add sub property. Please try again.'); // Redirect with an error message.
        }

        return redirect()->back()->with('message', 'Sub Property added successfully.');
    }

    public function listSubPropertyTypes()
    {

        $listSubPropertyTypes = PropertySubType::with('propertyType')->get();

        return view('dashboards.admins.manageProperties.propertySubType.listSubPropertyTypes', compact('listSubPropertyTypes'));
    }

    public function editSubPropertyTypeForm($id)
    {
        try {
            $editSubPropertyTypeForm = PropertySubType::findOrFail($id);
            $listPropertyTypes = PropertyType::all(); // Retrieve all PropertyTypes for the dropdown

            return view('dashboards.admins.manageProperties.propertySubType.editSubPropertyTypeForm', compact('editSubPropertyTypeForm', 'listPropertyTypes'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to fetch data. Please try again.');
        }
    }

    public function editSubPropertyType(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            //  dd($request->all(),$id);
            $editSubProperty =  PropertySubType::where('id', $id)->first();
            $editSubProperty->title = $request->title;
            $editSubProperty->property_type_id = $request->PropertyTypeId;
            $editSubProperty->save();


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update sub property. Please try again.'); // Redirect with an error message.
        }

        return redirect()->route('admin.listSubPropertyTypes')->with('message', 'Sub Property updated successfully.');
    }

    public function deleteSubPropertyType($id)
    {
        try {

            $PropertySubType =  PropertySubType::where('id', $id)->delete();
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Failed to delete property. Please try again.'); // Redirect with an error message.
        }
        return redirect()->route('admin.listSubPropertyTypes')->with('error', 'Property deleted successfully.');
    }

    public function addPropertyDetailsForm()
    {
        $PropertyTypes = PropertyType::where('status', 'active')->get();
        $countries = Country::where('status', 'Active')->get();
        return view('dashboards.admins.properties.addPropertyDetailsForm', compact('PropertyTypes', 'countries'));
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

    public function adminSavedPropertiesList()
    {
        $locationAndPurposes = LocationAndPurpose::get();
        $countries = Country::with('states')->get();
        $propertyTypes = PropertyType::where('status', 'Active')->get();

        return view('dashboards.admins.properties.adminSavedPropertiesList', compact('locationAndPurposes', 'countries', 'propertyTypes'));
    }
    public function filterSavedProperties(Request $request)
    {
        $purpose_type = $request->input('purpose_type');
        $property_type = $request->input('property_type');
        $area_and_size = $request->input('area_and_size');
        $country = $request->input('country');
        $state = $request->input('state');
        $price = $request->input('price');
        $beds = $request->input('beds');
        $baths = $request->input('baths');
        $keywords = $request->input('keywords');
        $user_id = Auth::user()->id;
        $query_string_second_part = [];

        if (!empty($purpose_type)) $query_string_second_part[] = " AND location_and_purposes.purpose_type = '$purpose_type'";
        if (!empty($property_type)) $query_string_second_part[] = " AND location_and_purposes.property_type = '$property_type'";
        if (!empty($country)) $query_string_second_part[] = " AND countries.id = '$country'";
        if (!empty($state)) $query_string_second_part[] = " AND states.id = '$state'";
        if (!empty($price)) $query_string_second_part[] = " AND price_and_areas.price = '$price'";
        if (!empty($area_and_size)) $query_string_second_part[] = " AND price_and_areas.area_and_size = '$area_and_size'";
        if (!empty($beds)) $query_string_second_part[] = " AND feature_and_amenities.bed_rooms = '$beds'";
        if (!empty($baths)) $query_string_second_part[] = " AND feature_and_amenities.bath_rooms = '$baths'";
        if (!empty($keywords)) $query_string_second_part[] = " AND add_information.title LIKE '%$keywords%'";
        if (!empty($user_id)) $query_string_second_part[] = " AND properties.user_id = '$user_id'";
        // if (!empty($keywords)) $query_string_second_part[] = " AND add_information.description LIKE '%$keywords%'";
        // Add similar conditions for other parameters

        $query_string_first_part = "SELECT 
        properties.*,
        location_and_purposes.*,
        countries.*,
        states.*,
        price_and_areas.*,
        feature_and_amenities.*,
        add_information.*
        FROM properties
        JOIN location_and_purposes ON properties.location_and_purpose_id = location_and_purposes.id
        JOIN countries ON location_and_purposes.country = countries.id
        JOIN states ON location_and_purposes.states = states.id
        JOIN price_and_areas ON properties.price_and_area_id = price_and_areas.id
        JOIN feature_and_amenities ON properties.feature_and_amenity_id = feature_and_amenities.id
        JOIN add_information ON properties.add_information_id = add_information.id
        WHERE";
        $query_string_third_part = ' ORDER BY properties.id';

        $query_string_second_part = implode(" ", $query_string_second_part);
        $query_string_second_part = preg_replace("/AND/", " ", $query_string_second_part, 1);

        $query_string = $query_string_first_part . $query_string_second_part . $query_string_third_part;

        // Now you can execute your query using Laravel's query builder or Eloquent.
        $result = DB::select($query_string);
        // return $result;
        //echo json_encode(['data' => $result]);

        return response()->json(['data' => $result]);
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
        return view('dashboards.admins.properties.myListingProperties', compact('myListingProperties'));
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
        return view('dashboards.admins.properties.detailMyListingProperties', compact('detailMyListingProperties'));
    }
    public function adminSavedPropertyDetail($id)
    {
        return view('dashboards.admins.properties.adminSavedPropertyDetail');
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
    public function propertyManagement()
    {
        $properties = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->get();
        //dd($property->addInformation[]);
        return view('dashboards.admins.properties.propertyManagement', compact('properties'));
    }

    public function propertyDetails($id)
    {
        $propertyDetails = Property::with([
            'locationAndPurpose',
            'priceAndArea',
            'featureAndAmenity',
            'addInformation',
            'contactInformation',
            'propertyImageAndVideos',
            'user'
        ])->find($id);
        return view('dashboards.admins.properties.propertyDetail', compact('propertyDetails'));
    }
}
