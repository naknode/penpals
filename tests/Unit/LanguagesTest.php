<?php

namespace Tests\Unit;

use App\Languages;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_language_belongs_to_a_user()
    {
        $user = create(\App\User::class);

        $learning = [
            'language' => 'English',
            'fluency' => 'conversational',
            'type' => 'learning',
        ];

        $speaking = [
            'language' => 'Chinese',
            'fluency' => 'working fluency',
            'type' => 'speaks',
        ];

        $user->addLanguage($speaking['language'], $speaking['fluency'], $speaking['type']);
        $user->addLanguage($learning['language'], $learning['fluency'], $learning['type']);

        $this->assertCount(2, $user->languages);
        $this->assertDatabaseHas('languages', $speaking);
        $this->assertDatabaseHas('languages', $learning);

        $language = Languages::where(['user_id' => $user->id])->first();
        $this->assertNotNull($language);
    }

    /** @test */
    public function a_user_cannot_add_a_language_with_an_invalid_fluency()
    {
        $user = create(\App\User::class);

        $learning = [
            'language' => 'English',
            'fluency' => 'INVALID FLUENCY',
            'type' => 'learning',
        ];

        $user->addLanguage($learning['language'], $learning['fluency'], $learning['type']);

        $this->assertCount(0, $user->languages);
    }
}
