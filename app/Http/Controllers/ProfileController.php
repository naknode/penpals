<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;

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

        if (request()->expectsJson()) {
            return $data;
        }

        return view('profiles.show', $data);
    }
}
