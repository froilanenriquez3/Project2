<template>
  <div class="container">
    <div id="afectatsDiv">
      <div>
        <h5>Afectat</h5>

        <div class="form-group row">
          <label class="col-2" for="">Telefon Afectat</label>
          <input class="col-10" v-model="afectat.telefon" type="tel" name="telefon" />
        </div>

        <div class="form-group row">
          <label class="col-2" for="">CIP</label>
          <input class="col-10" v-model="afectat.cip" type="text" name="cip" />
        </div>

        <div class="form-group row">
          <label class="col-2" for="">Nom</label>
          <input class="col-10" v-model="afectat.nom" type="text" name="nom" />
        </div>

        <div class="form-group row">
          <label class="col-2" for="">Cognoms</label>
          <input class="col-10" v-model="afectat.cognoms" type="text" name="cognoms" />
        </div>

        <div class="form-group row">
          <label class="col-2" for="">Edat</label>
          <input class="col-10" v-model="afectat.edat" type="number" name="edat" />
        </div>

        <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" :id="idRadioDona" value="2" v-model="afectat.sexes_id" :name="nameRadio" class="custom-control-input">
        <label class="custom-control-label" :for="idRadioDona">Dona</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" :id="idRadioHome" value="1" v-model="afectat.sexes_id" :name="nameRadio" class="custom-control-input">
        <label class="custom-control-label" :for="idRadioHome">Home</label>
        </div>


        <br />
      </div>

      <button @click="setAfectat()" class="btn btn-primary">Guardar afectat</button>
    </div>
  </div>
</template>

<script>
export default {
    props: {
        position: {
            required: true
        }
    },
    data() {
        return {
            afectat: {
                telefon: '',
                cip: '',
                nom: '',
                cogmoms: '',
                edat: '',
                sexes_id:''
            }
        }
        },

  methods: {
      insertAfectat(){

          this.$emit('setAfectat', this.afectat, this.position)
      }
  },
  mounted() {
    console.log("Component mounted.");
  },
  computed: {
    // Añadimos la posición para que cada radio de cada afectado tenga diferente ID.
      idRadioDona: function () {

      return 'dona'+this.position;
  },
   idRadioHome: function () {

      return 'home'+this.position;
  },
    nameRadio: function (){
        return 'radio'+this.position
    }
}
}
</script>
