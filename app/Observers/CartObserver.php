<?php

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartObserver
{
    public function creating(Cart $cart)
    {
        $cart->user_id ?? $cart->user_id = Auth::guard()->user()->getAuthIdentifier();
    }
}
