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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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

        return redirect::to("/tracks/create")->with('success', 'Track successfully added')
                                                    ->with('track', $track)
                                                    ->with('gpx', $track->gpx);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $track = Track::all()->find($id);
        return view('track.show')->with('track', $track);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $track = Track::all()->find($id);

        if ($request->hasFile('image')){
            $request->validate(['image' => 'required|image']);
            $im_path = $request->file('image')->store('public/images');
            $track->image = $im_path;
        }

        if ($request->hasFile('gpx')){
            $gpx_path = $request->file('gpx')->store('public/gpx');
            $track->gpx = $gpx_path;
        }

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

        //store starting point in database for quick access
        $gpx = new phpGPX();
        $file = $gpx->load(asset($gpx_path));

        $lat = $file->tracks[0]->segments[0]->points[0]->latitude;
        $lon = $file->tracks[0]->segments[0]->points[0]->longitude;

        $track->lat = $lat;
        $track->lon = $lon;

        //other track parameters
        $title = $request->title;
        $description = $request->description;

        $track->title = $title;
        $track->description = $description;

        $track->update();

        return redirect::to("/profile")->with('success', 'Track successfully added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $track = Track::all()->find($id);

        $image = $track->image;
        $gpx = $track->gpx;

        Storage::delete($image);
        Storage::delete($gpx);

        $track->delete();
        return redirect('/profile');
    }

    /**
     *
     *  Search for a specific track based on name.
     *  TODO --- implement location based search function
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request){

        $search = $request->input('search');

        $tracks = Track::query()
            ->where('title','LIKE', "%{$search}%")
            ->get();
        //->orwhere('location', 'LIKE', "%{$search}%");
        //...
        return view('track.index')->with('tracks', $tracks);
    }

    public function select(Request $request){
        return Track::all()->where('id', '=', $request->id);
    }
}
