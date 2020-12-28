<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $track = new Track();

        //handle image
        $request->validate(['image' => 'required|image']);
        $im_path = $request->file('image')->store('public/images');
        $track->image = $im_path;

        //handle gpx file
        $gpx_path = $request->file('gpx')->store('public/gpx');
        $track->gpx = $gpx_path;

        //handle current user
        $user = auth()->id();
        $track->user_id = $user;

        //handle selected difficulty
        $easy_state = 'unchecked';
        $medium_state = 'unchecked';
        $hard_state = 'unchecked';

        $difficulty = null;

        if (isset($_POST['submitted'])){

                $selected = $_POST['difficulty'];

                if ($selected == 'easy'){
                    $easy_state = 'checked';
                } else if ($selected == 'medium'){
                    $medium_state = 'checked';
                } else if ($selected == 'hard'){
                    $hard_state = 'checked';
                }

                $difficulty = $selected;
        }
        $track->difficulty = $_POST['difficulty'];

        //ohter track parameters
        $title = $request->title;
        $description = $request->description;

        $track->title = $title;
        $track->description = $description;

        $track->save();

        return redirect::to("/add-track")->with('success', 'Track successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('track.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $track = Track::all()->find($id);
        return view('track.edit')->with('track', $track);
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
        //TODO logic to edit track details
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        Track::all()->find($id)->delete();
        return view('profile.index');
    }
}
