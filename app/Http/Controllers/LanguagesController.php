<?php

namespace App\Http\Controllers;

use App\Languages;
use Illuminate\Http\Request;

class LanguagesController extends Controller
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
        request()->validate([
            'level' => 'required|in:beginner,intermediate,advanced,fluent,native',
            'type' => 'required|in:learning,speaks',
            'user_id' => 'required',
        ]);

        $language = Language::create([
            'user_id' => auth()->id(),
            'level' => request('level'),
            'type' => request('type')
        ]);

        return $language;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Languages  $languages
     * @return \Illuminate\Http\Response
     */
    public function show(Languages $languages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Languages  $languages
     * @return \Illuminate\Http\Response
     */
    public function edit(Languages $languages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Languages  $languages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Languages $languages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Languages  $languages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Languages $languages)
    {
        //
    }
}
