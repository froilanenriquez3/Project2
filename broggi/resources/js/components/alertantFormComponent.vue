<template>
  <div>
        <!-- div para el mensaje de error -->
        <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong>Error: </strong>
            {{errorMessage}}
            <button type="button" @click="resetError()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- fin del div para el mensaje de error -->
        <div id="alertantsDiv">
        <div>
            <h5>Alertant</h5>

            <div class="form-group row">
            <label class="col-2" for="telefon"><b>Telefon Alertant</b></label>
            <input class="col-4" required type="tel" name="telefon" v-model="alertant.telefon"/>
            <button @click="searchAlertant()" class="btn btn-primary ml-4">Buscar a base de dades</button>
            <p v-show="!isFound">No hi ha cap alertant a la base de dades amb aquest telèfon.</p>
            </div>

            <div class="form-group row">
                <label class="col-2" for="tipus_alertant"><b>Tipus</b></label>
                <select class="form-select col-4" v-model="alertantCopia.tipus_alertants_id" aria-label="Default select example">
                    <option v-for="tipus in tipus_alertants" :key="tipus.id"
                    v-bind:value="tipus.id" >{{tipus.tipus}}</option>
                </select>
            </div>

            <div class="form-group row">
            <label class="col-2" for="nom">Nom</label>
            <input class="col-10" type="text" name="nom" v-model="alertantCopia.nom"/>
            </div>

            <div class="form-group row">
            <label class="col-2" for="cognoms">Cognoms</label>
            <input class="col-10" type="text" name="cognoms" v-model="alertantCopia.cognoms"/>
            </div>

            <div class="form-group row">
            <label class="col-2" for="adreça">Adreça</label>
            <input class="col-10" type="text" name="adreça" v-model="alertantCopia.adreca"/>
            </div>

            <div class="form-group row">
            <label class="col-2" for="municipi_alertant">Municipi</label>
            <select class="form-select col-4" v-model="alertantCopia.municipis_id" aria-label="Default select example">
                    <option v-for="municipi in municipis" :key="municipi.id"
                    v-bind:value="municipi.id" >{{municipi.nom}}</option>
                </select>
            </div>

        </div>

        <button v-show="!isFound" @click="guardarAlertant()" class="btn btn-primary">Guardar com alertant Habitual</button>

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
        },
          editincidencia:{
            required: false
        }
    },
    data() {
    return {
      errorMessage:'',
      action: "",
      alertants: [],
      tipus_alertants: [],
      isFound: true,
      alertantCopia: {
          nom: '',
          cognoms: '',
          adreca: '',
          municipis_id: '',
          tipus_alertants_id: ''
      }
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
            me.errorMessage= error.response.data.error;
            console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    getAlertants() {
      let me = this;
      axios
        .get("/alertants")
        .then((response) => {
          me.alertants = response.data;
        })
        .catch((error) => {
            me.errorMessage= error.response.data.error;
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
          me.errorMessage= error.response.data.error;
        });
<<<<<<< HEAD
    },
    resetError(){
        this.errorMessage='';
    }
  },
    
=======
        },
    resetError(){
        this.errorMessage='';
    },
    searchAlertant(){
        let trobat= this.alertants.find( alertant => alertant.telefon == this.alertant.telefon);
        console.log(trobat)
        if(trobat == undefined){
            this.isFound = false;
        } else {
            this.isFound = true;
            this.alertantCopia.nom= trobat.nom;
            this.alertantCopia.cognoms= trobat.cognoms;
            this.alertantCopia.adreca= trobat.adreca;
            this.alertantCopia.municipis_id= trobat.municipis_id;
            this.alertantCopia.tipus_alertants_id= trobat.tipus_alertants_id;

            this.$emit('dadesAfectat', this.alertantCopia);
        }
    },
  }
  ,

>>>>>>> d667adfd2be7421fb69ff08df88983bed59c1df4
  created(){
      this.selectTipus();
      this.getAlertants();
  },
  mounted() {
    // console.log("Component mounted.");
  },
//   Cada vez que la copia de alertant cambie la emitimos a incidencias, para tener los cambios allí.
  watch: {
      alertantCopia: function(){
          this.$emit('dadesAfectat', this.alertantCopia);
    }
  }

  }
</script>
