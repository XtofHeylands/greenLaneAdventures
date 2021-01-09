@extends('layouts.app')

<style>
        .card-header{
        color: #4e6046;}
</style>

@section('content')
<div class="container pt-5">
    <div class="row text-center pb-5">
        <a style="font-size: 20px;"> {{$message}} </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                <div class="card-body">
                    <h6> {{ Auth::user()->name }} </h6>
{{--          TODO          <img src="{{ Auth::user()->profileImage }}" class="card-img" alt="Image missing" style="max-height: 350px; max-width: 350px; object-fit: cover"/>--}}
                    <small class="text-muted">Member since: {{Auth::user()->created_at}}</small>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header">{{ __('Map') }}</div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div id="map" style="height: 500px; width: 700px;"></div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-details-tab" data-toggle="pill" href="#pills-details" role="tab" aria-controls="pills-details" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-pictures-tab" data-toggle="pill" href="#pills-pictures" role="tab" aria-controls="pills-pictures" aria-selected="false">Pictures</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-comments-tab" data-toggle="pill" href="#pills-comments" role="tab" aria-controls="pills-comments" aria-selected="false">Comments</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body" >
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab">
                            <h5 id="pills-detail-title">please select a track on the map</h5>
                            <p id="pills-detail-difficulty"></p>
                            <p id="pills-detail-description"></p>
                            <p id="pills-detail-created"></p>
{{--                            TODO format details--}}
                        </div>
                        <div class="tab-pane fade" id="pills-pictures" role="tabpanel" aria-labelledby="pills-pictures-tab">
                            <img id="pills-image" src="#" alt="Image missing!" style="width: 100%" class="card-img"/>
{{--                         TODO implement image caroussel and the ability to upload images relating to a certain track. General idea is that other uers can upload images of their experiences on the track.--}}
                        </div>
                        <div class="tab-pane fade" id="pills-comments" role="tabpanel" aria-labelledby="pills-comments-tab">
                            work in progress
{{--                         TODO implement comment system--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header">{{ __('Upcoming events') }}</div>
                    <p class="text-center"> Work in progress </p>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>

@if($tracks->isNotEmpty())
    <script type="text/javascript">
        getStarts();
    </script>
@endif

@endsection
