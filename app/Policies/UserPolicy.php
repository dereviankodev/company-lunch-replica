<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function __call(string $name, array $arguments)
    {
        /** @var User $entity */
        $entity = $arguments[0];
        $args = $arguments[1] ?? [];

        return match ($name) {
            'update', 'upsert' => $entity->isAdmin() || $entity->id == $args['id'],
            'delete', 'restore', 'forceDelete' => $entity->isAdmin(),
        };
    }
}
