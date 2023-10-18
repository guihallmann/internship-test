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
}
