<?php

namespace App;

use Auth;
use App\Settings;
use App\Category;
use App\City;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
	protected $fillable = ['name', 'city_id', 'sort'];

	protected $appends = ['image_url'];

    public function city()
    {
    	return $this->belongsTo(City::class);
    }

    public function categories()
    {
    	return $this->hasMany(Category::class);
    }

    public function getImageUrlAttribute()
    {
      return url($this->image);
    }

    /**
     * Relation of models accessible by current user
     * @return Relation
     */
    public static function policyScope()
    {
        if (Settings::getSettings()->multiple_cities && !Auth::user()->access_full) {
            return Restaurant::whereIn('city_id', City::policyScope()->pluck('id')->all())->
                orderBy('sort', 'ASC');
        }
        else {
            return Restaurant::orderBy('sort', 'ASC');
        }
    }
}
