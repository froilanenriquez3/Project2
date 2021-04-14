<template>
    <div class="container">
       <div id="incidenciesRecursosDiv" v-show="displayForm">
           <div class="form-group row">
               <label class="col-2" for="">1: Hora Activacio</label>
               <input class="col-2" type="time">

               <label class="col-2" for="">2: Hora Mobilitzacio</label>
               <input class="col-2" type="time" >

               <label class="col-2" for="">3: Hora Assistencia</label>
               <input class="col-2" type="time">


           </div>

           <div class="form-group row">

                <label class="col-2" for="">4: Hora Transport</label>
               <input class="col-2" type="time">

                <label class="col-2" for="">5: Hora Arribada Hospital</label>
               <input class="col-2" type="time">

                <label class="col-2" for="">6: Hora Transferencia</label>
               <input class="col-2" type="time">



           </div>

           <div class="form-group row">
                 <label class="col-2" for="">7: Hora Finalitzacio</label>
               <input class="col-2" type="time">

                <label class="col-2" for="">Desti</label>
               <input class="col-6" type="text">
           </div>

           <button class="btn btn-primary" id="submitForm" @click="submitForm()">Siguiente</button>

       </div>

       <div v-show="!displayForm">
           <p>No hi ha cap incident assignat</p>
       </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                displayForm: true,
                incidenciesRecursos: [],
                incidenciaId: null,
                afectatId: null,
                incidencia: {
                    incidenciaId: null,
                    activacio: null,
                    mobilitzacio: null,
                    assistencia: null,
                    transport: null,
                    arribadaHospital: null,
                    transferencia: null,
                    finalitzacio: null,
                    prioritat: null,
                    desti: null,
                    afectatId:null
                }
            }
        },
        methods : {
            submitForm(){
                console.log("Submitting form");
                let me = this;
                axios
                    .post("/incidenciesRecusos", me.incidencia)
                    .then((response)=>{
                        console.log(response);

                    })
                    .catch((error)=>{
                        console.log(error.response.status);
                        console.log(error.response.data);

                    })
            },
            selectIncidencies(){
                let me = this;
                axios
                    .get("/incidencies")
                    .then((response) => {
                    console.log(response.data);
                    me.incidencies = response.data;
                    })
                    .catch((error) => {
                    console.log(error);
                    })
                    .finally(() => (this.loading = false));

            },
            selectIncidenciesRecursos(){

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
