<?php

namespace App\Policies;

use App\User;
use App\Languages;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create languages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->robot === false;
    }

    /**
     * Determine whether the user can update the languages.
     *
     * @param  \App\User  $user
     * @param  \App\Languages  $languages
     * @return mixed
     */
    public function update(User $user, Languages $languages)
    {
        return $user->id === $languages->user->id;
    }

    /**
     * Determine whether the user can delete the languages.
     *
     * @param  \App\User  $user
     * @param  \App\Languages  $languages
     * @return mixed
     */
    public function delete(User $user, Languages $languages)
    {
        //
    }

    /**
     * Determine whether the user can view the myModel.
     *
     * @param  \App\User  $user
     * @param  \App\myModel  $myModel
     * @return mixed
     */
    public function view(User $user, MyModel $myModel)
    {
        dd("I'm being called...");
    }
}
