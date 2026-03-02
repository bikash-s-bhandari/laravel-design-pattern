<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private UserRepository $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = new UserRepository(new User());
    }

    public function it_should_not_find_user_by_id_when_user_does_not_exist()
    {
        $found = $this->repo->findById(999999);

        $this->assertNull($found);
    }

    /** @test */
    public function it_finds_user_by_id()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);

        $found = $this->repo->findById($user->id);

        $this->assertNotNull($found);
        $this->assertEquals($user->id, $found->id);
        $this->assertEquals('test@example.com', $found->email);
    }

    /** @test */
    public function update_email_returns_false_when_user_does_not_exist()
    {
        $result = $this->repo->updateEmail(999999, 'whatever@example.com');

        $this->assertFalse($result);
    }

    /** @test */
    public function update_email_returns_true_when_user_exists()
    {
        $user = User::factory()->create(['email' => 'old@example.com']);

        $result = $this->repo->updateEmail($user->id, 'new@example.com');

        $this->assertTrue($result);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'new@example.com'
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => 'old@example.com'
        ]);
    }
}
