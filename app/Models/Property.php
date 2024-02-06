<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [ 'views', 'last_viewed_at'];

    protected $dates = ['last_viewed_at'];
    public function locationAndPurpose()
    {
        return $this->belongsTo(LocationAndPurpose::class);
    }

    public function priceAndArea()
    {
        return $this->belongsTo(PriceAndArea::class);
    }

    public function featureAndAmenity()
    {
        return $this->belongsTo(FeatureAndAmenity::class);
    }

    public function addInformation()
    {
        return $this->belongsTo(AddInformation::class);
    }
    public function contactInformation()
    {
        return $this->belongsTo(ContactInformation::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function propertyImageAndVideos() // Correct method name to match the relationship
    {
        return $this->hasMany(PropertyImageAndVideo::class);
    }
    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }
}
