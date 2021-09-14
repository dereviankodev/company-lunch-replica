<?php

namespace App\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class Login
{
    /**
     * @throws Error
     */
    public function __invoke($_, array $args): ?Authenticatable
    {
        $guard = Auth::guard();

        if (!$guard->attempt($args)) {
            throw new Error('Invalid credentials.');
        }

        return $guard->user();
    }
}
