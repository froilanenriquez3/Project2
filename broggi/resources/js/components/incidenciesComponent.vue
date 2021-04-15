<template>
<div class="biggerContainer">

    <div id="divModoFormacion">
        <button class="btn btn-primary" @click="openModalVideo()" v-bind:class="{ hidden: !formacio }">Veure video CPR</button>
    <button class="btn btn-primary" @click="openModalHelp()" v-bind:class="{ hidden: !formacio }">Ajuda amb l'anglès</button>
    <div class="formacionBox">
    <p>Modo formacion</p>
            <label class="switch" id="btnModoFormacion">
                <input @click="toggleFormacio()" type="checkbox">
                <span class="slider round"></span>
            </label>
            </div>
        </div>
  <div class="container" >

        <!-- TAG INCIDENCIAS -->
        <div v-show="section == 'Incident'">
        <div class="form-group row">
      <label class="col-2" for="">Tipus Incidencia</label>
      <select class="col-10" name="tipus_incidencia" v-model="incidencia.tipus_incidencies_id">
        <option v-for="tipo in tipusIncidencies" :key="tipo.id" v-bind:value="tipo.id">
          {{ tipo.tipus }}
        </option>
      </select>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Adreça</label>
      <input class="col-10" type="tel" name="" v-model="incidencia.adreca" />
    </div>
    <div class="form-group row">
      <label class="col-2" for="">Adreça Complement</label>
      <input
        class="col-10"
        type="tel"
        name=""
        v-model="incidencia.adreca_complement"
      />
    </div>
    <div class="form-group row">
      <label class="col-2" for="">Municipi</label>
      <select class="col-10" name="" id="" v-model="incidencia.municipis_id">
        <option value=""></option>
        <option v-for="(municipi, index) in municipis" :key="index" v-bind:value="municipi.id">
          {{ municipi.nom }}
        </option>
      </select>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Hora</label>
      <input class="col-2" type="time" name="" v-model="incidencia.hora" />

      <label class="col-2" for="">Data</label>
      <input class="col-2" type="date" name="" v-model="incidencia.data" />
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Descripcio</label>
      <textarea class="col-10" type="" name="" v-model="incidencia.descripcio">
      </textarea>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Nom Metge</label>
      <input class="col-10" type="tel" name="" v-model="incidencia.nom_metge" />
    </div>
    </div>

    <!-- TAG ALERTANTE -->
    <alertant-form :municipis="municipis" :alertant="alertantIncidencia" :section="section" v-show="section == 'Alertant'"></alertant-form>

    <!-- TAG AFECTADO -->
    <!-- add fa plus icon -->
    <div v-show="section == 'Afectats' ">

       <!--  <button @click="notMultiple()" class="btn btn-secondary">Menys de 3 afectats</button>
        <button @click="isMultiple()" class="btn btn-secondary">Múltiples afectats (+3)</button> -->
       <span>Menys de 3 afectats</span>
        <label class="switch" id="btnNumAfectats">
                <input type="checkbox" @click="toggleMultiple()">
                <span class="slider round"></span>
            </label>
        <span>Múltiples afectats (+3)</span>

        <div v-show="multiple == false">
             <button @click="nouAfectat()" class="btn btn-warning">Nou Afectat</button>
             <div  ref="afectatsContainer"></div>
        </div>


        <div v-show="multiple == true" >
            <div class="form-group row">
    <label for="multiplesAfectats">Descripció afectats</label>
    <textarea v-model="multiplesAfectatsText"
    placeholder="Indica el sexe dels alertants i el rang d'edats aproximat"
     class="form-control" id="multiplesAfectats" rows="3"></textarea>
            </div>

        </div>

    </div>



    <!-- TAG RECURSOS -->
    <div v-show="section == 'Recursos'" id="recursosPage">
        <map-component @assignantRecurs="setRecursFromMap($event)" :direccioCompleta="direccio"></map-component>
        <div id="recursosAfectats">
            <ul>Clica sobre una persona per assignar-li un recurs
                <li class="row">
                    <p class="col-6">Afectats</p>
                    <p class="col-4">Recursos</p>
                </li>

                <li v-for="(afectat, index) in afectats" :key="index" class="row">

                    <button :id="'btnAfectat' + afectat.id" v-bind:class="{ afectatActiu: afectat.id == afectatActiu}" @click="setAfectatActual(afectat)" class="btn btn-outline-primary col-6" >{{ afectat.nom + " " + afectat.cognoms }}</button>
                    <div v-if="afectat.id == afectatActiu && (infoRecursos[afectat.id] == undefined)" class="col-4" >
                        El recurs que marquis al mapa serà assignat a aquesta persona
                    </div>

                    <div  v-show="(infoRecursos[afectat.id] != undefined)" :id="'afectat' + afectat.id" class="col-4" ></div>


                    <!-- <select :name="'recursos'+ index" :id="'recursosToAssign' + index" class="col-4" @change="assignRecurs(index, afectat.id)">
                        <option value=""></option>
                        <option :value="recurso.id" v-for="(recurso, index) in freeRecursos" :key="index">
                            <p >{{recurso.codi}}</p>
                        </option>
                    </select> -->
                    <!-- <button>Assignar recurs</button> -->
                </li>
            </ul>

        </div>

    </div>



    <!-- Modal Video -->
        <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="modalVideolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalVideolLabel">Vídeo CPR</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalText" class="modal-body">
            <video-component></video-component>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalHelpbox" tabindex="-1" role="dialog" aria-labelledby="modalVideolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalVideolLabel">HelpBox</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalText" class="modal-body">
            <help-box-component></help-box-component>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>


    <button class="btn btn-primary mt-2" @click="afegirIncidencia()" id="btnAddIncidencia">
      Afegir incidencia
    </button>




  </div>
</div>
</template>

<script>
import alertantFormComponent from "./alertantFormComponent.vue";
import afectatFormComponent from "./afectatFormComponent.vue";
import mapComponent from './mapComponent.vue';
import HelpBoxComponent from './helpBoxComponent.vue';
import Vue from 'vue';
export default {
  components: { mapComponent, HelpBoxComponent },
    props: {
        //Sección que se tiene que mostrar
        section: {
            type: String,
            required: true
        }
    },
  data() {
    return {
    formacio: false,
      tipusAlertants: [],
      tipusIncidencies: [],
      alertantIncidencia: {},
      numAfectats: 0,
      afectats: [],
      recursos: [],
      freeRecursos: [],
      infoRecursos: [],
      municipi: {},
      municipis: [],
      multiple: false,
      multiplesAfectatsText: '',
        afectatActiu: 0,
      afectatFormComponent,
      alertantFormComponent,
      incidencia: {
        data: null,
        hora: null,
        telefon_alertant: 123456789,
        adreca: null,
        adreca_complement: null,
        descripcio: null,
        nom_metge: null,
        tipus_incidencies_id: 1,
        alertants_id: 1,
        municipis_id: 1,
        duracion: null,
        infoRecursos: []
      },
      incidencies: [],
    };
  },
  methods: {
    getIncidencies() {
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
    setRecursFromMap(recurs){
        // debugger;
        // Aquí el id del afectado aún es el que tiene en la array! Lo substituiremos al añadir la incidencia.
        let infoRecurs = {
            recursos_id: recurs.id,
            hora_activacio: null,
            hora_mobilitzacio: null,
            hora_assistencia: null,
            hora_transport: null,
            hora_arribada_hospital: null,
            hora_transferencia: null,
            hora_finalitzacio: null,
            prioritat: null,
            desti: null,
            afectat_id: this.afectatActiu
        };
        // Los ponemos en el mismo orden que los afectados para ahorrarnos problemas.
        this.infoRecursos[this.afectatActiu]= infoRecurs;
        this.incidencia.infoRecursos = this.infoRecursos;
        // Hacemos que se muestre el recurso seleccionado en el tipo de recurso.
        document.getElementById('afectat' + this.afectatActiu).innerHTML= recurs.codi;
        console.log("btnAfectat"+this.afectatActiu);
        document.getElementById("btnAfectat"+this.afectatActiu).setAttribute("disabled", true);
    },
    createIncidencia() {
      console.log("submitting incidencia");
      console.log(this.incidencia);
      let me = this;
      axios
        .post("/incidencies", me.incidencia)
        .then(function (response) {
         alert("Formulari enviat correctament");

          console.log(response);
          me.clearInput();
          me.getIncidencies();
          //me.action=""
        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
          me.action = "";
          // me.errorMessage= error.response.data.error;
        });
    },
    setAfectatActual(afectat){
        this.afectatActiu= afectat.id;

    },
    isMultiple(){
        this.multiple= true;
    },
    nouAfectat(){
        this.multiple= false;
      let afectat= {}

      this.afectats.push(afectat);

    //Creamos afectatFormComponent y le pasamos el afectat de la posición numAfectats y la posición que ocupará en la array;
        let ComponentClass= Vue.extend(afectatFormComponent)
        let form= new ComponentClass({
            propsData: { position: this.numAfectats, afectat: this.afectats[this.numAfectats] }
        });

        form.$mount()
        this.$refs.afectatsContainer.appendChild(form.$el)
       this.numAfectats++;
    },
    openModalVideo(){
        $('#modalVideo').modal('show');
    },
        openModalHelp(){
        $('#modalHelpbox').modal('show');
    },
    getMunicipis() {
      let me = this;
      axios
        .get("/municipis")
        .then((response) => {
          me.municipis = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    getTipusIncidencies(){
        let me = this;
      axios
        .get("/tipusincidencies")
        .then((response) => {
          console.log(response.data);
          me.tipusIncidencies = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    getAfectats(){
        let me = this;
      axios
        .get("/afectats")
        .then((response) => {
          console.log(response.data);

        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    getRecurs(){
        let me = this;
            axios
                .get("/recursos")
                .then(response => {
                    me.recursos = response.data;
                    me.getFreeRecurs();
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => (this.loading = false));
    },
    getFreeRecurs(){
        for(let i in this.recursos){
            if(!this.recursos[i].actiu){
                this.freeRecursos.push(this.recursos[i]);
            }
        }
    },
    notMultiple(){
        this.multiple= false;
    },
    assignRecurs(index, afectatId){
        // Aquí el id del afectado aún es el que tiene en la array! Lo substituiremos al añadir la incidencia.
        let recursId = Number(document.getElementById("recursosToAssign" + index).value);
        let infoRecurs = {
            recursos_id: recursId,
            hora_activacio: null,
            hora_mobilitzacio: null,
            hora_assistencia: null,
            hora_transport: null,
            hora_arribada_hospital: null,
            hora_transferencia: null,
            hora_finalitzacio: null,
            prioritat: null,
            desti: null,
            afectat_id: afectatId
        };
        // Los ponemos en el mismo orden que los afectados para ahorrarnos problemas.
        this.infoRecursos[afectatId]= infoRecurs;
        this.incidencia.infoRecursos = this.infoRecursos;

    },
    clearInput() {
      this.incidencia = {
        data: null,
        hora: null,
        telefon_alertant: null,
        adreca: null,
        adreca_complement: null,
        descripcio: null,
        nom_metge: null,
        tipus_incidencies_id: null,
        alertants_id: null,
        municipis_id: null,
        duracion: null,
      };
    },
    updateAlertant(alertant){
        this.alertantIncidencia= alertant;
    },
    toggleFormacio(){
        this.formacio = !this.formacio;
    },
    afegirIncidencia(){
        console.log(this.afectats)
        let me= this;
        console.log(me.afectats)
        me.afectats.forEach(function (afectat) {
             // guardamos el id que marca el orden de la array para poder recuperarlo luego.
            let oldId= afectat.id;
            afectat.id= null;
        axios
        .post("/afectats", afectat)
        .then(function (response) {
          console.log(response);
        //   debugger;
        //   Actualizamos toda la info de afectat con el id que nos devuelve la base de datos.
          afectat.id = response.data.id;
          me.incidencia.infoRecursos[oldId].afectat_id= response.data.id;
        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
          // me.errorMessage= error.response.data.error;

        });
        });

        // PROBLEMA: Llega aquí antes de guardar todos los afectats.
        // Ahora ya tenemos los datos para poder insertar la incidencia + incidencias_has_recursos
        this.createIncidencia();
  },
  toggleMultiple(){
      if(this.multiple) this.multiple = false;
      else this.multiple = true;
  }
  },
  created() {
    //this.selectIncidencies();
    this.getMunicipis();
    this.getTipusIncidencies();
    // this.getAfectats();
    this.getRecurs();
  },
  mounted() {
    console.log("Component mounted.");
    this.nouAfectat();
  },
  computed:{
      direccio: function(){
          return `${this.incidencia.adreca}, ${this.municipi.nom}`;
      }
  }
};
</script>
