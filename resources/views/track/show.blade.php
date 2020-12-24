
@section('track')
    <div style="float:left">
        <h3>{{$track->title}}</h3>
        <p>{{$track->created_at}}</p>
        <p>{{$track->difficulty}}</p>
        <img src="" alt="Image missing" />
        <p>{{$track->description}}</p>
    </div>
@endsection
