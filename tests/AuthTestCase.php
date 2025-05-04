<?php

namespace Tests;

use App\Models\User;

abstract class AuthTestCase extends TestCase
{
    protected readonly User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->user->assignRole('admin');
        $this->actingAs($this->user);
    }
}
