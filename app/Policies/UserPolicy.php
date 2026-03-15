<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\Team;

class UserPolicy
{
    public function addMember(User $user, Team $team): bool
    {
        return $user->id === $team->owner_id && ! $team->isMaxedOut();
    }
    public function update(User $user, Team $team): bool
    {
        return $user->id === $team->owner_id;
    }
    public function delete(User $user, Team $team): bool
    {
        return $user->id === $team->owner_id && $team->members->isEmpty();
    }
}
