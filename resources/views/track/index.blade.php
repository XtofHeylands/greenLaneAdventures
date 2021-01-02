@extends('layouts.app')

@section('content')
    <div class="container pt-0 mt-5">
        <div class="row justify-content-between">
            <div class="col-auto mr-auto">
                <div class="btn-group btn-group">
                    <a href="{{ url('/tracks/create') }}" class="btn btn-primary" role="button">Add track</a>
                </div>
            </div>

            <div class="col-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">newest first</a>
                        <a class="dropdown-item" href="#">oldest first</a>
                        <a class="dropdown-item" href="#">Most popular first</a>
{{--                        TODO insert ways of sorting tracks--}}
{{--                        TODO implement way for users to indicate they have driven a certain track, based on this parameter sorting by popularity--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@if($tracks->isNotEmpty())
    @foreach ($tracks as $track)
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="card mb-3 p-0" style="max-width: 100%;">
                    <div class="row no-gutters">
                        <div class="col-4">
                            <img src="/storage/images{{str_replace('public/images', '', $track->image)}}" class="card-img no-gutters" alt="Image missing" style="max-height: 350px; max-width: 350px; object-fit: cover">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$track->title}}</h5>
                                @if($track->difficulty == 'easy')
                                    Difficulty:
                                    <span class="badge badge-pill badge-success">easy</span>
                                @elseif($track->difficulty == 'medium')
                                    Difficulty:
                                    <span class="badge badge-pill badge-warning">medium</span>
                                @else
                                    Difficulty:
                                    <span class="badge badge-pill badge-danger">hard</span>
                                @endif
                                <p class="card-text"><small class="text-muted">Created on {{$track->created_at}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card mb-3 p-0" style="max-width: 100%;">
                <div class="row no-gutters">
                    <h2 class="text-center p-5">No tracks found!</h2>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
