<template>
  <div class="container">

      <label class="" for="">Tipus Incidencia</label>
      <select class="" name=""></select>


    <div class="form-group row">
      <label class="col-2" for="">Adreça</label>
      <input class="col-10" type="tel" name="" />
    </div>
    <div class="form-group row">
      <label class="col-2" for="">Adreça Complement</label>
      <input class="col-10" type="tel" name="" />
    </div>
    <div>
        <label for="">Municipi</label>
        <select name="" id="">
          <option value=""></option>
        </select>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Hora</label>
      <input class="col-2" type="number" name="" />

      <label class="col-2" for="">Data</label>
      <input class="col-2" type="date" name="" />
    </div>

     <div class="form-group row">
      <label class="col-2" for="">Descripcio</label>
      <textarea class="col-10" type="" name=""> </textarea>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Nom Metge</label>
      <input class="col-10" type="tel" name="" />
    </div>

    <alertant-form></alertant-form>

    <br>

    <!-- add fa plus icon -->
    <button class="btn btn-primary" :click="addAlertantInput()">
      Añadir alertante
    </button>
  </div>
</template>

<script>
import alertantFormComponent from "./alertantFormComponent.vue";
export default {
  data() {
    return {
      alertantFormComponent,
      incidencia: {},
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
      let me = this;
      axios
        .post("/incidencies", me.incidencia)
        .then(function (response) {
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
    addAlertantInput() {
      //add limit for num alertants
      //let input = document.createElement("");
    },
    getMunicipis() {},
    getTipusAlertant() {},
  },
  created() {
    this.selectIncidencies();
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
