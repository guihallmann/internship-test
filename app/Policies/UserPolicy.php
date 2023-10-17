<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user) {
        return $user->role === 'Ti' || $user->role === 'Sys';
    }

    public function createAll(User $user) {
        return $user->role === 'Ti';
    }

    public function createOp(User $user) {
        return $user->role === 'Ti' || $user->role === 'Sys';
    }
}
