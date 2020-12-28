import 'ol/ol.css';
import {Map, View} from 'ol';
import TileLayer from 'ol/layer/Tile';
import OSM from 'ol/source/OSM';

var my_map = {                       // <-- add this line to declare the object
    display: function () {           // <-- add this line to declare a method

        const map = new Map({
            target: 'osm_map',
            layers: [
                new TileLayer({
                    source: new OSM()
                })
            ],
            view: new View({
                center: [0, 0],
                zoom: 0
            })
        });

    }                                // <-- close the method
};                                   // <-- close the object
export default my_map;               // <-- and export the object
