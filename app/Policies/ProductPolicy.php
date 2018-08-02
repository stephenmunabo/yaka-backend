<?php

namespace App\Policies;

use App\User;
use App\Product;
use App\Settings;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    protected function canAccessCityId(User $user, Product $product)
    {
        $allow_cities = true;
        if (Settings::getSettings()->multiple_cities) {
            $allow_cities = in_array($product->city_id, $user->cities->pluck('id')->all());
        }
        return $user->access_full || ($user->access_products && $allow_cities);
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return $this->canAccessCityId($user, $product);
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->access_full || $user->access_products;
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return $this->canAccessCityId($user, $product);
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return $this->canAccessCityId($user, $product);
    }
}
