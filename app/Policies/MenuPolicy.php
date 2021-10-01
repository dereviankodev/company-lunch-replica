<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    public function __call(string $name, array $arguments)
    {
        /** @var User $entity */
        $entity = $arguments[0];

        switch ($name) {
            case 'create':
            case 'update':
            case 'upsert':
            case 'delete':
            case 'restore':
            case 'forceDelete':
                $bool = $entity->isAdmin();
                break;
            default:
                $bool = false;
        }

        return $bool;
    }
}
