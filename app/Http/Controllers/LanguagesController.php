<?php

namespace App\Http\Controllers;

use App\Languages;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (auth()->user()->robot) {
            return response('Not allowed.', 403);
        }

        request()->validate([
            'language' => 'required',
            'fluency' => 'required|in:beginner,intermediate,advanced,fluent,native,conversational,working fluency,professional fluency',
            'type' => 'required|in:learning,speaks',
            'user_id' => 'required',
        ]);

        $added = Languages::create([
            'language' => request('language'),
            'fluency' => request('fluency'),
            'type' => request('type'),
            'user_id' => request('user_id'),
        ]);
    }
}
