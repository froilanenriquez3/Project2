<template>
    <div class="container">
       <div id="incidenciesRecursosDiv" v-show="displayForm">
           <div class="form-group row">
                <p id="incNumDisp" class="col-2"> Incidencia #{{ incidencia.id}} </p>
                <span class="col-8"></span>
                <p id="incPrioritatDisp" class="col-2" > Prioritat: {{ infoRecursos.prioritat }} </p>
           </div>

           <div class="form-group row">
               <label class="col-2" for="inActivacio">1: Hora Activació</label>
               <input class="col-2" type="time" v-model="infoRecursos.hora_activacio" id="inActivacio" name="inActivacio">

               <label class="col-2" for="inMobilitzacio">2: Hora Mobilització</label>
               <input class="col-2" type="time" v-model="infoRecursos.hora_mobilitzacio" id="inMobilitzacio" name="inMobilitzacio">

               <label class="col-2" for="inAssistencia">3: Hora Assistència</label>
               <input class="col-2" type="time" v-model="infoRecursos.hora_assistencia" id="inAssistencia" name="inAssistencia">


           </div>

           <div class="form-group row">

                <label class="col-2" for="inTransport">4: Hora Transport</label>
               <input class="col-2" type="time" v-model="infoRecursos.hora_transport" id="inTransport" name="inTransport">

                <label class="col-2" for="inArribadaHospital">5: Hora Arribada Hospital</label>
               <input class="col-2" type="time" v-model="infoRecursos.hora_arribada_hospital" id="inArribadaHospital" name="inArribadaHospital">

                <label class="col-2" for="inHoraTransferencia">6: Hora Transferencia</label>
               <input class="col-2" type="time" v-model="infoRecursos.hora_transferencia" id="inHoraTransferencia" name="inHoraTransferencia">

           </div>

           <div class="form-group row">
                 <label class="col-2" for="inFinalitzacio">7: Hora Finalitzacio</label>
               <input class="col-2" type="time" v-model="infoRecursos.hora_finalitzacio" id="inFinalitzacio" name="inFinalitzacio">

                <label class="col-2" for="inDesti">Desti</label>
               <input class="col-6" type="text" v-model="infoRecursos.desti" id="inDesti" name="inDesti">
           </div>

           <!-- <button class="btn btn-primary" id="submitForm" @click="submitForm()">Siguiente</button> -->

       </div>

       <div v-show="!displayForm">
           <p>No hi ha cap incidència assignada</p>
       </div>
    </div>
</template>

<script>
    export default {
        props : {
            userrecursoid: {
                required: true,
                type: Number

            },
            editincidencia:{
                required: false
            }
        },
        data(){
            return {
                displayForm: false,
                incidencies: [],
                incidenciesRecursos: [],
                arrayPos: null,
                incidenciaId: null,
                afectatId: null,
                incidencia: {
                    id: null
                },
                infoRecursos: {
                    incidencies_id: null,
                    hora_activacio: null,
                    hora_mobilitzacio: null,
                    hora_assistencia: null,
                    hora_transport: null,
                    hora_arribada_hospital: null,
                    hora_transferencia: null,
                    hora_finalitzacio: null,
                    prioritat: null,
                    desti: null,
                    afectat_id:null,
                    recursos_id: null
                },
                highestPrioritat: 0
            }
        },
        methods : {
            submitForm(){
                let me = this;
                // me.infoRecursos.hora_transport = "12:00:01";
                me.incidencia.incidencies_has_recursos[me.arrayPos] = me.infoRecursos;
                me.incidencia.saveRecurs = me.infoRecursos.recursos_id;
                console.log("Save recurs:" + me.incidencia.saveRecurs);

                axios
                    .put("/incidencies/"+me.incidencia.id, me.incidencia)
                    .then((response)=>{
                        alert("Formulari enviat correctament");
                        console.log(response);
                        me.incidencia = null;
                        me.infoRecursos = {
                            incidencies_id: null,
                            hora_activacio: null,
                            hora_mobilitzacio: null,
                            hora_assistencia: null,
                            hora_transport: null,
                            hora_arribada_hospital: null,
                            hora_transferencia: null,
                            hora_finalitzacio: null,
                            prioritat: null,
                            desti: null,
                            afectat_id: null,
                            recursos_id: null
                        }
                         window.location.href = "/Project2/broggi/public/incidenciesrecursos";
                    })
                    .catch((error)=>{
                         console.log(error);
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
                    // console.log(response.data);
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
                        // console.log(me.incidencia);
                    });

            },
            findActiveIncidencia(){
                let me = this;
                console.log("Searching for incidencias");
                // me.incidenciesRecursos.reverse();
                for(let i in me.incidenciesRecursos){

                    for(let j in me.incidenciesRecursos[i].incidencies_has_recursos){
                        // console.log("Incidencia recurso id:" + me.incidenciesRecursos[i].id);

                        if((me.incidenciesRecursos[i].incidencies_has_recursos[j].recursos_id == me.userrecursoid )
                            && (me.incidenciesRecursos[i].incidencies_has_recursos[j].hora_finalitzacio == null)
                            && (me.incidenciesRecursos[i].incidencies_has_recursos[j].prioritat >= me.highestPrioritat)
                        ){
                            me.incidencia = me.incidenciesRecursos[i];
                            me.infoRecursos = me.incidenciesRecursos[i].incidencies_has_recursos[j];
                            me.arrayPos = j;
                            me.highestPrioritat = me.incidenciesRecursos[i].incidencies_has_recursos[j].prioritat;
                            // document.getElementById("incNumDisp").innerHTML = "Incidencia #" + me.incidencia.id;
                            // document.getElementById("incPrioritatDisp").innerHTML = "Prioritat: " + me.infoRecursos.prioritat;
                            me.displayForm = true;
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

            },
            initEditIncidencia(){
                console.log("init edit incidencia");
                this.incidencia = this.editincidencia;
                this.incidenciesRecursos = this.incidencia.incidencies_has_recursos;

                let found = false;
                let i = 0;
                while(i < this.incidenciesRecursos.length && !found){
                    if(this.incidenciesRecursos[i].recursos_id == this.userrecursoid){
                        this.infoRecursos = this.incidenciesRecursos[i];
                        this.displayForm = true;
                        found = true
                    }
                    i++;
                }
            }
        },
        mounted() {
            // console.log('Component mounted.')
            // console.log(this.userrecursoid);
            if(this.editincidencia == null) this.selectIncidencies();
            else this.initEditIncidencia();
            let me = this;
             document.getElementById("formSubmit").onclick = function () {
                me.submitForm();
            };
        }
    }
</script>
