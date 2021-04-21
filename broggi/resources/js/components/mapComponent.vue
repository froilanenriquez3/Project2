<template>
    <div class="map-container">
        <div id="mapa-mapbox" style="width: 400px; height: 300px;"></div>
        <div id="geocoder" class="geocoder"></div>
        <button @click="addRecursosToMap()" class="btn btn-primary">ver Recursos</button>
        <div class="color-box bg-primary"></div>
        <span> Recursos disponibles</span>
        <div class="color-box bg-secondary"></div>
        <span> Recursos no disponibles</span>
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
        }
        // recursosInfo:{
        //     required:true
        // }
    },
    data() {
        return {
            key:
                "pk.eyJ1IjoibWlzYWxhOTEiLCJhIjoiY2ttZ2d1MmF0MjdzajJucWxqMTN6ZHR4diJ9.LqNFC2cYXEPAzf8f7PLAVg",
            recursos: [],
            map: {},
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
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
        colorRecurs(recurs) {
            this.color = recurs.actiu ? "#e1157a" : "#11adc4";
        },
        // setInputValue(){
        //     let input= document.getElementsByClassName("mapboxgl-ctrl-geocoder--input")[0];
        //     input.value= direccioCompleta
        // },
        // Para asignar un recurso a la incidencia
        assignarRecurs(){
            this.recurs.actiu = true;
            this.recursActivat= true;
            this.$emit('assignantRecurs', this.recurs);

            this.button.innerHTML = "Ja assignat!";
            this.button.setAttribute('disabled', true);
            this.button.style.backgroundColor = "#fdc619";
            this.button.style.color= "black";

        },
        activarRecurs() {
            this.recurs.actiu = true;
            this.recursActivat= true;
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
                    // me.errorMessage= error.response.data.error;
                });

            this.button.innerHTML = "Desactivar";
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
                    // me.errorMessage= error.response.data.error;
                });

            this.button.innerHTML = "Activar";
            this.button.style.backgroundColor = "#11adc4";
            this.marker._color = "#11adc4";
            this.button.removeEventListener("click", this.desactivarRecurs);
            this.button.addEventListener("click", this.activarRecurs);

            // this.checkIfActive();
        },
        // checkIfActive(){
        //     let buttons= document.querySelectorAll('.marker-button');
        //     console.log(buttons)
        //     if(this.recursActivat){
        //         buttons.forEach(button => {
        //         if( button.dataset['data-id'] != this.recursActivat.id ){
        //             button.setAttribute('disabled', true);
        //         }
        //     });
        //     } else {
        //         buttons.forEach(button => {
        //         if( button.dataset['data-id'] != this.recursActivat.id && button.style.backgroundColor != '#e1157a'){
        //             button.setAttribute('disasbled', false);
        //         }
        //     });
        //     }

        // },
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


                // Marcador
                marker.getElement().addEventListener("click", () => {
                    this.recurs = element;
                    this.marker = marker;
                    this.button = button;
                });
            }
            });
        },
    },
    created() {
        this.selectRecursos();
    },
    mounted() {
        // console.log("Component mounted.");
        mapboxgl.accessToken = this.key;
        this.map = new mapboxgl.Map({
            container: "mapa-mapbox", // container ID
            style: "mapbox://styles/mapbox/streets-v11", // style URL
            center: [1.8676800, 41.8204600], // starting position [lng, lat]
            zoom: 7 // starting zoom
        });


        let geocoder = new MapboxGeocoder({
            accessToken: this.key,
            placeholder: 'Buscar accident',
            zoom: 12,
            marker: {
                color: "#FDC619"
            },
            mapboxgl: mapboxgl

        });

        this.map.addControl(geocoder);
        this.map.addControl(new mapboxgl.NavigationControl());

    // No funciona :(
        this.map.on('load', () =>{
            this.addRecursosToMap;
        })
    },

    // watch: {
    //     direccioCompleta: {
    //         deep:true,
    //         function(val){
    //         this.map.geocoder.setInput(val);
    //     }

    //     }

    // }
};
</script>
