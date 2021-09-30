<?php

namespace App\GraphQL\Mutations;

use App\Models\Cart;

class CartMutator
{
    public function forceDelete($root, array $args)
    {
        $carts = Cart::where('user_id', $args['user_id'])->get();
        Cart::where('user_id', $args['user_id'])->forceDelete();

        return $carts;
    }
}
