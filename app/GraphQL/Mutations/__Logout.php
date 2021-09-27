<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Logout
{
    public function __invoke($_, array $args): ?User
    {
        $guard = Auth::guard();

        /** @var User|null $user */
        $user = $guard->user();
        $guard->logout();

        return $user;
    }
}
