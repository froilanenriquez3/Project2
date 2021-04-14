<template>
    <div class="container">
       <div id="incidenciesRecursosDiv" v-show="displayForm">
           <p id="incNumDisp"> </p>
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

           <!-- <button class="btn btn-primary" id="submitForm" @click="submitForm()">Siguiente</button> -->

       </div>

       <div v-show="!displayForm">
           <p>No hi ha cap incident assignat</p>
       </div>
    </div>
</template>

<script>
    export default {
        props : {
            userrecursoid: {
                required: true,
                type: Number

            }
        },
        data(){
            return {
                displayForm: false,
                incidencies: [],
                incidenciesRecursos: [],
                incidenciaId: null,
                afectatId: null,
                incidencia: null,
                infoRecursos: {
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
                    .get("/incidenciesrecursos")
                    .then((response) => {
                    // console.log(response.data);
                    me.incidencies = response.data;
                    me.getAllShowIncidencies();
                    })
                    .catch((error) => {
                    console.log(error);
                    })
                    .finally(() => (this.loading = false));

            },
            showIncidenciaRecurso(id){
                let me = this;
                axios
                    .get("/incidencies/" + id)
                    .then((response) => {
                    console.log(response.data);
                    me.incidencia = response.data;
                    me.incidenciesRecursos.push(me.incidencia);
                        me.findActiveIncidencia();
                    // me.infoRecursos = me.incidencia.incidencies_has_recursos;
                    // console.log(me.infoRecursos);
                    })
                    .catch((error) => {
                    console.log(error);
                    })
                    .finally(() => {
                        this.loading = false;
                        console.log(me.incidencia);
                    });

            },
            findActiveIncidencia(){
                let me = this;
                console.log("Searching for incidencias");
                // me.incidenciesRecursos.reverse();
                for(let i in me.incidenciesRecursos){

                    for(let j in me.incidenciesRecursos[i].incidencies_has_recursos){
                        console.log("Incidencia recurso id:" + me.incidenciesRecursos[i].id);

                        if((me.incidenciesRecursos[i].incidencies_has_recursos[j].recursos_id == me.userrecursoid )
                            && (me.incidenciesRecursos[i].incidencies_has_recursos[j].hora_finalitzacio == null)
                        ){
                            me.incidencia = me.incidenciesRecursos[i];
                            document.getElementById("incNumDisp").innerHTML = "Incidencia #" + me.incidencia.id;
                            this.displayForm = true;
                            console.log("FOUND!");
                        }
                    }
                }

            },
            getAllShowIncidencies(){
                for(let i in this.incidencies){
                    this.showIncidenciaRecurso(this.incidencies[i].id);
                }
                //  console.log(this.incidenciesRecursos);

            }
        },
        mounted() {
            console.log('Component mounted.')
            console.log(this.userrecursoid);
            this.selectIncidencies();
             document.getElementById("formSubmit").onclick = function () {
                this.submitForm();
            };
        }
    }
</script>
