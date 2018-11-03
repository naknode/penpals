<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageLanguagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authorized_user_can_add_a_language()
    {
        $this->signIn(factory('App\User')->create());

        $newLanguage = [
            'language' => 'English',
            'fluency' => 'native',
            'type' => 'learning',
            'user_id' => auth()->id(),
        ];

        $this->post(route('languages.add', $newLanguage))->assertStatus(200);
    }

    /** @test */
    public function unauthorized_user_cannot_add_a_language()
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('robot')->create());

        $newLanguage = [
            'language' => 'English',
            'fluency' => 'native',
            'type' => 'learning',
            'user_id' => auth()->id(),
        ];

        $this->post(route('languages.add', $newLanguage))->assertStatus(403);

        $this->assertCount(0, auth()->user()->languages);
    }

    /** @test */
    public function user_cannot_add_a_language_with_an_invalid_fluency_level()
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->create());

        $newLanguage = [
            'language' => 'English',
            'fluency' => 'ERROR',
            'type' => 'learning',
            'user_id' => auth()->id(),
        ];

        $this->post(route('languages.add', $newLanguage))->assertSessionHasErrors('fluency');
        $this->assertCount(0, auth()->user()->languages);
    }

    /** @test */
    public function user_cannot_add_a_language_with_no_language_selected()
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->create());

        $newLanguage = [
            'language' => '',
            'fluency' => 'native',
            'type' => 'learning',
            'user_id' => auth()->id(),
        ];

        $this->post(route('languages.add', $newLanguage))->assertSessionHasErrors('language');
        $this->assertCount(0, auth()->user()->languages);
    }

    /** @test */
    public function user_cannot_add_a_language_with_no_type_selected()
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->create());

        $newLanguage = [
            'language' => 'English',
            'fluency' => 'native',
            'type' => '',
            'user_id' => auth()->id(),
        ];

        $this->post(route('languages.add', $newLanguage))->assertSessionHasErrors('type');
        $this->assertCount(0, auth()->user()->languages);
    }

    /** @test */
    public function user_cannot_add_a_language_with_an_invalid_type_selected()
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->create());

        $newLanguage = [
            'language' => 'English',
            'fluency' => 'native',
            'type' => 'milk',
            'user_id' => auth()->id(),
        ];

        $this->post(route('languages.add', $newLanguage))->assertSessionHasErrors('type');
        $this->assertCount(0, auth()->user()->languages);
    }
}
