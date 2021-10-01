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

        switch ($name) {
            case 'view':
            case 'create':
                return $entity->isAdmin() || $entity->id == $args['customer_id'];
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
