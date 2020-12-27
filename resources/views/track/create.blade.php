@extends('layouts.app')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

@section('content')



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card" style="max-width: 70%">
            <div class="card-header">{{ __('New track') }}</div>
            <div class="card-body">
                <form method="post" action="{{route('track.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <label for="title">Title</label>
                        </div>

                        <input id="title" type="text" name="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label for="description">Description</label>
                        </div>

                        <input type="text" name="description" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label>Difficulty</label>
                        </div>

                        <div class="row justify-content-center">
                            <div id="difficulty" class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-success active">
                                    <input type="radio" name="difficulty" id="easy" autocomplete="off" checked onclick="setDifficulty('easy')"> easy
                                </label>
                                <label class="btn btn-warning active">
                                    <input type="radio" name="difficulty" id="medium" autocomplete="off" checked> medium
                                </label>
                                <label class="btn btn-danger active">
                                    <input type="radio" name="difficulty" id="hard" autocomplete="off" checked> hard
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gpx">Choose gpx file</label>
                        <input type="file" name="gpx" class="form-control" onchange="previewImage(this)">
                    </div>

                    <div class="form-group">
                        <label for="image">Choose image file</label>
                        <input type="file" name="image" class="form-control" id="image">
                        <img id="previewImage" alt="Track image" style="max-width: 100%; margin-top: 20px"/>
                    </div>



                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">

    $(document).ready(function (e) {
        $('#image').change(function (){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#previewImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>

@endsection


{{--TODO create form layout ot ad a track--}}
