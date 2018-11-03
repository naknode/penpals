<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @param  User $user
     * @return \Response
     */
    public function show(User $user)
    {
        $data = ['profileUser' => $user];

        return view('profiles.show', $data);
    }
}
