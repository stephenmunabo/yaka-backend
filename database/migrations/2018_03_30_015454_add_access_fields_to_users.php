<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccessFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->boolean('access_full')->default(true);
            $table->boolean('access_news')->default(true);
            $table->boolean('access_categories')->default(true);
            $table->boolean('access_products')->default(true);
            $table->boolean('access_orders')->default(true);
            $table->boolean('access_customers')->default(true);
            $table->boolean('access_pushes')->default(true);
            $table->boolean('access_delivery_areas')->default(true);
            $table->boolean('access_promo_codes')->default(true);
            $table->boolean('access_tax_groups')->default(true);
            $table->boolean('access_cities')->default(true);
            $table->boolean('access_restaurants')->default(true);
            $table->boolean('access_settings')->default(true);
            $table->boolean('access_users')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn(['access_full', 'access_news', 'access_categories', 'access_products',
                'access_orders', 'access_customers', 'access_pushes', 'access_delivery_areas',
                'access_promo_codes', 'access_tax_groups', 'access_cities', 'access_restaurants',
                'access_settings', 'access_users']);
        });
    }
}
