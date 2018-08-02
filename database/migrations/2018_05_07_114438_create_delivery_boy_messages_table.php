<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryBoyMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_boy_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->integer('delivery_boy_id')->unsigned();
            $table->boolean('read')->default(false);
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
        Schema::dropIfExists('delivery_boy_messages');
    }
}
