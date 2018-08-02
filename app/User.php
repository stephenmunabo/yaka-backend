<?php

namespace App;

use App\City;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'access_full', 'access_news', 'access_categories', 'access_products',
        'access_orders', 'access_customers', 'access_pushes', 'access_delivery_areas',
        'access_promo_codes', 'access_tax_groups', 'access_cities', 'access_restaurants',
        'access_settings', 'access_users', 'access_delivery_boys', 'access_order_statuses'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }
}
