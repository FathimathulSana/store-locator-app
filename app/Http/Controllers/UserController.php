<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome'); // Load the view for public users
    }

    public function getNearbyStores(Request $request)
    {
        $latitude = $request->query('latitude');
        $longitude = $request->query('longitude');


        if (!$latitude || !$longitude) {
            return response()->json(['error' => 'Latitude and Longitude are required'], 400);
        }

        $stores = DB::table('stores')
            ->select(
                'name',
                'address',
                'latitude',
                'longitude',
                DB::raw("6371 * acos(cos(radians($latitude)) 
                * cos(radians(latitude)) 
                * cos(radians(longitude) - radians($longitude)) 
                + sin(radians($latitude)) 
                * sin(radians(latitude))) AS distance")
            )
            ->orderBy('distance')
            ->get();

        return response()->json($stores);
    }
}
