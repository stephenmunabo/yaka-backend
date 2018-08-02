<?php

namespace App\Policies;

use App\User;
use App\Restaurant;
use App\Settings;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;

    protected function canAccessCityId(User $user, Restaurant $restaurant)
    {
        $allow_cities = true;
        if (Settings::getSettings()->multiple_cities) {
            $allow_cities = in_array($restaurant->city_id, $user->cities->pluck('id')->all());
        }
        return $user->access_full || ($user->access_restaurants && $allow_cities);
    }

    /**
     * Determine whether the user can view the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function view(User $user, Restaurant $restaurant)
    {
        return $this->canAccessCityId($user, $restaurant);
    }

    /**
     * Determine whether the user can create restaurants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->access_full || $user->access_restaurants;
    }

    /**
     * Determine whether the user can update the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function update(User $user, Restaurant $restaurant)
    {
        return $this->canAccessCityId($user, $restaurant);
    }

    /**
     * Determine whether the user can delete the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function delete(User $user, Restaurant $restaurant)
    {
        return $this->canAccessCityId($user, $restaurant);
    }
}
