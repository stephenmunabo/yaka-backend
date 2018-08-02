<?php

namespace App\Http\Controllers;

use App\PushMessage;
use Illuminate\Http\Request;

class PushMessagesController extends BaseController
{
    protected $base = 'push_messages';
    protected $cls = 'App\PushMessage';

    protected function getIndexItems($data)
    {
        return PushMessage::policyScope()->
            orderBy($this->orderBy, $this->orderByDir)->paginate(20);
    }
}
