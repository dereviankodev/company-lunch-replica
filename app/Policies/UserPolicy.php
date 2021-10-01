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

        switch ($name) {
            case 'update':
            case 'upsert':
                return $entity->isAdmin() || $entity->id == $args['id'];
            case 'delete':
            case 'restore':
            case 'forceDelete':
                return $entity->isAdmin();
            default:
                return false;
        }
    }
}
