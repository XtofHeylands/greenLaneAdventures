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
                        <iframe width="600" height="450" frameborder="0" style="border:0"
                                src="https://www.google.com/maps/embed/v1/view?zoom=7&center=50.5039%2C4.4699&key=..." allowfullscreen></iframe>

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active">Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">Pictures</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">Comments</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
{{--                            @yield('home')--}}
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
@endsection
