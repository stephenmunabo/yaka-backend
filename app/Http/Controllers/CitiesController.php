<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

class CitiesController extends BaseController
{
    protected $base = 'cities';
    protected $cls = 'App\City';
    protected $orderBy = 'sort';
    protected $orderByDir = 'ASC';

    public function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
        	'name' => 'required',
        	'sort' => 'required'
        ]);
    }
}
