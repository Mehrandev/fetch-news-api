<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Unit\Services\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_checks_if_user_can_be_authenticated_with_valid_credentials()
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        $credentials = ['email' => $user->email, 'password' => 'password123'];

        $this->assertTrue(auth()->attempt($credentials));
    }

    #[Test]
    public function it_fails_to_authenticate_with_invalid_credentials()
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        $invalidCredentials = ['email' => $user->email, 'password' => 'invalidpassword'];

        $this->assertFalse(auth()->attempt($invalidCredentials));
    }
}
