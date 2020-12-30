// initialization of the map on the home screen to center on the user's current location and
// display markers at the start location of each track

function initMapOverview(){
    navigator.geolocation.getCurrentPosition(function(location) {
        var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

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
        var normalIcon = L.icon({
            iconUrl: './images/PointIcon.png',
            iconSize: [20, 29],
            iconAnchor: [10, 28],
            popupAnchor: [0, -35]
        })

        var beginIcon = L.icon({
            iconUrl: './images/startPointIcon.png',
            iconSize: [20, 29],
            iconAnchor: [10, 28],
            popupAnchor: [10, -20]
        })

        //marker at the user's current location
        var marker = L.marker(latlng, {icon:normalIcon}).addTo(mymap);

        //marker at the beginning of each track
        // tracks.forEach(function (track){
        //     var beginPoint = L.marker([track[0].latitude, track[0].longitude], {icon: beginIcon}).addTo(mymap);
        // })

        //TODO create beginmarker for each track in different color

        marker.bindPopup("<b>Your current location.</b>").openPopup();
    });
}

// initialization of the map that shows a detailed view of a certain track
function initMapDetail(){

}

// function called when track is added to ad beginpoint to the list
function addTrack(){

}

// function called when track is removed to remove beginpoint from the list
function removeTrack(){

}

// call to python REST service
function gpxToJson(){
    file = document.getElementById(file)
    url = "http://127.0.0.1:5000/gpx/" + file;
    fetch(url).then(response => json = response.json());
    return JSON.parse(json);
}

//drawing of selected track onto the map
function drawTrack(track, map){

    // custom marker icons
    var beginIcon = L.icon({
        iconUrl: './images/startPointIcon.png',
        iconSize: [20, 29],
        iconAnchor: [10, 28],
        popupAnchor: [10, -20]
    })

    var endIcon = L.icon({
        iconUrl: './images/endPointIcon.png',
        iconSize: [20, 29],
        iconAnchor: [10, 28],
        popupAnchor: [10, -20]
    })

    // first add begin and endpoint to the map
    var beginPoint = L.marker([track[0].latitude, track[0].longitude], {icon: beginIcon}).addTo(map);
    var endPoint = L.marker([track[track.length - 1].latitude, track[track.length - 1].longitude], {icon: endIcon}).addTo(map);

    beginPoint.bindPopup("<b>Start</b>");
    endPoint.bindPopup("<b>End</b>");

    // second add the polyline between begin and endpoint
    var points = [track.latitude, track.longitude];
    var polyline = L.polyline(points, {color:'red'}).addTo(map);

    // zoom map to fit the polyline and markers
    map.fitBounds(polyline.getBounds());
}
