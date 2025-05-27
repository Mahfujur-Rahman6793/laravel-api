<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Thana;
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
        $cities = collect($data)->map(function ($city) {
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
        foreach ($data as $city) {
            if ($city['id'] == $city_id) {
                return response()->json($city['districts']);
            }
        }

        return response()->json([]);
    }
    public function getThanas($district_id)
    {
        $data = json_decode(File::get(public_path('location-data.json')), true);
        foreach ($data as $city) {
            foreach ($city['districts'] as $district) {
                if ($district['id'] == $district_id) {
                    return response()->json($district['thanas']);
                }
            }
        }
    }

    public function storeCities(Request $request)
    {
        $request->validate([
            'mul_city' => 'required|array',
            'mul_city.*.name' => 'required|string|max:255',
        ]);
        $cities = $request->all();
        foreach ($cities['mul_city'] as $city) {
            City::create([
                'name' => $city['name']
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Cities added successfully!'
        ], 201);
    }
    public function storeDistricts(Request $request)
    {
        $districts = $request->all();
        foreach ($districts['mul_district'] as $district) {
           District::create([
                'name' => $district['name'],
                'city_id' => $district['city_id']
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Districts added successfully!'
        ], 201);
    }
    public function storeThanas(Request $request)
    {
        $thanas = $request->all();
        foreach ($thanas['mul_thana'] as $thana) {
            Thana::create([
                'name' => $thana['name'],
                'district_id' => $thana['district_id']
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Thanas added successfully!'
        ], 201);
    }
}
