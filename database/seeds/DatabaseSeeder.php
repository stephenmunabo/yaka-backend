<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
        	'email' => 'admin@example.com',
        	'password' => bcrypt('password'),
        	'name' => 'admin'
        ]);
        \App\Settings::create([
        	'delivery_price' => 0,
        	'currency_format' => '$:value',
        	'pushwoosh_id' => '',
        	'pushwoosh_token' => '',
            'gcm_project_id' => '',
            'date_format' => 'd/m/Y H:i'
        ]);
    }	
}
