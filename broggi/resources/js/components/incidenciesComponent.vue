<template>
  <div class="container">

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
      <input class="col-2" type="number" name="" v-model="incidencia.hora" />

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
    <alertant-form @onSectionChanges="updateAlertant($event)" :section="section" v-show="section == 'Alertant' || section == 'Tot'"></alertant-form>

    <!-- Tag Afectado -->
    <!-- add fa plus icon -->
    <div v-show="section == 'Afectats' || section == 'Tot'">
    <button class="btn btn-primary" @click="addAfectatInput()">
      Añadir afectat
    </button>
    <afectat-form></afectat-form>
    </div>

    <!-- Tag Recursos -->
    <map-component v-show="section == 'Recursos' || section == 'Tot'"></map-component>



    <button class="btn btn-primary" @click="createIncidencia()">
      Afegir incidencia
    </button>
  </div>
</template>

<script>
import alertantFormComponent from "./alertantFormComponent.vue";
import afectatFormComponent from "./afectatFormComponent.vue";
import mapComponent from './mapComponent.vue';
export default {
  components: { mapComponent },
    props: {
        //Sección que se tiene que mostrar
        section: {
            type: String,
            required: true
        }
    },
  data() {
    return {
      tipusAlertants: [],
      tipusIncidencies: [],
      alertantIncidencia: {},
      municipis: [],
      afectatFormComponent,
      alertantFormComponent,
      incidencia: {
        data: null,
        hora: null,
        telefon_alertant: null,
        adreca: null,
        adreca_complement: null,
        descripcio: null,
        nom_metge: null,
        tipus_incidencies_id: 1,
        alertants_id: 1,
        municipis_id: 1,
        duracion: null,
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
    addAfectatInput() {
      //add limit for num alertants
      //let input = document.createElement("");
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
    // getTipusAlertant() {
    //   let me = this;
    //   axios
    //     .get("/tipusalertants")
    //     .then((response) => {
    //       me.tipusAlertants = response.data;
    //     })
    //     .catch((error) => {
    //       console.log(error);
    //     })
    //     .finally(() => (this.loading = false));
    // },
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
};
</script>
