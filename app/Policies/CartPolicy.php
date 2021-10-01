<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function __call(string $name, array $arguments)
    {
        /** @var User $entity */
        $entity = $arguments[0];
        $args = $arguments[1] ?? [];

        switch ($name) {
            case 'view':
            case 'create':
            case 'update':
            case 'upsert':
            case 'delete':
                $bool = $entity->isAdmin() || $entity->id == $args['customer_id'];
                break;
            default:
                $bool = false;
        }

        return $bool;
    }
}
