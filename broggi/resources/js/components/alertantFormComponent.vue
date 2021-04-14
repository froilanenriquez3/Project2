<template>
  <div class="container">
    <div id="alertantsDiv">
      <div>
        <h5>Alertant</h5>

        <div class="form-group row">
         <label class="col-2" for="tipus_alertant">Tipus</label>
            <select class="form-select" v-model="alertant.tipus_alertants_id" aria-label="Default select example">
                <option v-for="tipus in tipus_alertants" :key="tipus.id"
                v-bind:value="tipus.id" >{{tipus.tipus}}</option>
            </select>
        </div>

        <div class="form-group row">
          <label class="col-2" for="nom">Nom</label>
          <input class="col-10" type="text" name="nom" v-model="alertant.nom"/>
        </div>

        <div class="form-group row">
          <label class="col-2" for="cognoms">Cognoms</label>
          <input class="col-10" type="text" name="cognoms" v-model="alertant.cognoms"/>
        </div>

        <div class="form-group row">
          <label class="col-2" for="telefon">Telefon Alertant</label>
          <input class="col-10" required type="tel" name="telefon" v-model="alertant.telefon"/>
        </div>

        <div class="form-group row">
          <label class="col-2" for="adreça">Adreça</label>
          <input class="col-10" type="text" name="adreça" v-model="alertant.adreca"/>
        </div>

        <div class="form-group row">
          <label class="col-2" for="municipi_alertant">Municipi</label>
           <select class="form-select" v-model="alertant.municipis_id" aria-label="Default select example">
                <option v-for="municipi in municipis" :key="municipi.id"
                v-bind:value="municipi.id" >{{municipi.nom}}</option>
            </select>
        </div>

      </div>

      <button @click="guardarAlertant()" class="btn btn-primary">Guardar com alertant Habitual</button>

    </div>
  </div>
</template>

<script>
export default {
    props: {
        //Sección que se está mostrando del formulario
        section: {
            type: String,
            required: true
        },
        // Vienen del padre para ahorrarnos una llamada a la api.
        municipis: {
            type: Array,
            required: true
        },
        alertant:{
            required: true
        }
    },
    data() {
    return {
      action: "",
      //alertants: [],
      tipus_alertants: [],
    };
  },
  methods: {
    selectTipus() {
      let me = this;
      axios
        .get("/tipusalertants")
        .then((response) => {
          me.tipus_alertants = response.data;
          me.totalRows= me.tipus_alertants.length;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
        guardarAlertant(){
      let me = this;
           axios
        .post("/alertants", me.alertant)
        .then(function (response) {
          console.log(response);
        // Pasamos id para guardarlo en alertants_id en incidencias.
          me.alertant.id = response.data.id;
        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
          // me.errorMessage= error.response.data.error;
        });
  }},
  created(){
      this.selectTipus();
  },
  mounted() {
    console.log("Component mounted.");
  }
}
</script>
