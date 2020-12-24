@extends('layouts.app')

@section('content')

@foreach ($tracks as $track)
    <div>
        <h3>{{ $track->titel }}</h3>
        <p>{{$track->difficulty}}</p>
        <a href="/tracks/{{$track->id}}">
            <img src="{{ $track->image }}" alt="Image missing" />
        </a>
    </div>
@endforeach

@endsection
