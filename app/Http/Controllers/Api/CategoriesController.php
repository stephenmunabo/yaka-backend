<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
    	$restaurant_id = $request->input('restaurant_id');
    	if ($restaurant_id != null) {
        	$categories = Category::where('restaurant_id', $restaurant_id)->
        		defaultOrder()->get();
    	}
    	else {
    		$categories = Category::defaultOrder()->get();
    	}
        return response()->json($categories);
    }
}
