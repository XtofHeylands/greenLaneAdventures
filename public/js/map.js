// initialization of the map on the home screen to center on the user's current location and
// display markers at the start location of each track

function initMapOverview(starts){

    var mymap = L.map('map');

    navigator.geolocation.getCurrentPosition(function(location) {
        var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

        mymap.setView(latlng, 13);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoieHRvZmgiLCJhIjoiY2tqYTV6b2ZjMWUxNDM0bXRqazJwY2pvMSJ9.ZfY4I769QSutybzGRT6lCQ'
        }).addTo(mymap);

        // custom marker icons
        var normalIcon = L.icon({
            iconUrl: 'http://127.0.0.1:8000/storage/assets/PointIcon.png',
            iconSize: [20, 29],
            iconAnchor: [10, 28],
            popupAnchor: [0, -35]
        })

        //marker at the user's current location
        var marker = L.marker(latlng, {icon:normalIcon}).addTo(mymap);

        marker.bindPopup("<b>Your current location.</b>").openPopup();
    });

    var beginIcon = L.icon({
        iconUrl: 'http://127.0.0.1:8000/storage/assets/startPointIcon.png',
        iconSize: [20, 29],
        iconAnchor: [10, 28],
        popupAnchor: [0, -35]
    })

    //marker at the beginning of each track
    var starts = Object.values(starts);
    starts.forEach(function (element){
        var latlng = new L.LatLng(element.Latitude, element.Longitude);
        var beginPoint = L.marker(latlng, {icon:beginIcon}).addTo(mymap);

        beginPoint.elmId = element.id; // store the id on the marker
        beginPoint.on('click', onClick);
    });

}

//function called when clicking on marker @home
function onClick(e) {
    var id = e.target.elmId;

    var request = {
      id: id
    };

    var url = "api/tracks/select"

    fetch(url,
        {
            method: 'post',
            headers: {'Content-type':'application/json'},
            body: JSON.stringify(request)
        }
    )
        .then(response => response.json())
        .then(json => insertTrackDetails(json));
}

// set the data corresponding to the selected track
// to the details field in the home view
function insertTrackDetails(data){

    var data = Object.values(data);
    var image = data[0].image;
    image = image.replace('public/images', '/storage/images');

    document.getElementById('pills-detail-title').innerText = 'Title: '+ data[0].title;
    document.getElementById('pills-detail-difficulty').innerText = 'Difficulty: '+ data[0].difficulty;
    document.getElementById('pills-detail-description').innerText = 'Description: '+ data[0].description;
    document.getElementById('pills-detail-created').innerText = 'Created at: '+ data[0].created_at ;

    document.getElementById('pills-image').src = image;

    //TODO document.getElementById('pills-comments').innerText = data.description;
}

//drawing of selected track onto the map
function drawTrack(track){

    var track = Object.values(track);
    var latlng = new L.LatLng(track[0].Latitude, track[0].Longitude);

    //center map at the middle of the track
    var mymap = L.map('map').setView(latlng, 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoieHRvZmgiLCJhIjoiY2tqYTV6b2ZjMWUxNDM0bXRqazJwY2pvMSJ9.ZfY4I769QSutybzGRT6lCQ'
    }).addTo(mymap);

    // custom marker icons
    var beginIcon = L.icon({
        iconUrl: 'http://127.0.0.1:8000/storage/assets/startPointIcon.png',
        iconSize: [20, 29],
        iconAnchor: [10, 28],
        popupAnchor: [0, -35]
    })

    var endIcon = L.icon({
        iconUrl: 'http://127.0.0.1:8000/storage/assets/endPointIcon.png',
        iconSize: [20, 29],
        iconAnchor: [10, 28],
        popupAnchor: [0, -35]
    })

    // first add begin and endpoint to the map
    var beginPoint = L.marker([track[0].Latitude, track[0].Longitude], {icon: beginIcon}).addTo(mymap);
    var endPoint = L.marker([track[track.length - 1].Latitude, track[track.length - 1].Longitude], {icon: endIcon}).addTo(mymap);

    beginPoint.bindPopup("<b>Start</b>");
    endPoint.bindPopup("<b>End</b>");

    // second add the polyline between begin and endpoint
    var points = [];

    track.forEach(function (element){
        points.push([element.Latitude, element.Longitude]);
    });

    var polyline = L.polyline(points, {color:'red'}).addTo(mymap);

    // zoom map to fit the polyline and markers
    mymap.fitBounds(polyline.getBounds());
}

// call to python REST service
function gpxToJson(path){
    url = "http://127.0.0.1:5000/convert?path=C:/xampp/htdocs/greenlaneAdventures/public/storage/gpx" + path;
    fetch(url).then(response => {
        console.log(response);
        return response.json()})
                .then(json => JSON.parse(json))
                .then(obj => {return obj})
                .then(fnc => {drawTrack(fnc)});
}

function getStarts(){
    url = "http://127.0.0.1:5000/start?path=C:/xampp/htdocs/greenlaneAdventures/public/storage/gpx";
    fetch(url).then(response => {
        console.log(response);
        return response.json()})
        .then(json => JSON.parse(json))
        .then(obj => {return obj})
        .then(fnc => {initMapOverview(fnc)});
}
