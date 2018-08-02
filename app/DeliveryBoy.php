<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\DeliveryBoyMessage;
use App\DeliveryBoyApiToken;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DeliveryBoy extends Authenticatable
{
    protected $fillable = ['name', 'login', 'password'];

    protected $hidden = ['password'];

    public function orders()
    {
    	return $this->hasMany(Order::class);
    }

    public function apiTokens()
    {
    	return $this->hasMany(DeliveryBoyApiToken::class);
    }

    public function messages()
    {
        return $this->hasMany(DeliveryBoyMessage::class);
    }

    public function generateToken()
    {
        $token = bin2hex(random_bytes(16));
        while (DeliveryBoyApiToken::where('token', $token)->count() > 0) {
            $token = bin2hex(random_bytes(16));
        }
        return DeliveryBoyApiToken::create([
            'token' => $token,
            'delivery_boy_id' => $this->id
        ]);
    }
}
