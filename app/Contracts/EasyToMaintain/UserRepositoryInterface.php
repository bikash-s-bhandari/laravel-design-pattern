<?php

namespace App\Contracts\EasyToMaintain;

use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

interface UserRepositoryInterface
{
    public function findById(int $id): User;
    public function updateEmail(int $id, string $newEmail): bool;
}
