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

        return match ($name) {
            'view', 'create', 'update', 'upsert', 'delete' => $entity->isAdmin() || $entity->id == $args['id']
        };
    }
}
