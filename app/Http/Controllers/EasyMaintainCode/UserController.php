<?php

namespace App\Http\Controllers\EasyMaintainCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function getUserById(int $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);

        return response()->json($user);
    }

    public function updateEmail(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        try {
            $updatedUser = $this->userService->changeUserEmail($id, $request->email);

            return response()->json([
                'message' => 'Email successfully updated',
                'user' => $updatedUser
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
