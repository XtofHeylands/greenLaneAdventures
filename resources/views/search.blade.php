@extends('layouts.app')

@section('content')

    @foreach($tracks as $track)
        <div class="container-fluid">
            <h2>{{$track->Name}}</h2>
            <a href="/tracks/{{$track->id}}">
                <img src="{{$track->main_Image}}" alt="No image">
            </a>
        </div>

{{--TODO finish page do dipaly results of search query, list with pages if amount is to large--}}
@endsection
