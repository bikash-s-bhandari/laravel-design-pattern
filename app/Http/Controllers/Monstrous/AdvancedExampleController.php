<?php

namespace App\Http\Controllers\Monstrous;

use App\Http\Controllers\Controller;
use App\Services\Monstrous\UserService;
use App\Http\Requests\RegisterUserRequest;

class AdvancedExampleController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function register(RegisterUserRequest $request)
    {
        $user = $this->userService->register(
            $request->toDto()
        );

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user,
        ]);
    }
}
