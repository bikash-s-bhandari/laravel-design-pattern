<?php

namespace App\Services;

use App\Contracts\EasyToMaintain\UserRepositoryInterface;
use App\Models\User;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function getUserById(int $userId): User
    {
        return $this->userRepository->findById($userId);
    }


    public function changeUserEmail(int $userId, string $newEmail): bool
    {
        // यहाँ थप business logic राख्न सकिन्छ (validation, event, etc)
        if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email format");
        }

        return $this->userRepository->updateEmail($userId, $newEmail);
    }
}
