<template>
  <div class="container">
    <!-- div para el mensaje de error -->
    <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
        <strong>Error: </strong>
        {{errorMessage}}
        <button type="button" @click="resetError()" class="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- fin del div para el mensaje de error -->
    <div class="form-group row">
      <label class="col-2" for="nom">Nom</label>
      <input
        class="col-10"
        type="text"
        id="nom"
        name="nom"
        v-model="alertant.nom"
      />
    </div>
    <div class="form-group row">
      <label class="col-2" for="cognoms">Cognoms</label>
      <input
        class="col-10"
        type="text"
        id="cognoms"
        name="cognoms"
        v-model="alertant.cognoms"
      />
    </div>
    <div class="form-group row">
      <label class="col-2" for="telefon">Telefon</label>
      <input
        class="col-10"
        type="tel"
        id="telefon"
        name="telefon"
        v-model="alertant.telefon"
      />
    </div>
    <div class="form-group row">
      <label class="col-2" for="adreca">Adreca</label>
      <input
        v-model="alertant.adreca"
        class="col-10"
        type="text"
        id="adreca"
        name="adreca"
      />
    </div>
    <div class="form-group row">
      <label class="col-2" for="municipis_id">Municipi</label>
      <select class="col-10" name="municipis_id" id="municipis_id" v-model="alertant.municipis_id">
          <option  v-for="municipi in municipis"
          :key="municipi.id"
          v-bind:value="municipi.id">{{municipi.nom}}</option>
      </select>
    </div>
    <div class="form-group row">
      <label class="col-2" for="tipus_alertants_id">Tipus d'Alertant</label>
      <select class="col-10" name="tipus_alertants_id" id="tipus_alertants_id" v-model="alertant.tipus_alertants_id">
        <option
          v-for="alertant in tipus_alertants"
          :key="alertant.id"
          :selected="alertant.id == alertant.tipus_alertants_id"
          v-bind:value="alertant.id"
        >
          {{ alertant.tipus }}
        </option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
    props: {
        insert: {
            required: "yes"
        },
        editedalertant: {
        }
    },
  data() {
    return {
      errorMessage:'',
      action: "",
      //alertants: [],
      tipus_alertants: [],
      municipis: [],
      alertant: {
        id: "",
        telefon: "",
        nom: "",
        cognoms: "",
        adreca: "",
        municipis_id: "",
        tipus_alertants_id: "",
      },
    };
  },
  methods: {
    createAlertant() {
      let me = this;
      if (me.insert == true){
           axios
        .post("/alertants", me.alertant)
        .then(function (response) {
          console.log(response);
          window.location.href = "/Project2/broggi/public/alertants";

        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
          me.errorMessage= error.response.data.error;
        });
      } else{
         axios
        .put("/alertants/" + me.alertant.id, me.alertant)
        .then(function (response) {
          console.log(response);
          window.location.href = "/Project2/broggi/public/alertants";
        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
          me.errorMessage= error.response.data.error;
        });
      }

    },
    selectTipus() {
      let me = this;
      axios
        .get("/tipusalertants")
        .then((response) => {
          me.tipus_alertants = response.data;
          console.log(me.tipus_alertants);
        })
        .catch((error) => {
          me.errorMessage= error.response.data.error;
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    selectMunicipis(){
         let me = this;
      axios
        .get("/municipis")
        .then((response) => {
          me.municipis = response.data;
          console.log(me.municipis);
        })
        .catch((error) => {
          me.errorMessage= error.response.data.error;
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    setInputs(){
        let me = this;
        if(me.editedalertant != null){
            me.alertant = me.editedalertant;
        }
    },
    resetError(){
            this.errorMessage= '';
    }
  },
  created() {
    this.selectMunicipis();
    this.selectTipus();
    this.setInputs();
  },
  mounted() {
    let me = this;
     document.getElementById("formSubmit").onclick = function () {
      me.createAlertant();
    };
    console.log(this.insert);
    console.log(this.editedalertant);

    // console.log("Component mounted.");
  },
    
};
</script>
