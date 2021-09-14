<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function __call(string $name, array $arguments)
    {
        /** @var User $entity */
        $entity = $arguments[0];
        $args = $arguments[1] ?? [];

        return match ($name) {
            'view', 'create' => $entity->isAdmin() || $entity->id == $args['id'],
            'update', 'upsert', 'delete', 'restore', 'forceDelete' => $entity->isAdmin(),
        };
    }
}
