<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\DTOs\UserFiltersDTO;
use Illuminate\Pagination\LengthAwarePaginator;

class UserIndexQuery
{
    public function __construct(
        private UserFiltersDTO $filters
    ) {}

    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return $this->baseQuery()->paginate($perPage);
    }

    private function baseQuery(): Builder
    {
        return User::query()
            ->with(['posts', 'company'])
            ->where('active', true)
            ->whereNotNull('email_verified_at')

            ->when($this->filters->search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })

            ->when($this->filters->plan, function ($q, $plan) {
                $q->whereHas('subscription', function ($s) use ($plan) {
                    $s->where('plan', $plan);
                });
            })

            ->when($this->filters->from, function ($q, $from) {
                $q->whereDate('created_at', '>=', $from);
            })

            ->orderBy(
                $this->filters->sort,
                $this->filters->dir
            );
    }
}
