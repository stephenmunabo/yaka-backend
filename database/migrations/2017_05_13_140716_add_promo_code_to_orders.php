<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPromoCodeToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function(Blueprint $table)
        {
            $table->string('promo_code')->nullable(true)->default(null);
            $table->string('promo_discount')->nullable(false)->default('');
            $table->integer('promo_code_id')->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table)
        {
            $table->dropColumn('promo_code');
            $table->dropColumn('promo_discount');
            $table->dropColumn('promo_code_id');
        });
    }
}
