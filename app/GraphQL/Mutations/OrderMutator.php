<?php

namespace App\GraphQL\Mutations;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderMutator
{
    public function makeAutoOrder($root, array $args)
    {
        $user_id = Auth::guard()->user()->getAuthIdentifier();
        $recipientId = $args['recipient_id'] ?? null;
        $order = Order::create(['customer_id' => $user_id, 'recipient_id' => $recipientId]);
        $carts = Cart::where('user_id', $user_id)->with('menu')->get();
        $orderItems = [];

        foreach ($carts as $cart) {
            $orderItems[] = [
                'order_id' => $order->id,
                'dish_id' => $cart->menu->dish_id,
                'price' => $cart->menu->price,
                'count' => $cart->count,
            ];
        }

        $order->orderItems()->createMany($orderItems);
        Cart::where('user_id', $user_id)->forceDelete();

        return $order;
    }
}
