<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPassTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        Mail::fake();
    }

    /** @test */
    public function a_user_can_see_see_their_forgot_pass_page()
    {
        $response = $this->get(route('password.request'))
            ->assertStatus(200)
            ->assertSee('Reset Password');
    }

    /** @test */
    public function a_user_can_update_their_password()
    {
        $user = factory('App\User')->create();

        $this->post(route('password.email'), ['email' => $user->email])
            ->assertStatus(302)
            ->assertSessionHas('status', __('passwords.sent'));
    }
}
