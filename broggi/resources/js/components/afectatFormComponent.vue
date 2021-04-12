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
        <input type="radio" value="2" v-model="afectat.sexes_id" name="customRadioInline1" class="custom-control-input">
        <label class="custom-control-label" for="dona">Dona</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" value="1" v-model="afectat.sexes_id" name="customRadioInline1" class="custom-control-input">
        <label class="custom-control-label" for="home">Home</label>
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
      setAfectat(){
          this.$emit('setAfectat', this.afectat, this.position)
      }
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
