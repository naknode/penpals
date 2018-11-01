<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;

class RegisterConfirmController extends Controller
{
    /**
     * Confirm a user's email address.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))->first();

        if (! $user) {
            return redirect(route('view.dashboard'))->with('flash', 'Invalid token.');
        }

        $user->confirm();

        return redirect(route('view.dashboard'))
            ->with('flash', 'Your profile is now confirmed.');
    }
}
