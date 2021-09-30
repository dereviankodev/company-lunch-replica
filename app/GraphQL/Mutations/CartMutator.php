<?php

namespace App\GraphQL\Mutations;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

class CartMutator
{
    public function forceDelete($root, array $args): Collection|array
    {
        $carts = Cart::where('user_id', $args['user_id'])->get();
        Cart::where('user_id', $args['user_id'])->forceDelete();

        return $carts;
    }
}
