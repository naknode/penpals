<?php

namespace App\Policies;

use App\User;
use App\Languages;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagesPolicy
{
    use HandlesAuthorization;

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
        return $user->id === $languages->user->id;
    }
}
