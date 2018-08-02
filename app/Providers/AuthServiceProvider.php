<?php

namespace App\Providers;

use App\Category;
use App\User;
use App\Product;
use App\Order;
use App\OrderedProduct;
use App\Customer;
use App\PushMessage;
use App\DeliveryArea;
use App\PromoCode;
use App\TaxGroup;
use App\City;
use App\Restaurant;
use App\Settings;
use App\NewsItem;
use App\DeliveryBoy;
use App\DeliveryBoyMessage;
use App\OrderStatus;
use App\Policies\CategoryPolicy;
use App\Policies\UserPolicy;
use App\Policies\ProductPolicy;
use App\Policies\OrderPolicy;
use App\Policies\OrderedProductPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\PushMessagePolicy;
use App\Policies\DeliveryAreaPolicy;
use App\Policies\PromoCodePolicy;
use App\Policies\TaxGroupPolicy;
use App\Policies\CityPolicy;
use App\Policies\RestaurantPolicy;
use App\Policies\SettingsPolicy;
use App\Policies\NewsItemPolicy;
use App\Policies\DeliveryBoyPolicy;
use App\Policies\DeliveryBoyMessagePolicy;
use App\Policies\OrderStatusPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class,
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        Customer::class => CustomerPolicy::class,
        PushMessage::class => PushMessagePolicy::class,
        DeliveryArea::class => DeliveryAreaPolicy::class,
        PromoCode::class => PromoCodePolicy::class,
        TaxGroup::class => TaxGroupPolicy::class,
        City::class => CityPolicy::class,
        Restaurant::class => RestaurantPolicy::class,
        Settings::class => SettingsPolicy::class,
        NewsItem::class => NewsItemPolicy::class,
        OrderedProduct::class => OrderedProductPolicy::class,
        DeliveryBoy::class => DeliveryBoyPolicy::class,
        DeliveryBoyMessage::class => DeliveryBoyMessagePolicy::class,
        OrderStatus::class => OrderStatusPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
