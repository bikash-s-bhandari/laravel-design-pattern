<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10,000 users
        $users = User::factory(1000)->create();

        // For each user, create a post
        foreach ($users as $user) {
            $user->posts()->create([
                'title' => fake()->sentence,
                'content' => fake()->paragraph,
            ]);
        }

        // For each user, create at least 3 logins with random created_at dates within the last month to today
        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                $user->logins()->create([
                    'ip_address' => fake()->ipv4,
                    'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
