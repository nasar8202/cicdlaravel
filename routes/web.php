<?php

//use App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManagePropertyController;
use App\Http\Controllers\User\UserPropertyManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});
Route::get('redirect/{driver}', [LoginController::class, 'redirectToProvider']);
Route::get('{driver}/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});
Route::get('save-property-detail/{id}', [UserPropertyManagementController::class, 'userSavedPropertyDetail'])
    ->name('userSavedPropertyDetail');
// csssssssss
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
Route::get('/user/filter-all-properties', [UserPropertyManagementController::class, 'filterAllProperties'])->name('user.filterAllProperties');

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'PreventBackHistory']], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');

    Route::get('get-states/{id}', [AdminController::class, 'getStates'])->name('admin.getStates');
    //Start Manage Property By Admin Side .........

    Route::get('user-management/{user_id}', [AdminController::class, 'userManagement'])->name('admin.userManagement');

    // start property type 
    Route::get('add-property-form', [ManagePropertyController::class, 'addPropertyForm'])->name('admin.addPropertyForm');
    Route::post('add-property-type', [ManagePropertyController::class, 'addPropertyType'])->name('admin.addPropertyType');
    Route::get('list-property-types', [ManagePropertyController::class, 'listPropertyTypes'])->name('admin.listPropertyTypes');
    Route::get('edit-property-type-form/{id}', [ManagePropertyController::class, 'editPropertyTypeForm'])->name('admin.editPropertyTypeForm');
    Route::post('edit-property-type/{id}', [ManagePropertyController::class, 'editPropertyType'])->name('admin.editPropertyType');
    Route::get('delete-property-type/{id}', [ManagePropertyController::class, 'deletePropertyType'])->name('admin.deletePropertyType');
    // end property type 

    // start sub property type 
    Route::get('add-sub-property-form', [ManagePropertyController::class, 'addSubPropertyForm'])->name('admin.addSubPropertyForm');
    Route::post('add-sub-property-type', [ManagePropertyController::class, 'addSubPropertyType'])->name('admin.addSubPropertyType');
    Route::get('list-sub-property-types', [ManagePropertyController::class, 'listSubPropertyTypes'])->name('admin.listSubPropertyTypes');
    Route::get('edit-sub-property-type-form/{id}', [ManagePropertyController::class, 'editSubPropertyTypeForm'])->name('admin.editSubPropertyTypeForm');
    Route::post('edit-sub-property-type/{id}', [ManagePropertyController::class, 'editSubPropertyType'])->name('admin.editSubPropertyType');
    Route::get('delete-sub-property-type/{id}', [ManagePropertyController::class, 'deleteSubPropertyType'])->name('admin.deleteSubPropertyType');


    //end pipeline use cccc
    // end sub property type 

    // start add property
    Route::get('add-property', [ManagePropertyController::class, 'addPropertyDetailsForm'])->name('admin.addPropertyDetailsForm');
    Route::post('add-property-post', [ManagePropertyController::class, 'addPropertyPost'])->name('admin.addPropertyPost');
    Route::get('get-states-for-property/{id}', [ManagePropertyController::class, 'getStatesForProperty'])->name('admin.getStatesForProperty');


    Route::post('uploadImage', [ManagePropertyController::class, 'uploadImage'])->name('admin.uploadImage');
    Route::post('uploadVideo', [ManagePropertyController::class, 'uploadVideo'])->name('admin.uploadVideo');
    // end property

    //start management property
    Route::get('property-management', [ManagePropertyController::class, 'propertyManagement'])->name('admin.propertyManagement');
    Route::get('property-detail/{id}', [ManagePropertyController::class, 'propertyDetails'])->name('admin.propertyDetails');

    Route::get('my-listings', [ManagePropertyController::class, 'myListingProperties'])->name('admin.myListingProperties');
    Route::get('my-listing-property-detail/{id}', [ManagePropertyController::class, 'detailMyListingProperties'])->name('admin.detailMyListingProperties');

    //end
    // end add property

    // start saved properties list
    Route::get('save-properties', [ManagePropertyController::class, 'adminSavedPropertiesList'])->name('admin.adminSavedPropertiesList');
    Route::get('save-property-detail/{id}', [ManagePropertyController::class, 'adminSavedPropertyDetail'])->name('admin.adminSavedPropertyDetail');

    Route::get('filter-saved-properties', [ManagePropertyController::class, 'filterSavedProperties'])->name('admin.filterSavedProperties');


    // end saved properties list
    Route::get('users', [AdminController::class, 'registeredUsers'])->name('admin.registeredUsers');
    Route::get('/user-growth-data', [AdminController::class, 'getUserGrowthData'])->name('admin.getUserGrowthData');
    Route::get('/number-of-listings-data', [AdminController::class, 'getNumberOfListingsData']);
    // users list

    //end user list
    //End Manage Property By Admin Side .........



    Route::post('update-profile-info', [AdminController::class, 'updateInfo'])->name('adminUpdateInfo');
    Route::post('change-profile-picture', [AdminController::class, 'updatePicture'])->name('adminPictureUpdate');
    Route::post('change-password', [AdminController::class, 'changePassword'])->name('adminChangePassword');
    Route::get('change-password', [AdminController::class, 'getChangePassword'])->name('adminGetChangePassword');
});
Route::get('get-states/{id}', [UserController::class, 'getStates'])->name('admin.getStates');
Route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth', 'PreventBackHistory']], function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('settings', [UserController::class, 'settings'])->name('user.settings');

    // property management
    Route::get('add-property', [UserPropertyManagementController::class, 'addPropertyDetailsForm'])->name('user.addPropertyDetailsForm');
    Route::post('add-property-post', [UserPropertyManagementController::class, 'addPropertyPost'])->name('user.addPropertyPost');
    Route::get('get-states-for-property/{id}', [UserPropertyManagementController::class, 'getStatesForProperty'])->name('user.getStatesForProperty');

    Route::post('uploadImage', [UserPropertyManagementController::class, 'uploadImage'])->name('user.uploadImage');
    Route::post('uploadVideo', [UserPropertyManagementController::class, 'uploadVideo'])->name('user.uploadVideo');

    Route::get('my-listings', [UserPropertyManagementController::class, 'myListingProperties'])->name('user.myListingProperties');
    Route::get('my-listing-property-detail/{id}', [UserPropertyManagementController::class, 'detailMyListingProperties'])->name('user.detailMyListingProperties');

    Route::get('save-properties', [UserPropertyManagementController::class, 'userSavedPropertiesList'])->name('user.userSavedPropertiesList');
    Route::get('save-property-detail/{id}', [UserPropertyManagementController::class, 'userSavedPropertyDetail'])->name('user.userSavedPropertyDetail');
    Route::get('filter-saved-properties', [UserPropertyManagementController::class, 'filterSavedProperties'])->name('user.filterSavedProperties');



    // end property management

    Route::get('get-states/{id}', [UserController::class, 'getStates'])->name('admin.getStates');
    Route::post('update-profile-info', [UserController::class, 'updateInfo'])->name('userUpdateInfo');
    Route::post('change-profile-picture', [UserController::class, 'updatePicture'])->name('userPictureUpdate');

    Route::post('change-password', [UserController::class, 'changePassword'])->name('adminChangePassword');
    Route::get('change-password', [UserController::class, 'getChangePassword'])->name('userGetChangePassword');

    // favourite property
    Route::post('like', [UserController::class, 'like'])->name('like');
    Route::post('/unlike',  [UserController::class, 'unlike'])->name('unlike');

    Route::get('/user/filter-all-properties', [UserPropertyManagementController::class, 'filterAllProperties'])->name('user.filterAllProperties');

    // end favourite property
});
