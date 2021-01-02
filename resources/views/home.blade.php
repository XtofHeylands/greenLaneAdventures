@extends('layouts.app')

<style>
        .card-header{
        color: #4e6046;}
</style>

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                <div class="card-body">
                    <h6> {{ Auth::user()->name }} </h6>
                    <img src="{{ Auth::user()->profileImage }}" class="card-img" alt="Image missing" style="max-height: 350px; max-width: 350px; object-fit: cover"/>
                    <small class="text-muted">Member since: {{Auth::user()->created_at}}</small>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header">{{ __('Map') }}</div>

                <div class="card-body">
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
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        </div>
                        <div class="tab-pane fade" id="pills-pictures" role="tabpanel" aria-labelledby="pills-pictures-tab">
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
{{--                          TODO implement image caroussel and the ability to upload images relating to a certain track. General idea is that other uers can upload images of their experiences on the track.--}}
                        </div>
                        <div class="tab-pane fade" id="pills-comments" role="tabpanel" aria-labelledby="pills-comments-tab">
                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
{{--                         TODO implement comment system with json--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header">{{ __('Upcoming events') }}</div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>

<script>initMapOverview();</script>

@endsection
