<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Restaurant;
use App\Settings;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $fillable = ['name', 'parent_id', 'image', 'restaurant_id', 'city_id'];

    protected $appends = ['has_children', 'image_url'];
    protected $hidden = ['image'];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getHasChildrenAttribute()
    {
      return $this->children()->count();
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
        $user = Auth::user();
        if ($user->access_full || !Settings::getSettings()->multiple_cities) {
            return Category::withDepth()->defaultOrder();
        }
        else {
            return Category::withDepth()->defaultOrder()->whereIn('city_id', $user->cities->pluck('id')->all());
        }
    }
}
