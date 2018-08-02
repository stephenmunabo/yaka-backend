<?php

namespace App\Http\Controllers\Api;

use App\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    public function index(Request $request)
    {
    	$city_id = $request->input('city_id');
    	if ($city_id != null) {
        	$restaurants = Restaurant::where('city_id', $request->input('city_id'))->orderBy('sort', 'ASC')->get();
    	}
    	else {
    		$restaurants = Restaurant::orderBy('sort', 'ASC')->get();
    	}
        return response()->json($restaurants);
    }
}
