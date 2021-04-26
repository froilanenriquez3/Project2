<template>
    <div class="map-container">

        <!-- div para el mensaje de error -->
        <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong>Error: </strong>
            {{errorMessage}}
            <button type="button" @click="resetError()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
     	</div>
        <!-- fin del div para el mensaje de error -->

        <div class="color-box bg-primary"></div>
        <span> Recursos disponibles</span>
        <div class="color-box bg-secondary"></div>
        <span> Recursos no disponibles</span>
        <div id="mapa-mapbox"></div>
        <div id="geocoder" class="geocoder"></div>
    </div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import MapboxGeocoder from "@mapbox/mapbox-gl-geocoder";
import "@mapbox/mapbox-gl-geocoder/dist/mapbox-gl-geocoder.css";
export default {
    props: {
        direccioCompleta: {
            type: String,
            required: true
        },
        recursPerCanviar: {
            required: true
        },
    },
    data() {
        return {
            errorMessage:'',
            key:
                "pk.eyJ1IjoibWlzYWxhOTEiLCJhIjoiY2ttZ2d1MmF0MjdzajJucWxqMTN6ZHR4diJ9.LqNFC2cYXEPAzf8f7PLAVg",
            recursos: [],
            map: {},
            allMarkers: [],
            geocoder: {},
            color: "",
            recurs: {
                /* id: 12,
                codi: "ghost",
                actiu: true,
                tipus_recursos_id: 1,
                lat: 50,
                lon: 1 */
            },
            marker: {},
            button: {},
            recursActivat: false
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
        activarRecurs() {
            this.recurs.actiu = true;
            this.recursActivat= true;
             this.$emit('assignantRecurs', this.recurs);
            console.log(this.marker)
            let me = this;
            axios
                .put("/recursos/" + me.recurs.id, me.recurs)
                .then(function(response) {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error.response.status);
                    console.log(error.response.data);
                    me.errorMessage= error.response.data.error;
                });

            this.button.innerHTML = "Desassignar";
            this.button.style.backgroundColor = "#fdc619";
            this.marker.color = "#FDC619";
            this.button.removeEventListener("click", this.activarRecurs);
            this.button.addEventListener("click", this.desactivarRecurs);


            // this.checkIfActive();
        },
        // Por si la persona se equivoca y quiere cambiar de recurso seleccionado
        desactivarRecurs() {
            this.recurs.actiu = false;
            this.recursActivat= false;
            this.$emit('desassignantRecurs', this.recurs);
            console.log(this.marker)
            let me = this;
            axios
                .put("/recursos/" + me.recurs.id, me.recurs)
                .then(function(response) {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error.response.status);
                    console.log(error.response.data);
                    me.errorMessage= error.response.data.error;
                });

            this.button.innerHTML = "Assignar";
            this.button.style.backgroundColor = "#11adc4";
            this.marker._color = "#11adc4";
            this.button.removeEventListener("click", this.desactivarRecurs);
            this.button.addEventListener("click", this.activarRecurs);

            // this.checkIfActive();
        },
        desactivarRecursSenseEmetre(){
            this.recurs.actiu = false;
            this.recursActivat= false;
            let me = this;
            axios
                .put("/recursos/" + me.recurs.id, me.recurs)
                .then(function(response) {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error.response.status);
                    console.log(error.response.data);
                    me.errorMessage= error.response.data.error;
                });

            this.marker.button.innerHTML = "Assignar";
            this.marker.button.style.backgroundColor = "#11adc4";
            this.marker._color = "#11adc4";
            this.marker.button.removeEventListener("click", this.desactivarRecurs);
            this.marker.button.addEventListener("click", this.activarRecurs);
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

                button.addEventListener("click", this.activarRecurs);


                    div.appendChild(p)
                    div.appendChild(button)

                // Popup
                let popup = new mapboxgl.Popup({ offset: 25 }).setDOMContent(
                   div
                )

                let marker = new mapboxgl.Marker({
                    color: this.color,
                    draggable: false,
                })
                    .setLngLat([element.lon, element.lat])
                    .setPopup(popup)
                    .addTo(this.map);

                // Marcador
                marker.getElement().addEventListener("click", () => {
                    this.recurs = element;
                    this.marker = marker;
                    this.button = button;
                });

                this.allMarkers.push(
                    {'marker': marker,
                    'id': element.id,
                    'button': button
                    }
                )
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
        // console.log("Map Component mounted.");
        mapboxgl.accessToken = this.key;
        this.map = new mapboxgl.Map({
            container: "mapa-mapbox", // container ID
            style: "mapbox://styles/mapbox/streets-v11?optimize=true", // style URL
            center: [1.8676800, 41.8204600], // starting position [lng, lat]
            zoom: 7,
            trackResize: true
        });


        this.geocoder = new MapboxGeocoder({
            accessToken: this.key,
            placeholder: 'Buscar accident',
            countries: 'es',
            zoom: 12,
            marker: {
                color: "#FDC619"
            },
            mapboxgl: mapboxgl


        });

        this.map.addControl(this.geocoder);
        this.map.addControl(new mapboxgl.NavigationControl());

       this.map.on('load', () =>{
            this.addRecursosToMap();
            this.map.resize();
        })


        this.map.on('idle', ()=> {
            this.map.resize()
        } );

    },

    watch: {

        recursPerCanviar: function(val){
            // Buscamos el marcador que hemos de cambiar
            this.marker= this.allMarkers.find( marker => marker.id == val.recursos_id);

            // Buscamos el recurso a desactivar
            this.recurs= this.recursos.find( recurs => recurs.id == val.recursos_id);

            // No emitimos que se ha desasignado al padre ya que se ha borrado desde allí de una de estas formas:
            // o se ha apretado 'no cal recurs' cuando ya se había asignado uno anterior.
            // o se ha asignado un recurso distinto cuando ya había uno asignado a esa persona.
            this.desactivarRecursSenseEmetre();
        }


    }
};
</script>

