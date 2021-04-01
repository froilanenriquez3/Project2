<template>
    <div id='mapa-mapbox' style='width: 400px; height: 300px;'></div>
    <!-- <div id="geocoder" class="geocoder"></div> -->
</template>

<script>
export default {
    data() {
        return {
            key:
                "pk.eyJ1IjoibWlzYWxhOTEiLCJhIjoiY2ttZ2d1MmF0MjdzajJucWxqMTN6ZHR4diJ9.LqNFC2cYXEPAzf8f7PLAVg",
            recursos: [],

        }
    },
    created() {
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
    mounted() {
        console.log("Component mounted.");
        mapboxgl.accessToken = this.key;
        this.mapa = new mapboxgl.Map({
            container: "mapa-mapbox",
            style: "mapbox://styles/mapbox/streets-v11", // style URL
            center: [2.16992, 41.3879], // starting position [lng, lat]
            zoom: 11 // starting zoom
        });
    }
};
</script>
