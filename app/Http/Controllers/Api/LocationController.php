<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Location as LocationResource;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();

        $geoJSON = $locations->map(function($location) {
            return [
                'type' => 'Feature',
                'properties' => new LocationResource($location),
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $location->longitude,
                        $location->latitude,
                    ],
                ],
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $geoJSON,
        ]);
    }
}
