<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['pushwoosh_id', 'pushwoosh_token', 'currency_format', 'delivery_price', 'date_format', 'gcm_project_id',
		'notification_email', 'notification_phone', 'mail_from_mail', 'mail_from_name', 'mail_from_new_order_subject', 'stripe_publishable',
        'stripe_private', 'paypal_client_id', 'paypal_client_secret', 'paypal_currency', 'tax_included',
        'multiple_restaurants', 'multiple_cities', 'signup_required', 'paypal_production',
        'time_format_app', 'time_format_backend', 'date_format_app', 'driver_onesignal_id', 'driver_onesignal_token',
        'products_layout', 'categories_layout'
    ];

    protected $hidden = ['stripe_private', 'paypal_client_secret'];

    private static $instance;

    /**
     * Current settings object, with caching
     * @return Settings
     */
    public static function getSettings()
    {
    	if (self::$instance == null) {
    		self::$instance = Settings::first();
			if (self::$instance == null) {
				self::$instance = new Settings();
			}
    	}
    	return self::$instance;
    }

    /**
     * Returns formatted currency
     * @param  float $value Value to format
     * @return string
     */
    public static function currency($value)
    {
    	if ($value == '' || $value == null) {
    		return '0';
    	}
    	return str_replace(':value', $value, self::getSettings()->currency_format);
    }
}
