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

        $response = $this->post(route('register'), [
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => 'secret',
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
    public function a_user_may_add_an_avatar_during_registration()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('POST', route('post.register.photo', auth()->id()), [
          'avatar' => $file = UploadedFile::fake()->image('avatar.png'),
        ]);

        $this->assertEquals(asset('avatars/'.$file->hashName()), auth()->user()->avatar_path);

        Storage::disk('public')->assertExists('avatars/'.$file->hashName());
    }

    /** @test */
    public function a_user_needs_to_confirm_their_humanlyness()
    {
        $this->withExceptionHandling()
            ->signIn(factory('App\User')
            ->states('robot')
            ->create());

        $this->assertTrue(auth()->user()->fresh()->robot);

        unset(app()[Recaptcha::class]);

        $this->post('/register/robot', ['g-recaptcha-response' => 'test'])->assertSessionHasErrors();
        $this->assertTrue(auth()->user()->fresh()->robot);
    }

    /** @test */
    public function a_user_can_confirm_their_humanlyness()
    {
        $this->withExceptionHandling()->signIn();

        $this->post(route('post.register.robot'), ['g-recaptcha-response' => 'test'])
            ->assertRedirect(route('view.register.photo'))
            ->assertSessionHas('message', __('validation.wizard.success.robot'));

        $this->assertFalse(auth()->user()->fresh()->robot);
    }

    /** @test */
    public function a_confirmation_email_is_sent_upon_registration()
    {
        $this->post(route('register'), $this->validParams());
        Mail::assertSent(ConfirmYourEmail::class);
    }

    /** @test */
    public function a_user_cannot_validate_their_email_address_with_invalid_token()
    {
        $this->signIn();

        $this->assertFalse(auth()->user()->confirmed);
        $this->assertNotNull(auth()->user()->confirmation_token);

        $this->get(route('register.confirm', ['token' => 'invalid-token']))
            ->assertRedirect(route('view.dashboard'))
            ->assertStatus(302)
            ->assertSessionHas([
            'flash' => 'Invalid token.',
        ]);

        $this->assertFalse(auth()->user()->confirmed);
        $this->assertNotNull(auth()->user()->confirmation_token);
    }

    /** @test */
    public function a_user_can_fully_confirm_their_email_address()
    {
        $this->post(route('register'), $this->validParams([
            'email' => 'john@doe.com',
        ]));

        $user = User::whereEmail('john@doe.com')->first();

        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);

        $this->get(route('register.confirm', ['token' => $user->confirmation_token]))
            ->assertRedirect(route('view.dashboard'));

        tap($user->fresh(), function ($user) {
            $this->assertTrue($user->confirmed);
            $this->assertNull($user->confirmation_token);
        });
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        $this->withExceptionHandling()->signIn();

        $this->json('POST', route('avatar', auth()->id()), [
            'avatar' => 'not-an-image',
        ])->assertStatus(422);
    }

    /** @test */
    public function a_user_can_fill_out_their_biography()
    {
        $this->signIn();

        $myBio = 'I like long walks on the beach and candle-lit dinners.';

        $response = $this->post(route('post.register.profile', auth()->id()), [
            'biography' => $myBio,
        ])->assertStatus(302);

        $this->assertEquals(auth()->user()->fresh()->biography, $myBio);

        $response->assertRedirect(route('view.dashboard'))
                ->assertSessionHas('message', __('validation.wizard.success.biography'));
    }

    private function validParams($overrides = [])
    {
        return array_merge([
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => 'secret',
        ], $overrides);
    }
}
