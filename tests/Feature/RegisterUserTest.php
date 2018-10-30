<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Rules\Recaptcha;
use App\Mail\ConfirmYourEmail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase, MockeryPHPUnitIntegration;

    public function setUp()
    {
        parent::setUp();

        app()->singleton(Recaptcha::class, function () {
            return \Mockery::mock(Recaptcha::class, function ($m) {
                $m->shouldReceive('passes')->andReturn(true);
            });
        });

        Mail::fake();
    }

    /** @test */
    public function users_can_register_an_account()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('POST', route('register'), [
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => 'secret'
        ]);

        $response->assertRedirect('/register/robot');

        $this->assertTrue(Auth::check());
        $this->assertCount(1, User::all());

        tap(User::first(), function ($user) {
            $this->assertEquals('johndoe', $user->username);
            $this->assertEquals('johndoe@example.com', $user->email);
            $this->assertTrue(Hash::check('secret', $user->password));
        });
    }

    /** @test */
    public function a_user_needs_to_confirm_their_humanlyness()
    {
        $this->withExceptionHandling()->signIn();

        unset(app()[Recaptcha::class]);

        $this->post('/register/robot', ['g-recaptcha-response' => 'test'])->assertSessionHasErrors();
    }

    /** @test */
    public function a_user_can_confirm_their_humanlyness()
    {
        $this->withExceptionHandling()->signIn();

        auth()->user()->confirmHumanlyness();

        $this->assertFalse(auth()->user()->fresh()->robot);
    }

    /** @test */
    public function a_confirmation_email_is_sent_upon_registration()
    {
        $this->post(route('register'), $this->validParams());
        Mail::assertSent(ConfirmYourEmail::class);
    }

    /** @test */
    public function a_user_can_upload_their_profile_photo()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('POST', route('avatar', auth()->id()), [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertEquals(asset('avatars/' . $file->hashName()), auth()->user()->avatar_path);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        $this->withExceptionHandling()->signIn();

        $this->json('POST', route('avatar', auth()->id()), [
            'avatar' => 'not-an-image'
        ])->assertStatus(422);
    }

    /** @test */
    public function a_user_can_fill_out_their_biography_and_languages()
    {
        $this->signIn();

        $myBio = 'I like long walks on the beach and candle-lit dinners.';
        $learning_language = ['English'];
        $learning_fluency = ['fluent'];
        $speaks_language = ['fluent'];
        $speaks_fluency = ['native'];

        $response = $this->json('POST', route('post.register.profile', auth()->id()), [
            'biography' => $myBio,
            'learning_language' => $learning_language,
            'learning_fluency' => $learning_fluency,
            'speaks_language' => $speaks_language,
            'speaks_fluency' => $speaks_fluency
        ])->assertStatus(302);

        $language = [
            'language' => $learning_language[0],
            'fluency' => $learning_fluency[0],
            'type' => 'learning',
            'user_id' => auth()->id()
        ];

        $this->assertEquals(auth()->user()->fresh()->biography, $myBio);
        $this->assertDatabaseHas('languages', $language);
        $this->assertEquals(2, auth()->user()->fresh()->languages->count());
        $response->assertRedirect(route('view.dashboard'))
                ->assertSessionHas('message', __('validation.wizard.success.biography'));
    }

    private function validParams($overrides = [])
    {
        return array_merge([
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => 'secret'
        ], $overrides);
    }
}
