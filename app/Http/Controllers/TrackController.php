<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the tracks
        $tracks = Track::all();
        // load and return the view
        return view('track.index')->with('tracks', $tracks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('track.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //handle image
        $validatedData = $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048']);
        $path = $request->file('image')->store('public/images');

        $track = new Track();
        $track->image = $path;

        //handle current user
        $user = auth()->id();
        $track->user_id = $user;

        //handle selected difficulty
        $difficulty = $request->dificulty;

        //ohter track parameters
        $title = $request->title;
        $description = $request->description;

        $track->title = $title;
        $track->description = $description;

        $track->save();

        return redirect('add-track')->with('status', 'Image successfully uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }







}
