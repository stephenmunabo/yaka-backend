<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\DeliveryBoyMessage;
use App\Order;
use App\Services\OrdersService;

class OrdersController extends BaseController
{
    protected $base = 'orders';
    protected $cls = 'App\Order';
    protected $checkboxes = ['is_paid'];

    protected function getIndexItems($data)
    {
    	if ($data != null) {
    		$orders = Order::policyScope();
    		if (is_array($data) && isset($data['q'])) {
    			$orders = $orders->where(function ($query) use ($data) {
    				$q = '%' . $data['q'] . '%';
    				return $query->where('address', 'LIKE', $q)->
    					orWhere('name', 'LIKE', $q)->
    					orWhere('phone', 'LIKE', $q);
    			});
    		}
            if (is_array($data) && isset($data['city_id'])) {
                $orders = $orders->where('city_id', $data['city_id']);
            }
            if (is_array($data) && isset($data['restaurant_id'])) {
                $orders = $orders->where('restaurant_id', $data['restaurant_id']);
            }
            if (is_array($data) && isset($data['customer_id'])) {
                $orders = $orders->where('customer_id', $data['customer_id']);
            }
            if (is_array($data) && isset($data['order_status_id'])) {
                $orders = $orders->where('order_status_id', $data['order_status_id']);
            }
    		if (is_array($data) && isset($data['dt'])) {
    			$orders = $orders->whereDate('created_at', '=', $data['dt']);
    		}
    		return $orders->paginate(20);
    	}
    	else {
            return Order::policyScope()->paginate(20);
        }
    }

    public function save($item, Request $request) 
    {
        $service = new OrdersService();
        $validator = $service->getValidator($request->all());
        if ($validator->passes()) {
            $data = [
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'lat' => 0,
                'lng' => 0,
                'payment_method' => $request->input('payment_method'),
                'stripe_token' => '',
                'paypal_id' => '',
                'delivery_area_id' => $request->input('delivery_area_id'),
                'city_id' => $request->input('city_id'),
                'order_status_id' => $request->input('order_status_id'),
                'restaurant_id' => $request->input('restaurant_id'),
                'is_paid' => ($request->input('is_paid') ? true : false)
            ];
            if ($item->id == null) {
                $service->createOrder($data, [], $request->input('promo_code'));
            }
            else {
                $service->updateOrder($item, $data, [], $request->input('promo_code'));
            }
            return redirect(route($this->base . '.index'));
        } else {
            $item->fill($request->all());
            $errors = $validator->messages();
            return view($this->base . '.form', array_merge(compact('item', 'errors'), $this->getAdditionalData()));
        }
    }

    public function setDeliveryBoy($id, Request $request)
    {
        $item = Order::find($id);
        if (!Gate::allows('create', $item)) {
            return redirect('/');
        }
        $boy_id = $request->input('delivery_boy_id');
        $item->delivery_boy_id = $boy_id;
        $item->save();
        DeliveryBoyMessage::create([
            'delivery_boy_id' => $boy_id,
            'message' => __('messages.delivery_boy_messages.new_order')
        ]);
        return redirect(route('orders.show', ['id' => $id]));
    }
}
