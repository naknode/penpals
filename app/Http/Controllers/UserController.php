<?php

namespace App\Http\Controllers;

use App\User;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Validate whether the user passed the human test.
     *
     * @param  \App\Rules\Recaptcha $recaptcha
     * @return \Illuminate\Http\Response
     */
    public function tryBeingHuman(Recaptcha $recaptcha)
    {
        request()->validate([
            'g-recaptcha-response' => ['required', $recaptcha],
        ]);

        auth()->user()->confirmHumanlyness();

        if (request()->wantsJson()) {
            return response(auth()->user()->fresh(), 201);
        }

        return redirect(route('view.register.photo'))->with(['message' => __('validation.wizard.success.robot')]);
    }

    /**
     * Add the profile photo for the user.
     */
    public function wizardPhoto()
    {
        request()->validate([
            'avatar' => ['required', 'image'],
        ]);

        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public'),
        ]);

        return redirect(route('view.register.profile'))->with(['message' => __('validation.wizard.success.photo')]);
    }

    /**
     * Finish creating the profile for the user.
     */
    public function wizardProfile()
    {
        request()->validate([
            'biography' => ['required'],
            'learning_language' => ['required'],
            'learning_fluency' => ['required'],
            'speaks_language' => ['required'],
            'speaks_fluency' => ['required'],
        ]);

        auth()->user()->update([
            'biography' => request('biography'),
        ]);

        $languages = [
            'learning_language' => request('learning_language'),
            'learning_fluency' => request('learning_fluency'),
            'speaks_language' => request('speaks_language'),
            'speaks_fluency' => request('speaks_fluency'),
        ];

        foreach ($languages['learning_language'] as $key => $language) {
            auth()->user()->addLanguage($language, $languages['learning_fluency'][$key], 'learning');
        }

        foreach ($languages['speaks_language'] as $key => $language) {
            auth()->user()->addLanguage($language, $languages['learning_fluency'][$key], 'speaks');
        }

        return redirect(route('view.dashboard'))->with(['message' => __('validation.wizard.success.biography')]);
    }

    /**
     * Store a new user avatar.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAvatar()
    {
        request()->validate([
            'avatar' => ['required', 'image'],
        ]);

        \Storage::disk('public')->delete(auth()->user()->getOriginal('avatar_path'));

        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public'),
        ]);

        return response([], 204);
    }
}
