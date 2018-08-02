<?php

namespace App\Policies;

use App\User;
use App\Category;
use App\Settings;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    protected function canAccessCityId(User $user, Category $category)
    {
        $allow_cities = true;
        if (Settings::getSettings()->multiple_cities) {
            $allow_cities = in_array($category->city_id, $user->cities->pluck('id')->all());
        }
        return $user->access_full || ($user->access_categories && $allow_cities);
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function view(User $user, Category $category)
    {
        
        return $this->canAccessCityId($user, $category);
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->access_full || $user->access_categories;
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        return $this->canAccessCityId($user, $category);
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        return $this->canAccessCityId($user, $category);
    }
}
