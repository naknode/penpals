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

    public function destroy(Languages $languages)
    {
        $this->authorize('delete', $languages);

        $languages->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Language deleted']);
        }

        return response(200);
    }

    public function update(Languages $languages)
    {
        $this->authorize('update', $languages);

        $getLanguage = \App\Languages::find(request('id'));
        $getLanguage->fluency = request('fluency');
        $getLanguage->language_name = request('language_name');
        $getLanguage->save();
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
            'language_name' => 'required',
            'fluency' => 'required|in:beginner,intermediate,advanced,fluent,native,conversational,working fluency,professional fluency',
            'type' => 'required|in:learning,speaks',
            'user_id' => 'required',
        ]);

        $added = Languages::create([
            'language_name' => request('language_name'),
            'fluency' => request('fluency'),
            'type' => request('type'),
            'user_id' => request('user_id'),
        ]);

        return $added->id;
    }
}
