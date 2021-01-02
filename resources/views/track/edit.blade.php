@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card p-0" style="max-width: 70%">
            <div class="card-header">{{ __('Edit existing track') }}</div>
            <div class="card-body">
                <form method="post" action={{URL('/tracks', ['track' => $track])}} enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="Patch">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <label for="title">Title</label>
                        </div>
                        <input id="title" type="text" name="title" class="form-control" value={{$track->title}}>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label for="description">Description</label>
                        </div>
                        <input type="text" name="description" class="form-control" value={{$track->description}}>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label>Difficulty</label>
                        </div>

                        <div class="row justify-content-center">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-success">
                                    <input type="radio" name="difficulty" value="easy" id="diff_easy">
                                    easy
                                </label>
                                <label class="btn btn-warning">
                                    <input type="radio" name="difficulty" value="medium" id="diff_medium">
                                    medium
                                </label>
                                <label class="btn btn-danger">
                                    <input type="radio" name="difficulty" value="hard" id="diff_hard">
                                    hard
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gpx">Choose gpx file <small class="text-muted">(Leave empty to keep unchanged)</small></label>
                        <input type="file" name="gpx" class="form-control" id="gpx">
                    </div>

                    <div class="form-group">
                        <label for="image">Choose image file <small class="text-muted">(Leave empty to keep unchanged)</small></label>
                        <input type="file" name="image" class="form-control" id="image">
                        <img id="previewImage" style="max-width: 100%; margin-top: 20px"/>
                    </div>

                    <button type="submit" name="submitted" class="btn btn-primary">Submit</button>
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

<script type="text/javascript">
    switch ({{$track->difficulty}}){
        case 'easy':
            $('#diff_easy').checked(true);
            break;
        case 'medium':
            $('#diff_medium').checked(true);
            break;
        case 'hard':
            $('#diff_hard').checked(true);
            break;
    }
</script>

@endsection

