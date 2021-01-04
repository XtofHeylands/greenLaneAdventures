@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card mb-3 p-0" style="max-width: 100%;">
            <div class="row justify-content-center no-gutters">
                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id="map" style="height: 500px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="card mb-3 p-0" style="max-width: 100%;">
            <div class="row no-gutters">
                <div class="col-4">
                    <img src="/storage/images{{str_replace('public/images', '', $track->image)}}" class="card-img no-gutters" alt="Image missing">
                </div>
                <div class="col-6">
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
                @if($track->user_id == Auth()->id())
                <div class="col-2 text-right pr-5" style="font-size: 5px;line-height: 115px;letter-spacing: 0.162em;font-weight: 100;font-style: normal;">
                    <form action="{{URL('/tracks', ['track' => $track])}}" method="post">
                        <a href="{{route('tracks.edit', ['track'=> $track->id])}}" class="btn btn-secondary" role="button">Edit</a>
                        <input class="btn btn-danger" type="submit" value="Delete">

                        @method('delete')
                        @csrf
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    gpxToJson('{{str_replace('public/gpx', '', $track->gpx)}}');
</script>


@endsection
