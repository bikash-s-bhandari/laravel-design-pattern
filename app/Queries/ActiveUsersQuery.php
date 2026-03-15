<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ActiveUsersQuery
{
    public function get(): Collection
    {
        return User::query()
            ->with(['posts', 'company'])
            ->where('active', true)
            ->whereNotNull('email_verified_at')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return User::query()
            ->with(['posts', 'company'])
            ->where('active', true)
            ->whereNotNull('email_verified_at')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
