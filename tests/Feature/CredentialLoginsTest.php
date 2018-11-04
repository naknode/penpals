<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CredentialLoginsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_login_with_their_email()
    {
        $this->withExceptionHandling();
        $user = [
            'email' => 'johnny@appleseed.com',
            'password' => 'appleseed',
        ];

        $credentials = [
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
        ];

        $john = create('App\User', $credentials);

        $this->post(route('login'), [
            'email' => $user['email'],
            'password' => $user['password'],
        ])->assertStatus(302)
        ->assertRedirect(route('view.dashboard'));
    }

    /** @test */
    public function a_user_can_login_with_their_username()
    {
        $this->withExceptionHandling();
        $user = [
            'username' => 'johnny',
            'password' => 'appleseed',
        ];

        $credentials = [
            'username' => $user['username'],
            'password' => bcrypt($user['password']),
        ];

        $john = create('App\User', $credentials);

        $this->post(route('login'), [
            'email' => $user['username'],
            'password' => $user['password'],
        ])->assertStatus(302)
        ->assertRedirect(route('view.dashboard'));
    }
}
