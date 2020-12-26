@extends('layouts.app')

@section('content')
    <div class="container pt-0 mt-5">
        <div class="row justify-content-between">
            <div class="col-auto mr-auto">
                <div class="btn-group btn-group">
                    <button type="button" class="btn btn-primary">Add track</button>
                    <button type="button" class="btn btn-secondary">Manage tracks</button>
                </div>
            </div>

            <div class="col-auto">
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter</button>
                    <div class="dropdown-menu">

                    </div>
                </div>
            </div>
        </div>
    </div>

@foreach ($tracks as $track)
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ $track->image }}" class="card-img" alt="Image missing">
                    </div>
                    <div class="col-md-8">
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

@endsection
