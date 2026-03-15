<?php

namespace App\Http\Controllers\Monstrous\Policies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Team;
use App\Events\UserRegistered;

class BadExampleController extends Controller
{
    public function store(Team $team)
    {
        // ❌ Authentication check
        if (auth()->guest()) {
            abort(403, 'You are not signed in.');
        }

        // ❌ Ownership check
        if ($team->owner_id != auth()->user()->id) {
            abort(403, 'You are not the owner.');
        }

        // ❌ Business rule
        if ($team->isMaxedOut()) {
            abort(403, 'Your team is maxed out.');
        }
        return 'Add the user to the team.';
    }
}
