<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Customer;
use Illuminate\Http\Request;

class CustomersController extends BaseController
{
    protected $base = 'customers';
    protected $cls = 'App\Customer';

    protected function getIndexItems($data)
    {
        if ($data != null) {
            $customers = Customer::policyScope()->
                orderBy($this->orderBy, $this->orderByDir);
            if (is_array($data) && isset($data['q'])) {
                $customers = $customers->where(function ($query) use ($data) {
                    $q = '%' . $data['q'] . '%';
                    return $query->where('email', 'LIKE', $q)->
                        orWhere('name', 'LIKE', $q)->
                        orWhere('phone', 'LIKE', $q);
                });
            }
            if (is_array($data) && isset($data['city'])) {
                $customers = $customers->whereIn('city_id', $data['city']);
            }
            return $customers->paginate(20);
        }
        else {
            return Customer::policyScope()->orderBy($this->orderBy, $this->orderByDir)->
                paginate(20);
        }
    }

    protected function getAdditionalData($data = null)
    {
        return [
        ];
    }

    public function getValidator(Request $request)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required'
        ];
        if (!Settings::getSettings()->multiple_cities) {
            $rules['city_id'] = 'required';
        }
        return Validator::make($request->all(), $rules);
    }
}
