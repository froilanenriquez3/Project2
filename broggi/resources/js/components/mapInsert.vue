<template>
    <div class="map-container" >
        <!-- div para el mensaje de error -->
        <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong>Error: </strong>
            {{errorMessage}}
            <button type="button" @click="resetError()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
     	</div>
        <!-- fin del div para el mensaje de error -->
        <div id="mapa-mapbox" style="width: 960px; height: 300px;"></div>
        <!-- <button @click="addRecursosToMap()" class="btn btn-primary">veure Recursos</button> -->
        <!-- Posición del marcador por defecto si la persona no lo arrastra -->
        <div hidden="true" id="latLongInfo">1.8676800;41.8204600
        </div>
    </div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import MapboxGeocoder from "@mapbox/mapbox-gl-geocoder";
import "@mapbox/mapbox-gl-geocoder/dist/mapbox-gl-geocoder.css";
export default {
    props: {
        action: {
            type: String,
            required: true
        },
        recurs: {
            required: true
        }
    },
    data() {
        return {
            errorMessage:'',
            key:
                "pk.eyJ1IjoibWlzYWxhOTEiLCJhIjoiY2ttZ2d1MmF0MjdzajJucWxqMTN6ZHR4diJ9.LqNFC2cYXEPAzf8f7PLAVg",
            recursos: [],
            map: {},
            color: "#fdc619",
            marker: {},
            button: {},
            recursActivat: false,
            lat:'',
            lon:''
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
                    me.errorMessage= error.response.data.error;
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
        colorRecurs(recurs) {
            this.color = recurs.actiu ? "#e1157a" : "#11adc4";
        },
        addRecursosToMap() {
            this.recursos.forEach(element => {
                if(element.codi != 'cap'){
                this.colorRecurs(element);
                // Div donde irá todo el contenido del popup
                let div= document.createElement('div');
                //Texto dentro de popup
                let p = document.createElement('p');
                p.innerHTML= element.codi + ' - ' + element.recurs;
                // Botón dentro del popup de cada marcador
                let button = document.createElement("button");
                button.classList.add("btn", "btn-primary", "marker-button");
                button.setAttribute('data-id', element.id);
                button.style.backgroundColor = this.color;
                button.innerHTML = "Assignar";
                if (element.actiu) {
                    button.setAttribute("disabled", true);
                }

                button.addEventListener("click", this.assignarRecurs);

                div.appendChild(p)
                div.appendChild(button)
                // Popup
                let popup = new mapboxgl.Popup({ offset: 25 }).setDOMContent(
                   div
                )

                let marker = new mapboxgl.Marker({
                    color: this.color,
                    draggable: false
                })
                    .setLngLat([element.lon, element.lat])
                    .setPopup(popup)
                    .addTo(this.map);
                }
            });
        },
        resetError(){
            this.errorMessage='';
        }

    },
    created() {
        this.selectRecursos();

    },
    mounted() {

        mapboxgl.accessToken = this.key;
        this.map = new mapboxgl.Map({
            container: "mapa-mapbox", // container ID
            style: "mapbox://styles/mapbox/streets-v11", // style URL
            center: [1.8676800, 41.8204600], // starting position [lng, lat]
            zoom: 7 // starting zoom
        });


        this.marker = new mapboxgl.Marker({
                    color: this.color,
                    draggable: true
                })
                    .setLngLat([1.8676800, 41.8204600])
                    .addTo(this.map);

        this.marker.on('dragend', function(e){
            document.getElementById('latLongInfo').innerHTML= e.target._lngLat.lng + ';' + e.target._lngLat.lat;
            console.log(e.target._lngLat);
        });
        this.map.addControl(new mapboxgl.NavigationControl());

    // No funciona :(
        this.map.on('load', () =>{
            this.addRecursosToMap;
        })

          this.map.on('idle', ()=> {
            this.map.resize()
        } );


    },
    watch: {
      	recurs: function(newVal) {
        // Si hay recurso (editar), cogemos el valor del recurso para que el marcador se muestre allí,y también cambiamos el centro del mapa.
          this.marker.setLngLat([newVal.lon, newVal.lat])
          this.map.setCenter([newVal.lon, newVal.lat])
           document.getElementById('latLongInfo').innerHTML= newVal.lon + ';' + newVal.lat;
        }

}
}
</script>
