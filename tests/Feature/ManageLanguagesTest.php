<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageLanguagesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function authorized_user_can_add_a_language()
    {
        $newLanguage = [
            'language_name' => 'English',
            'fluency' => 'native',
            'type' => 'learning',
            'user_id' => auth()->id(),
        ];

        $this->post(route('languages.add', $newLanguage))->assertStatus(200);
    }

    /** @test */
    public function authorized_user_can_edit_a_language()
    {
        $language = create(\App\Languages::class, [
            'fluency' => 'conversational',
            'language_name' => 'Chinese',
            'type' => 'learning',
            'user_id' => 1,
        ]);

        $updatedLanguage = [
            'fluency' => 'native',
            'language_name' => 'Chinese',
            'id' => $language->id,
        ];

        $this->post(route('languages.update', ['id' => $language->id]), $updatedLanguage)
            ->assertStatus(200);

        $this->assertDatabaseHas('languages', [
            'language_name' => 'Chinese',
            'fluency' => 'native',
            'type' => 'learning',
            'user_id' => 1,
            'id' => 1,
        ]);
    }

    /** @test */
    public function a_user_can_fetch_their_languages()
    {
        // We create a langauge attached to a user
        $language = create(\App\Languages::class, [
            'fluency' => 'native',
            'language_name' => 'English',
            'type' => 'learning',
            'user_id' => 1,
        ]);

        // And then fetch it from a 3rd-party plugin
        $response = $this->get(route('languages.user.get', [
                'user' => $language->user,
                'type' => 'learning',
            ]))
            ->assertStatus(200);

        // We get that result back successfully
        $response->assertSeeInOrder([
            'language_name' => 'English',
            'fluency' => 'native',
            'type' => 'learning',
            'user_id' => 1,
        ]);
    }

    /** @test */
    public function user_cannot_add_a_language_with_an_invalid_fluency_level()
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->create());

        $newLanguage = [
            'language_name' => 'English',
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
            'language_name' => '',
            'fluency' => 'native',
            'type' => 'learning',
            'user_id' => auth()->id(),
        ];

        $this->post(route('languages.add', $newLanguage))->assertSessionHasErrors('language_name');
        $this->assertCount(0, auth()->user()->languages);
    }

    /** @test */
    public function user_cannot_add_a_language_with_no_type_selected()
    {
        $this->withExceptionHandling();

        $newLanguage = [
            'language_name' => 'English',
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

        $newLanguage = [
            'language_name' => 'English',
            'fluency' => 'native',
            'type' => 'milk',
            'user_id' => auth()->id(),
        ];

        $this->post(route('languages.add', $newLanguage))->assertSessionHasErrors('type');
        $this->assertCount(0, auth()->user()->languages);
    }

    /** @test */
    public function a_user_can_delete_a_saved_language()
    {
        $language = create(\App\Languages::class, [
            'fluency' => 'native',
            'language_name' => 'English',
            'type' => 'learning',
            'user_id' => 1,
        ]);

        $this->delete(route('languages.delete', ['id' => 1]))->assertStatus(200);

        $this->assertDatabaseMissing('languages', ['id' => 1]);
        $this->assertEquals(0, auth()->user()->fresh()->languages->count());
    }

    /** @test */
    public function unauthorized_user_cannot_delete_someone_elses_saved_language()
    {
        $this->withExceptionHandling();

        $language = create(\App\Languages::class, [
            'fluency' => 'native',
            'language_name' => 'English',
            'type' => 'learning',
        ]);

        $this->signIn(factory('App\User')->create());

        $this->delete(route('languages.delete', ['id' => 1]))->assertStatus(403);

        $this->assertDatabaseHas('languages', ['id' => 1]);
        $this->assertCount(1, $language->user->languages);
    }
}
