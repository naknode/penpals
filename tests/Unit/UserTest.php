<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_determine_their_avatar_path()
    {
        $user = create(\App\User::class);

        $this->assertEquals(asset('images/avatars/default.jpg'), $user->avatar_path);

        $user->avatar_path = 'avatars/me.jpg';

        $this->assertEquals(asset('avatars/me.jpg'), $user->avatar_path);
    }

    /** @test */
    public function a_user_gets_redirect_to_dashboard_if_they_try_to_login()
    {
        $user = create(\App\User::class);
        $this->signin($user);

        $this->get(route('login'))
            ->assertStatus(302)
            ->assertRedirect(route('view.dashboard'));
    }
}
