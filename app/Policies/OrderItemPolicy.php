<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderItemPolicy
{
    use HandlesAuthorization;

    public function __call(string $name, array $arguments)
    {
        /** @var User $entity */
        $entity = $arguments[0];
        $args = $arguments[1] ?? [];
        /** @var Order $order */
        $order = Order::where('id', $args['order_id'])->with('customer')->first();
        $id = $order->customer->id;

        switch ($name) {
            case 'view':
            case 'create':
                return $entity->isAdmin() || $entity->id == $id;
            case 'update':
            case 'upsert':
            case 'delete':
            case 'restore':
            case 'forceDelete':
                return $entity->isAdmin();
            default:
                return false;
        }
    }
}
