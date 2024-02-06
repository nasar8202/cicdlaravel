<?php

// app/Http/Middleware/UpdateViewedProperties.php

namespace App\Http\Middleware;

use Closure;
use App\Models\Property;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class UpdateViewedProperties
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
dd($request->all());
        $propertyId = $request->route('id');
        $property = Property::find($propertyId);

        if ($property) {
            // Update viewed properties for logged-in users
            if (Auth::check()) {
                Auth::user()->viewedProperties()->syncWithoutDetaching([$property->id => ['last_viewed_at' => now()]]);
            }

            // If not logged in, use cookies to track viewed properties
            $viewedProperties = json_decode($request->cookie('viewed_properties', '[]'));

            if (!in_array($property->id, $viewedProperties)) {
                $viewedProperties[] = $property->id;
                $response->withCookie(cookie('viewed_properties', json_encode($viewedProperties), 1440)); // Set the cookie for 24 hours
            }

            $property->increment('views');
        }

        return $response;
    }
}
