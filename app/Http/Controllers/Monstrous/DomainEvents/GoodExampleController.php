<?php

namespace App\Http\Controllers\Monstrous\DomainEvents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Events\UserRegistered;

class GoodExampleController extends Controller
{
    public function store(RegisterUserRequest $request)
    {
        $user = User::create($request->validated());

        UserRegistered::dispatch($user);

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user,
        ]);
    }

}
