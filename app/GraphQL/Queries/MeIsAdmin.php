<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MeIsAdmin
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args): bool
    {
        $guard = Auth::guard();
        /** @var User $user */
        $user = $guard->user();

        return $user->is_admin ?? false;
    }
}
