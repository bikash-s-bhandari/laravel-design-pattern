<?php

namespace App\Http\Controllers\Monstrous\Policies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Team;
use App\Events\UserRegistered;

class GoodExampleController extends Controller
{
    public function store(Team $team)
    {
        $this->authorize('addMember', $team);

        return 'Add the user to the team.';
    }
}
