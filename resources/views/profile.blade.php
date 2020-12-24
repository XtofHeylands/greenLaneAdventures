@extends('layouts.app')

@section('content')

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <style>
        .userinfo{
        background-color: #4e6046;
        color: white;
        padding: 30px;
        }
        .profilepic{
        background-color: #4e6046;
        color: white;
        }
        .routes{
        border: 2px solid #4e6046;
        padding: 10px;
        }

        h2{text-align: center;}
	</style>

  </head>
  <body>

      <div class ="container">
          <div class ="row">

              <div class="col-4">
                  <div class="profilepic">
{{--                    <img src="{{$user->foto}}"/>--}}
                  </div>
              </div>

              <div class="col-8">
                  <div class="userinfo">
                    <div class="settings">
                        <div class="float-right">
                            <button type="button" class="btn btn-light">Settings 
                        </button>
                        </div>                                           
                    </div>
                    <h2> {{ Auth::user()->name }} </h2>
                    <h3> About </h3>
                  </div>
{{--                    <p> {{$user->bio}}  </p>--}}
                  </div>

              </div>
          </div>

          <div class ="row">
              <div class ="routes">
                <h2 style = "color:#4e6046;"> Routes </h2>
                @yield("tracks")
              </div>
          </div>
      </div>
  </body>

</html>

@endsection
