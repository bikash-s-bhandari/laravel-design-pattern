<?php

namespace App\Repositories;

use App\Contracts\EasyToMaintain\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $model) {}

    public function findById(int $id): User
    {
        return $this->model->where('id', $id)->firstOrFail();
    }

    public function updateEmail(int $id, string $newEmail): bool
    {
        return $this->model->where('id', $id)->update(['email' => $newEmail]);
    }
}
