<?php

use App\Models\User;
use App\Queries\ActiveUsersQuery;
use App\Queries\UserIndexQuery;
use App\DTOs\UserFiltersDTO;

it('returns only active verified users', function () {

    $active = User::factory()->create([
        'active' => true,
        'email_verified_at' => now(),
    ]);

    User::factory()->create([
        'active' => false
    ]);

    User::factory()->create([
        'active' => true,
        'email_verified_at' => null
    ]);

    $results = (new ActiveUsersQuery)->get();

    expect($results)
        ->toHaveCount(1)
        ->first()->id->toBe($active->id);
});


it('filters by search term', function () {

    User::factory()->create([
        'name' => 'bikash',
        'active' => true,
        'email_verified_at' => now()
    ]);

    User::factory()->create([
        'name' => 'padam',
        'active' => true,
        'email_verified_at' => now()
    ]);

    $filters = new UserFiltersDTO(search: 'bikash');

    $results = (new UserIndexQuery($filters))->paginate();

    expect($results)->toHaveCount(1);
});
