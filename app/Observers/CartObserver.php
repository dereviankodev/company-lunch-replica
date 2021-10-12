<?php

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartObserver
{
    private int $user_id;

    public function __construct(Auth $auth)
    {
        $this->user_id = $auth::guard()->user()->getAuthIdentifier();
    }

    public function creating(Cart $cart)
    {
        $cart->user_id ?? $cart->user_id = $this->user_id;
    }
}
