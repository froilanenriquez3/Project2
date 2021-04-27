<template>
  <div class="container">
    <div id="afectatsDiv">
      <div>
        <h5>Afectat</h5>

        <div class="form-group row">
          <label class="col-2" for="">Telefon Afectat</label>
          <input class="col-4" v-model="afectat.telefon" type="tel" name="telefon" maxlength="9" />
        </div>

        <div class="form-group row">
          <label class="col-2" for=""><b>Nom</b></label>
          <input class="col-4" v-model="afectat.nom" type="text" name="nom" />

          <label class="col-2" for=""><b>Cognoms</b></label>
          <input class="col-4" v-model="afectat.cognoms" type="text" name="cognoms" />
        </div>

        <div class="form-group row">
          <label class="col-2" for=""><b>Edat</b></label>
          <input class="col-4" v-model="afectat.edat" type="number" name="edat" min="0" />

        </div>

         <div class="form-group row">
            <label class="form-check-label col-2" for="actiu">Té cip?</label>
            <div class="custom-control custom-checkbox col-4">
                <input v-model="afectat.te_cip" class="form-check-input" type="checkbox" value="te_cip" :name="nameCheckbox" :id="nameCheckbox">
            </div>
             <label class="col-2" for="">CIP</label>
          <input class="col-4" v-model="afectat.cip" type="text" name="cip" />
         </div>

        <div class="form-group row">
             <div class="custom-control custom-radio custom-control-inline col-2">
                <input type="radio" :id="idRadioDona" value="2" v-model="afectat.sexes_id" :name="nameRadio" class="custom-control-input ">
                <label class="custom-control-label" :for="idRadioDona">Dona</label>
            </div>

            <div class="custom-control custom-radio custom-control-inline col-2">
                <input type="radio" :id="idRadioHome" value="1" v-model="afectat.sexes_id" :name="nameRadio" class="custom-control-input">
                <label class="custom-control-label" :for="idRadioHome">Home</label>
            </div>
        </div>






        <br />
      </div>

    </div>
  </div>
</template>

<script>
export default {
    props: {
        position: {
            required: true
        },
        afectat:{
            required:true
        }
    },
    data() {
        return {
            afectatId:'',

        }
        },
  mounted() {
    // console.log("Component mounted.");
    // Id momentaneo para poder asignarlos a recursos. Cuando se inserten en la db,
    // los substituiremos por el id que tengan allí.
    this.afectat.id= this.position
  },
  computed: {
    // Añadimos la posición para que cada radio o checkbox de cada afectado tenga diferente ID.
    idRadioDona: function () {

      return 'dona'+this.position;
  },
   idRadioHome: function () {
      return 'home'+this.position;
  },
    nameRadio: function (){
        return 'radio'+this.position
    },
    nameCheckbox: function() {
        return 'checkbox'+this.position
    }
},
}
</script>
