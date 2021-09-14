<?php

namespace App\Policies;

use App\Models\Dish;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DishPolicy
{
    use HandlesAuthorization;

    public function __call(string $name, array $arguments)
    {
        /** @var User $entity */
        $entity = $arguments[0];

        return match ($name) {
            'create', 'update', 'upsert', 'delete', 'restore', 'forceDelete' => $entity->isAdmin(),
        };
    }
}
