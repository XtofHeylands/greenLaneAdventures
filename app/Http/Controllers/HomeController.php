<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SOAP\WelcomeMessage;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Models\Track;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        $sw = new SoapWrapper();
        $sw->add("WelcomeMessageProvider", function($service){
            $service
                ->wsdl('http://localhost:52274/WebService.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    WelcomeMessage::class
                ]);

        });

        $response = $sw->call("WelcomeMessageProvider.WelcomeMessage", [new WelcomeMessage('test')] );
        $message = $response->WelcomeMessageResult;

        $tracks = Track::all();
        return view('home')->with('tracks', $tracks)
                                ->with('message', $message);
    }
}
