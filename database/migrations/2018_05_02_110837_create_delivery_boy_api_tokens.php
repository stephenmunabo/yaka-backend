<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryBoyApiTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_boy_api_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->default('');
            $table->integer('delivery_boy_id')->unsigned();
            $table->string('platform')->default('');
            $table->string('push_token')->default('');
            $table->timestamps();

            $table->foreign('delivery_boy_id')->references('id')->on('delivery_boys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_boy_api_tokens');
    }
}
