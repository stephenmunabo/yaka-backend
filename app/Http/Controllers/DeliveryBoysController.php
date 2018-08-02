<?php

namespace App\Http\Controllers;

use Gate;
use Validator;
use App\DeliveryBoyMessage;
use Illuminate\Http\Request;

class DeliveryBoysController extends BaseController
{
    protected $base = 'delivery_boys';
    protected $cls = 'App\DeliveryBoy';

    public function getValidator(Request $request)
    {
        $rules = [
            'name' => 'required',
            'login' => 'required'
        ];
        $data = $request->all();
        if (isset($data['password']) && !empty($data['password'])) {
            $rules['password'] = 'required|confirmed';
        }
        return Validator::make($request->all(), $rules);
    }

    protected function modifyRequestData($data)
    {
        if (isset($data['password'])) {
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
            else {
                unset($data['password']);
            }
            unset($data['password_confirmation']);
        }
        if ($data['password'] == null) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }
        return $data;
    }

    public function destroy($id)
    {
        $item = call_user_func([$this->cls, 'find'], $id);
        if (!Gate::allows('delete', $item)) {
            return redirect('/');
        }
        foreach (DeliveryBoyMessage::where('delivery_boy_id', $id)->get() as $message) {
            $message->delete();
        }
        $item->delete();
        return redirect(route($this->base . '.index'));
    }
}
