<template>
  <div class="container" >

    <div class="form-group row">
      <label class="col-2" for="nom">Nom</label>
      <input class="col-10" type="text" id="nom" name="nom"  v-model="alertant.nom"/>
    </div>
    <div class="form-group row">
      <label class="col-2" for="cognoms">Cognoms</label>
      <input class="col-10" type="text" id="cognoms" name="cognoms" v-model="alertant.cognoms" />
    </div>
    <div class="form-group row">
        <label class="col-2" for="telefon">Telefon</label>
        <input class="col-10" type="tel" id="telefon" name="telefon" v-model="alertant.telefon"/>
    </div>
    <div class="form-group row">
      <label class="col-2" for="adreca">Adreca</label>
      <input v-model="alertant.adreca"
        class="col-10"
        type="text"
        id="adreca"
        name="adreca"/>
    </div>
    <div class="form-group row">
      <label class="col-2" for="municipis_id">Municipi</label>
      <select class="col-10" name="municipis_id" id="municipis_id"></select>
    </div>
    <div class="form-group row">
        <label class="col-2" for="tipus_alertants_id">Tipus d'Alertant</label>
         <select class="col-10" name="tipus_alertants_id" id="tipus_alertants_id"></select>
    </div>

    <!-- </form> -->
  </div>
</template>

<script>

export default {
  data() {
    return {
      action: "",
      alertants: [],
      tipus_alertants: [],
      insert: false,
      alertant: {
        id: "",
        telefon: "",
        nom: "",
        cognoms: "",
        adreca: "",
        municipis_id: "1",
        tipus_alertants_id: "1"
      }
    };
  },
  methods: {
      createAlertant() {
      let me = this;
      axios
        .post("/alertants", me.alertant)
        .then(function (response) {
          console.log(response);
          me.action = "";
        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
          me.action = "";
          // me.errorMessage= error.response.data.error;
        });
    },
  },
  created() {
    //this.selectalertants();
    //this.selectTipus();
  },
  mounted() {
      let me = this;
    document.getElementById("formSubmit").onclick = function() {
        me.createAlertant();
    }
    console.log("Component mounted.");
  },
};
</script>
