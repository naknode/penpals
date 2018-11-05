<?php

namespace Tests\Feature;

use Carbon\Carbon;
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
        $this->get(route('password.request'))
            ->assertStatus(200)
            ->assertSee('Reset Password');
    }

    /** @test */
    public function a_user_can_update_their_password()
    {
        $user = factory('App\User')->create();

        $token = str_random(60);

        \DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $this->get("/password/reset/{$token}")
            ->assertStatus(200);
    }
}
