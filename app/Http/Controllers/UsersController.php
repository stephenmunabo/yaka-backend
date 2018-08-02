<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\User;
use Validator;
use Illuminate\Http\Request;

class UsersController extends BaseController
{
    protected $base = 'users';
    protected $cls = 'App\User';
    protected $manyToMany = [
        'cities' => 'cities_ids'
    ];
    protected $checkboxes = [
        'access_full', 'access_news', 'access_categories', 'access_products',
        'access_orders', 'access_customers', 'access_pushes', 'access_delivery_areas',
        'access_promo_codes', 'access_tax_groups', 'access_cities', 'access_restaurants',
        'access_settings', 'access_users', 'access_delivery_boys', 'access_order_statuses'
    ];

    protected function getIndexItems($data)
    {
        if ($data != null) {
            $users = User::orderBy($this->orderBy, $this->orderByDir);
            if (is_array($data) && isset($data['q'])) {
                $users = $users->where(function ($query) use ($data) {
                    $q = '%' . $data['q'] . '%';
                    return $query->where('email', 'LIKE', $q)->
                        orWhere('name', 'LIKE', $q);
                });
            }
            if (is_array($data) && isset($data['city_id'])) {
                $users = $users->whereHas('cities', function ($query) use ($data) {
                    return $query->where('id', $data['city_id']);
                })->orWhere('access_full', true);
            }
            return $users->paginate(20);
        }
        else {
            return call_user_func([$this->cls, 'orderBy'], $this->orderBy, $this->orderByDir)->paginate(20);
        }
    }

    protected function modifyRequestData($data)
    {
        if (isset($data['password'])) {
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
            else {
                unset($data['password']);
            }
            unset($data['password_confirmation']);
        }
        if ($data['password'] == null) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }
        return $data;
    }

    public function getValidator(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required'
        ];
        $data = $request->all();
        if (isset($data['password']) && !empty($data['password'])) {
            $rules['password'] = 'required|confirmed';
        }
        return Validator::make($request->all(), $rules);
    }
}
