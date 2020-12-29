@extends('layouts.app')



@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">{{$user->name}}</div>
                <div class="card-body">
                    <a href="#" class="btn btn-secondary" role="button">Edit profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pt-3">
    <div class="row justify-content-center">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">Your tracks</div>
                <div class="card-body">
                    <div class="container">
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
                                        {{--                        TODO insert ways of sorting tracks--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success mt-3" role="alert">
                            Track successfully updated! View it <a href="#" class="alert-link">here</a>.
                            {{--                            TODO create track show to view detail of created and other tracks--}}
                        </div>
                    @endif

                    @foreach ($tracks as $track)
                        <div class="container mt-0 pt-0">
                            <div class="row justify-content-center">
                                <div class="card m-3 p-0" style="max-width: 100%;">
                                    <div class="card-body p-0">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <img src="/storage/images{{str_replace('public/images', '', $track->image)}}" class="card-img no-gutters" alt="Image missing" style="max-height: 350px; max-width: 350px; object-fit: cover">
                                            </div>
                                            <div class="col">
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
                                            <div class="col text-right pr-5" style="font-size: 5px;line-height: 115px;letter-spacing: 0.162em;font-weight: 100;font-style: normal;">
                                                <form action="{{URL('/tracks', ['track' => $track])}}" method="post">

                                                    <a href="tracks/{{$track->id}}/edit" class="btn btn-secondary" role="button">Edit</a>
                                                    <input class="btn btn-danger" type="submit" value="Delete">

                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
