<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

class TaxGroupsController extends BaseController
{
    protected $base = 'tax_groups';
    protected $cls = 'App\TaxGroup';

    public function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
        	'name' => 'required',
        	'value' => 'required'
        ]);
    }
}
