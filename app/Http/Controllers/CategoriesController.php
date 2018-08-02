<?php

namespace App\Http\Controllers;

use App\Settings;
use Validator;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends BaseController
{
    protected $base = 'categories';
    protected $cls = 'App\Category';
    protected $images = ['image'];

    protected function getAdditionalData($data = null)
    {
        return [
            'categories' => Category::withDepth()->defaultOrder()->get()
        ];
    }

    public function getValidator(Request $request)
    {
        $rules = [
            'name' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|image'
        ];
        if (Settings::getSettings()->multiple_cities) {
            $rules['city_id'] = 'required';
        }
        return Validator::make($request->all(), $rules);
    }

    protected function getIndexItems($data)
    {
        if ($data != null) {
            $categories = Category::policyScope();
            if (is_array($data) && isset($data['city_id'])) {
                $categories = $categories->where('city_id', $data['city_id']);
            }
            if (is_array($data) && isset($data['restaurant_id'])) {
                $categories = $categories->where('restaurant_id', $data['restaurant_id']);
            }
            return $categories->paginate(50);
        }
        else {
            return Category::policyScope()->paginate(50);
        }
    }
}
