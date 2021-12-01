<?php

namespace App\Policies;

use App\Models\Tip;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipPolicy
{
    use HandlesAuthorization;

    public function owner(User $user, Tip $tip)
    {
        return $user->id === $tip->user_id;
    }
}
