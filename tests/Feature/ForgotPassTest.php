<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPassTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_see_their_forgot_pass_page()
    {
        $response = $this->get('/password/reset')
            ->assertStatus(200)
            ->assertSee('Reset Password');
    }
}
