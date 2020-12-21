@extends('layouts.app')

@section('content')
    <div class="bg-image overflow-hidden"
         style="background-image: url({{URL::asset('/images/background_welcome.jpg')}});
         background-repeat: no-repeat;
         background-position: center;
         background-size: cover;">
        <div class="vertical-center">
            <div class="container ml-0">
                <div class="pl-5">
                    <h1 style="color: white; font-size:60px; text-shadow: black 0.1em 0.1em 0.2em" >greenlaneAdventures</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
