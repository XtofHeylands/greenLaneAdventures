@extends('layouts.app')

@section('content')
    @foreach ($tracks as $track)
        @if($track->user_id == auth()->id())
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="card mb-3 p-0" style="max-width: 100%;">
                    <div class="row no-gutters">
                        <div class="col-4">
                            <img src="/storage/images{{str_replace('public/images', '', $track->image)}}" class="card-img no-gutters" alt="Image missing">
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
        @endif
    @endforeach
@endsection
