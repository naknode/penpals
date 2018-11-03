<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create(\App\User::class);

        $response = $this->getJson("/{$user->username}")->json();

        $this->assertEquals($response['profileUser']['name'], $user->name);
    }

    /** @test */
    public function a_user_can_view_their_profile()
    {
        $this->signIn();

        $this->get('/'.auth()->user()->username)
            ->assertStatus(200);
    }
}
