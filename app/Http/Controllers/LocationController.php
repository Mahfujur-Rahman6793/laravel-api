<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LocationController extends Controller
{
    public function cities()
    {
        return view('Location.city_details');
    }
    public function getCities()
    {
        $data = json_decode((File::get(public_path('location-data.json'))), true);
        $cities = collect($data)->map(function($city){
            return [
                'id' => $city['id'],
                'name' => $city['name'],
            ];
        });
        return response()->json($cities);
    }
    public function getDistricts($city_id)
    {
        $data = json_decode((File::get(public_path('location-data.json'))), true);
        foreach($data as $city){
            if($city['id'] == $city_id){
                return response()->json($city['districts']);
            }
        }

        return response()->json([]);
    }
    public function getThanas($district_id){
        $data = json_decode(File::get(public_path('location-data.json')), true);
        foreach($data as $city){
            foreach($city['districts'] as $district){
                if($district['id'] == $district_id){
                    return response()->json($district['thanas']);
                }
            }
        }
    }
}
