<?php

namespace App;

use Auth;
use App\City;
use App\Settings;
use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    protected $fillable = ['name', 'coords', 'price', 'city_id'];

    public function orders()
    {
        return $this->hasMany('App\Orders');
    }

    public function city()
    {
    	return $this->belongsTo(City::class);
    }

    /**
     * Relation of models accessible by current user
     * @return Relation
     */
    public static function policyScope()
    {
        $user = Auth::user();
        if ($user->access_full || !Settings::getSettings()->multiple_cities) {
            return DeliveryArea::where('id', '>', '0');
        }
        else {
            return DeliveryArea::whereIn('city_id', $user->cities->pluck('id')->all());
        }
    }
}
