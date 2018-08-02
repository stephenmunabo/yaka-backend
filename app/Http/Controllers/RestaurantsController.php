<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Settings;
use Validator;
use Illuminate\Http\Request;

class RestaurantsController extends BaseController
{
    protected $base = 'restaurants';
    protected $cls = 'App\Restaurant';
    protected $orderBy = 'sort';
    protected $orderByDir = 'ASC';
    protected $images = ['image'];

    public function getValidator(Request $request)
    {
        if (!Settings::getSettings()->multiple_cities) {
            return Validator::make($request->all(), [
            	'name' => 'required',
            	'sort' => 'required'
            ]);
        }
        else {
            return Validator::make($request->all(), [
                'name' => 'required',
                'city_id' => 'required',
                'sort' => 'required'
            ]);
        }
    }

    protected function getIndexItems($data)
    {
        if ($data != null) {
            $restaurants = Restaurant::policyScope();
            if (is_array($data) && isset($data['q'])) {
            	$restaurants = $restaurants->where('name', 'LIKE', '%' . $data['q'] . '%');
            }
            if (is_array($data) && isset($data['city_id'])) {
                $restaurants = $restaurants->where('city_id', $data['city_id']);
            }
            return $restaurants->paginate(20);
        }
        else {
            return Restaurant::policyScope()->paginate(20);
        }
    }
}
