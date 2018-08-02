<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;
use App\TaxGroup;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'description', 'price', 'price_old', 'tax_group_id'];

    protected $appends = ['images', 'formatted_price', 'formatted_old_price', 'tax_value', 'city_id', 'restaurant_id'];

    public function taxGroup()
    {
        return $this->belongsTo('App\TaxGroup');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function productImages()
    {
        return $this->hasMany('App\ProductImage');
    }

    public function orderedProducts()
    {
        return $this->hasMany('App\OrderedProducts');
    }

    /**
     * Return images array with full URLs
     * @return Array
     */
    public function getImagesAttribute()
    {
        $images = $this->productImages->pluck('image');
        foreach ($images as $key => $value) {
            $images[$key] = url($value);
        }
        return $images;
    }

    public function getFormattedPriceAttribute()
    {
        return \App\Settings::currency($this->price);
    }

    public function getFormattedOldPriceAttribute()
    {
        return \App\Settings::currency($this->price_old);
    }

    public function getTaxValueAttribute()
    {
        $result = $this->taxGroup;
        if ($result == null) {
            $result = TaxGroup::getDefaultTaxObject();
        }
        return $result->value;
    }

    public function getCityIdAttribute()
    {
        $result = null;
        if ($this->category != null) {
            $result = $this->category->city_id;
        }
        return $result;
    }

    public function getRestaurantIdAttribute()
    {
        $result = null;
        if ($this->category != null) {
            $result = $this->category->restaurant_id;
        }
        return $result;
    }

    /**
     * Relation of models accessible by current user
     * @return Relation
     */
    public static function policyScope()
    {
        return Product::whereIn('category_id', Category::policyScope()->pluck('id')->all());
    }
}
