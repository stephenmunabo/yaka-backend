<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotificationEmailToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function(Blueprint $table)
        {
            $table->string('notification_email')->default('');
            $table->string('notification_phone')->default('');
            $table->string('mail_from_mail')->default('');
            $table->string('mail_from_name')->default('');
            $table->string('mail_from_new_order_subject')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function(Blueprint $table)
        {
            $table->dropColumn('notification_email');
            $table->dropColumn('notification_phone');
            $table->dropColumn('mail_from_mail');
            $table->dropColumn('mail_from_name');
            $table->dropColumn('mail_from_new_order_subject');
        });
    }
}
