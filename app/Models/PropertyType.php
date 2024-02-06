<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'status'];

    public function propertySubTypes()
    {
        return $this->hasMany(PropertySubType::class);
    }

}
