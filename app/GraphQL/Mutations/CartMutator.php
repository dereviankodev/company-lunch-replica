<?php

namespace App\GraphQL\Mutations;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartMutator
{
    private int $user_id;

    public function __construct(Auth $auth)
    {
        $this->user_id = $auth::guard()->user()->getAuthIdentifier();
    }

    public function upsert($root, array $args)
    {
        $menu_id = $args['menu_id'];
        $count = $args['count'];

        return Cart::updateOrCreate(
            ['user_id' => $this->user_id, 'menu_id' => $menu_id],
            ['count' => $count]
        );
    }

    public function forceDelete($root, array $args)
    {
        $carts = Cart::where('user_id', $this->user_id)->get();
        Cart::where('user_id', $this->user_id)->forceDelete();

        return $carts;
    }
}
