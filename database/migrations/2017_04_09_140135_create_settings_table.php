<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pushwoosh_id')->default('')->nullable(true);
            $table->string('pushwoosh_token')->default('')->nullable(true);
            $table->string('date_format')->default('d/m/Y H:i')->nullable(true);
            $table->string('currency_format')->default('')->nullable(true);
            $table->string('delivery_price')->default('')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
