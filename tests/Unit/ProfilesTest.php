<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_profile_belongs_to_a_user()
    {
        $user = create(\App\User::class);
        $this->assertEquals($user->profile->path, "/{$user->username}");
    }

    /** @test */
    public function a_user_can_view_their_profile()
    {
        $user = create(\App\User::class);

        $this->get("/{$user->profile->path}")
            ->assertSee($user->name);
    }
}
