<?php

namespace App\GraphQL\Mutations;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartMutator
{
    public function upsert($root, array $args)
    {
        $user_id = Auth::guard()->user()->getAuthIdentifier();
        $menu_id = $args['menu_id'];
        $count = $args['count'];

        return Cart::updateOrCreate(
            ['user_id' => $user_id, 'menu_id' => $menu_id],
            ['count' => $count]
        );
    }

    public function forceDelete($root, array $args)
    {
        $user_id = Auth::guard()->user()->getAuthIdentifier();
        $carts = Cart::where('user_id', $user_id)->get();
        Cart::where('user_id', $user_id)->forceDelete();

        return $carts;
    }
}
