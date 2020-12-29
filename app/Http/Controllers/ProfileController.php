<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\User;

class ProfileController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tracks = Track::all()->where('user_id', auth()->id());
        $user = auth()->user();

        return view('profile.index')->with('tracks', $tracks)
                                            ->with('user', $user);
    }
}
