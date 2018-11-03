<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_their_dashboard()
    {
        $this->signIn();

        $response = $this->get(route('view.dashboard'))
            ->assertStatus(200)
            ->assertSee('Welcome');
    }
}
