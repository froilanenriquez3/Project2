<template>
  <div class="container">
    <label class="" for="">Tipus Incidencia</label>
    <select class="" name="" v-model="incidencia.tipus_incidencies_id">
        <option value=""></option>
    </select>

    <div class="form-group row">
      <label class="col-2" for="">Adreça</label>
      <input class="col-10" type="tel" name="" v-model="incidencia.adreca"/>
    </div>
    <div class="form-group row">
      <label class="col-2" for="">Adreça Complement</label>
      <input class="col-10" type="tel" name="" v-model="incidencia.adreca_complement"/>
    </div>
    <div class="form-group row">
      <label class="col-2" for="">Municipi</label>
      <select class="col-10" name="" id="" v-model="incidencia.municipis_id">
        <option value=""></option>
      </select>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Hora</label>
      <input class="col-2" type="number" name="" v-model="incidencia.hora"/>

      <label class="col-2" for="">Data</label>
      <input class="col-2" type="date" name="" v-model="incidencia.data"/>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Descripcio</label>
      <textarea class="col-10" type="" name="" v-model="incidencia.descripcio"> </textarea>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Nom Metge</label>
      <input class="col-10" type="tel" name="" v-model="incidencia.nom_metge"/>
    </div>

    <!-- <alertant-form></alertant-form> -->

    <!-- add fa plus icon -->
    <button class="btn btn-primary" @click="addAfectatInput()">
      Añadir afectat
    </button>

    <!-- <afectat-form></afectat-form> -->

    <button class="btn btn-primary" @click="createIncidencia()">Afegir incidencia</button>

  </div>
</template>

<script>
import alertantFormComponent from "./alertantFormComponent.vue";
import afectatFormComponent from "./afectatFormComponent.vue";
export default {
  data() {
    return {
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
            duracion: null
      },
      incidencies: [],
    };
  },
  methods: {
    selectIncidencies() {
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
          me.selectIncidencies();
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
    getMunicipis() {},
    getTipusAlertant() {},
    clearInput(){
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
            duracion: null
      };
    }
  },
  created() {
    //this.selectIncidencies();
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
