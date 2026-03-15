<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final readonly class UserFiltersDTO
{
    public function __construct(
        public ?string $search  = null,
        public ?string $plan    = null,
        public ?string $from    = null,
        public ?string $to      = null,
        public string  $sort    = 'created_at',
        public string  $dir     = 'desc',
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            search: $request->input('search'),
            plan:   $request->input('plan'),
            from:   $request->input('from'),
            to:     $request->input('to'),
            sort:   $request->input('sort', 'created_at'),
            dir:    $request->input('dir', 'desc'),
        );
    }
}
