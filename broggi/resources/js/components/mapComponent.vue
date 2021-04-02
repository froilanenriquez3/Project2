<template>
    <div class="map-container">
        <div id="mapa-mapbox" style="width: 400px; height: 300px;"></div>
        <div id="geocoder" class="geocoder"></div>
        <button @click="addRecursosToMap()">ver Recursos</button>
    </div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import MapboxGeocoder from "@mapbox/mapbox-gl-geocoder";
import "@mapbox/mapbox-gl-geocoder/dist/mapbox-gl-geocoder.css";
export default {
    data() {
        return {
            key:
                "pk.eyJ1IjoibWlzYWxhOTEiLCJhIjoiY2ttZ2d1MmF0MjdzajJucWxqMTN6ZHR4diJ9.LqNFC2cYXEPAzf8f7PLAVg",
            recursos: [],
            map: {},
            color: ''
        };
    },
    methods: {
        selectRecursos() {
            let me = this;
            axios
                .get("/recursos")
                .then(response => {
                    me.recursos = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
        colorRecurs(recurs){
            this.color= recurs.actiu ? '#11adc4' : '#e1157a';
        },
        addRecursosToMap(){
            this.recursos.forEach(element => {
                this.colorRecurs(element);
                var marker = new mapboxgl.Marker({
                color: this.color,
                draggable: true
                }).setLngLat([element.lon , element.lat])
                .addTo(this.map);
            });


        //     this.recursos.forEach(recurs => {
        //         console.log('recurs')
        //    new mapboxgl.Marker({
        //         color: "#FFFFFF",
        //         draggable: true
        //         }).setLngLat([recurs.lat, recurs.lon])
        //         .addTo(this.map);
        // });
        }
    },
    created() {
        this.selectRecursos();
    },
    mounted() {
        console.log("Component mounted.");
        mapboxgl.accessToken = this.key;
        this.map = new mapboxgl.Map({
            container: "mapa-mapbox", // container ID
            style: "mapbox://styles/mapbox/streets-v11", // style URL
            center: [2.16992, 41.3879], // starting position [lng, lat]
            zoom: 9 // starting zoom
        });

        var geocoder = new MapboxGeocoder({
            accessToken: this.key,
            marker: {
                color: "orange"
            },
            mapboxgl: mapboxgl
        });

        this.map.addControl(geocoder);

    }
};
</script>
