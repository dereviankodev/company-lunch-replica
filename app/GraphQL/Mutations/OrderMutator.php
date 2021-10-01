<?php

namespace App\GraphQL\Mutations;

use App\Models\Cart;
use App\Models\Order;

class OrderMutator
{
    public function makeAutoOrder($root, array $args)
    {
        $customerId = $args['customer_id'];
        $recipientId = $args['recipient_id'] ?? null;
        $order = Order::create(['customer_id' => $customerId, 'recipient_id' => $recipientId]);
        $carts = Cart::where('user_id', $args['customer_id'])->with('menu')->get();
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
        Cart::where('user_id', $args['customer_id'])->forceDelete();

        return $order;
    }
}
