<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Thana;
use Illuminate\Http\Request;

class WebLocationController extends Controller
{
    public function cities()
    {
        return view('Web.Location.city_details');
    }
    public function getCities(Request $request)
    {
        $cities = City::all();
        return response()->json($cities);
    }
    public function getDistricts($city_id){
        $districts = District::where('city_id',$city_id)->get();
        return response()->json($districts);
    }
    public function getThanas($district_id){
        $thanas = Thana::where('district_id', $district_id)->get();
        return response()->json($thanas);
    }
}
