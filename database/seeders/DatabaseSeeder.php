<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Feature;
use App\Models\Comment;
use App\Models\Company;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $companies = Company::factory(10)->create();
        // Create 1,000 users with randomly assigned statuses
        $users = User::factory(1000)->make()->each(function ($user) use ($companies) {
            $user->status = fake()->randomElement(['active', 'inactive', 'suspended']);
            $user->company_id = $companies->random()->id;
            $user->save();
        });

        // For each user, create a post
        foreach ($users as $user) {
            $user->posts()->create([
                'title' => fake()->sentence,
                'content' => fake()->paragraph,
            ]);
        }

        // For each post, create 1–5 comments (from the post author)
        foreach (Post::all() as $post) {
            Comment::factory()
                ->count(fake()->numberBetween(1, 5))
                ->for($post)
                ->for($post->user, 'user')
                ->create();
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

        Feature::factory(1000)->create()->each(function ($feature) {
            $feature->status = fake()->randomElement(['requested', 'approved', 'rejected']);
            $feature->save();
        });
    }
}
