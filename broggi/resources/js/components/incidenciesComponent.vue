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
        <!-- Tag incidencias -->
        <div v-show="section == 'Incident' || section == 'Tot'">
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

    <!-- Tag Alertante -->
    <alertant-form :municipis="municipis" @onSectionChanges="updateAlertant($event)" :section="section" v-show="section == 'Alertant' || section == 'Tot'"></alertant-form>

    <!-- Tag Afectado -->
    <!-- add fa plus icon -->
    <div v-show="section == 'Afectats' || section == 'Tot'">
        <div class="form-group row">
      <label class="col-2" for="numAfectats">Nombre d'afectats</label>
      <input class="col-10" type="number" min="1" name="numAfectats" v-model="numAfectats" @change="adjustAfectatsArray()"/>
    </div>

    <div v-if="numAfectats < 4">
            <afectat-form @setAfectat="guardarAfectat" v-for="(afectat, index) in afectats" :position="index" :key="index"></afectat-form>
    </div>

    <div v-else>
        <div class="form-group row">
      <label class="col-2" for="numDones">Número de dones afectades</label>
      <input class="col-10" min="0" type="number" name="numDones" v-model="numDones"/>
    </div>
    <div class="form-group row">
      <label class="col-2" for="numDones">Número d'homes afectats</label>
      <input class="col-10" min="0" type="number" name="numHomes" v-model="numDones"/>
    </div>
    </div>
    </div>



    <!-- Tag Recursos -->
    <map-component :direccioCompleta="direccio" v-show="section == 'Recursos' || section == 'Tot'"></map-component>


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
          <h5 class="modal-title" id="modalVideolLabel">Vídeo CPR</h5>
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


    <button class="btn btn-primary" @click="createIncidencia()">
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
      numAfectats: '',
      afectats: [],
      municipis: [],
      numDones: '',
      numHomes: '',
      municipi: {},
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
        /* infoRecursos: [
        {
            recursos_id: 1,
            hora_activacio: "01:00:00",
            hora_mobilitzacio: "01:00:00",
            hora_assistencia: "01:00:00",
            hora_transport: "01:00:00",
            hora_arribada_hospital: "01:00:00",
            hora_transferencia: "01:00:00",
            hora_finalitzacio: "01:00:00",
            prioritat: 3,
            desti: "Hospital clinic",
            afectat_id: 1
        }
        ] */
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
    createIncidencia() {
      console.log("submitting incidencia");
      console.log(this.incidencia);
      let me = this;
      axios
        .post("/incidencies", me.incidencia)
        .then(function (response) {
          alert("Incidencia inserted correctly!");

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
    adjustAfectatsArray(){
        // reseteamos afectats
        this.afectats = [];
        let afectat = {
            id: '',
            telefon: '',
            cip: '',
            nom: '',
            cognoms: '',
            edat: '',
            te_cip: '',
            sexes_id: ''
        }

        for(let i= 0; i< this.numAfectats; i++){
            this.afectats.push(afectat)
        }
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
    guardarAfectat: function(afectat, position){
        this.afectats[position]= afectat;
    },
    toggleFormacio(){
        this.formacio = !this.formacio;
    }
  },
  created() {
    //this.selectIncidencies();
    this.getMunicipis();
    this.getTipusIncidencies();
  },
  mounted() {
    console.log("Component mounted.");
  },
  computed:{
      direccio: function(){
          return `${this.incidencia.adreca}, ${this.municipi.nom}`;
      }
  }
};
</script>
