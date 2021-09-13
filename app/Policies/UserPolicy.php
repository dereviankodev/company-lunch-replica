<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $injectArgs): bool
    {
        return $user->isAdmin() || $user->id == $injectArgs['id'];
    }

//    /**
//     * Determine whether the user can delete the model.
//     */
//    public function delete(User $user): bool
//    {
//        return $user->isAdmin();
//    }
//
//    /**
//     * Determine whether the user can restore the model.
//     */
//    public function restore(User $user): bool
//    {
//        return $user->isAdmin();
//    }
//
//    /**
//     * Determine whether the user can permanently delete the model.
//     */
//    public function forceDelete(User $user): bool
//    {
//        return $user->isAdmin();
//    }
}
