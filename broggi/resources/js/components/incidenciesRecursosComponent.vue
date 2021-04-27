<template>
    <div class="container">
       <!-- div para el mensaje de feedback -->
        <div v-show="infoMessage !=''" class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Info: </strong>
            {{infoMessage}}
            <button type="button" @click="resetMessage()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- fin del div para el mensaje de feedback -->
        <!-- div para el mensaje de error -->
        <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong>Error: </strong>
            {{errorMessage}}
            <button type="button" @click="resetError()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
     	</div>
        <!-- fin del div para el mensaje de error -->
       <div id="incidenciesRecursosDiv" v-show="displayForm">
           <div class="form-group row my-row-header">
                <h5 id="incNumDisp" class="col-2"> Incidencia #{{ incidencia.id}} </h5>
                <span id="validateDisplay" class="col-8" ></span>
                <h5 id="incPrioritatDisp" class="col-2" > Prioritat: {{ infoRecursos.prioritat }} </h5>
           </div>

           <div class="container">

           <div class="form-group row mb-5">
               <label class="col-3" for="activacio">1: Hora Activació</label>
               <input class="col-2 timeIn" type="time" v-model="infoRecursos.hora_activacio" id="activacio" name="activacio"
                @change="validateInput('activacio','mobilitzacio')">
                <span class="col-1"></span>

               <label class="col-3" for="mobilitzacio">2: Hora Mobilització</label>
               <input class="col-2 timeIn" type="time" v-model="infoRecursos.hora_mobilitzacio" id="mobilitzacio" name="mobilitzacio"
                @change="validateInput('activacio','mobilitzacio')">

           </div>

           <div class="form-group row mb-5">

                <label class="col-3" for="assistencia">3: Hora Assistència</label>
               <input class="col-2 timeIn" type="time" v-model="infoRecursos.hora_assistencia" id="assistencia" name="assistencia"
                @change="validateInput('mobilitzacio', 'assistencia')">
                <span class="col-1"></span>

                <label class="col-3" for="transport">4: Hora Transport</label>
               <input class="col-2 timeIn" type="time" v-model="infoRecursos.hora_transport" id="transport" name="transport"
                @change="validateInput('assistencia', 'transport')">

           </div>

           <div class="form-group row mb-5">
                 <label class="col-3" for="arribadaHospital">5: Hora Arribada Hospital</label>
               <input class="col-2 timeIn" type="time" v-model="infoRecursos.hora_arribada_hospital" id="arribadaHospital" name="arribadaHospital"
                @change="validateInput('transport', 'arribadaHospital')">
                <span class="col-1"></span>

                <label class="col-3" for="horaTransferencia">6: Hora Transferencia</label>
               <input class="col-2 timeIn" type="time" v-model="infoRecursos.hora_transferencia" id="horaTransferencia" name="horaTransferencia"
                @change="validateInput('arribadaHospital','horaTransferencia')">
           </div>

           <div class="form-group row mb-5">
                <label class="col-3" for="finalitzacio">7: Hora Finalitzacio</label>
               <input class="col-2 timeIn" type="time" v-model="infoRecursos.hora_finalitzacio" id="finalitzacio" name="finalitzacio"
                @change="validateInput('horaTransferencia', 'finalitzacio')">
                <span class="col-1"></span>


           </div>

           <div class="form-group row">
                <label class="col-2" for="inDesti">Desti</label>
               <input class="col-6" type="text" v-model="infoRecursos.desti" id="inDesti" name="inDesti">
           </div>

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
                infoMessage:'',
                errorMessage:'',
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
                    .put("/incidenciesrecursos/"+me.incidencia.id, me.incidencia)
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
                        me.infoMessage = response.data.message;
                    })
                    .catch((error)=>{
                        me.errorMessage= error.response.data.error;
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
                        me.errorMessage= error.response.data.error;
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
                        //me.infoRecursos = me.incidencia.incidencies_has_recursos;
                        // console.log(me.infoRecursos);
                    })
                    .catch((error) => {
                        me.errorMessage= error.response.data.error;
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
            resetError(){
                this.errorMessage='';
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
            },
            validateInput(id1, id2){
                if(document.getElementById(id1).value > document.getElementById(id2).value){
                    document.getElementById("validateDisplay").innerHTML = "Entrada inválida: " + id1 + ", " + id2;

                    let inputs = Array.from(document.getElementsByClassName('timeIn'));
                    inputs.forEach(element => {
                        if(id2 != element.id && id1 != element.id){
                            element.disabled = true;
                        }
                    });
                } else {
                    document.getElementById("validateDisplay").innerHTML = "";
                    let inputs = Array.from(document.getElementsByClassName('timeIn'));
                    inputs.forEach(element => {
                        if(id2 != element.id && id1 != element.id){
                            element.disabled = false;
                        }
                    });
                }
            },
            resetMessage(){
                this.infoMessage='';
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
<style scoped>
    #validateDisplay{
        color: red;
    }
</style>
