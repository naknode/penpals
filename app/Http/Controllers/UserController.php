<?php

namespace App\Http\Controllers;

use App\User;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Validate whether the user passed the human test
     *
     * @param  \App\Rules\Recaptcha $recaptcha
     * @return \Illuminate\Http\Response
     */
    public function tryBeingHuman(Request $request)
    {
        $response = $this->validate($request, [
            'g-recaptcha-response' => ['required', new Recaptcha]
        ]);

        auth()->user()->confirmHumanlyness();

        return redirect(route('view.register.photo'))->with(['message' => __('validation.wizard.success.robot')]);
    }

    public function wizardPhoto()
    {
        request()->validate([
            'avatar' => ['required', 'image']
        ]);

        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public')
        ]);

        return redirect(route('view.register.profile'))->with(['message' => __('validation.wizard.success.photo')]);
    }

    public function wizardProfile()
    {
        request()->validate([
            'biography' => ['required'],
            'languages' => ['required'],
        ]);

        auth()->user()->update([
            'biography' => request('biography')
        ]);

        $languages = request('languages');

        foreach ($languages['learning-language'] as $key => $language) {
            auth()->user()->addLanguage($language, $languages['learning-fluency'][$key], 'learning');
        }

        foreach ($languages['speaks-language'] as $key => $language) {
            auth()->user()->addLanguage($language, $languages['learning-fluency'][$key], 'speaks');
        }

        return redirect(route('view.dashboard'))->with(['message' => __('validation.wizard.success.biography')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Store a new user avatar.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAvatar()
    {
        request()->validate([
            'avatar' => ['required', 'image']
        ]);

        \Storage::disk('public')->delete(auth()->user()->getOriginal('avatar_path'));

        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public')
        ]);

        return response([], 204);
    }
}
