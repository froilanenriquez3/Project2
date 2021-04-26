<template>

  <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- div para el mensaje de error -->
    <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
        <strong>Error: </strong>
        {{errorMessage}}
        <button type="button" @click="resetError()" class="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- fin del div para el mensaje de error -->
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esborrar Alertant</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalText" class="modal-body">
          Està segur d'esborrar el Alertant amb id {{ alertant.id }} ?
        </div>
        <div class="modal-footer">
          <button id="buttonDeleteModal" @click="deleteAlertant()" type="submit" class="btn btn-secondary">
            Esborrar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props:{
        alertant:{
            required: "yes"
        }
    },
    data(){
        return{
        errorMessage:'',
        id: "",
        alertantDelete: {
        id: "",
        telefon: "",
        nom: "",
        cognoms: "",
        adreca: "",
        municipis_id: "",
        tipus_alertants_id: "",
      }}
    },
    methods: {
         deleteAlertant(){
            let me= this;
            axios
                .delete('alertants/' + me.alertant.id)
                .then(response => {
                    console.log('Succesfully deleted');
                    window.location.reload();
                    // window.location.href = "/Project2/broggi/public/alertants";
                    $(me.id).modal('hide');
                    //me.infoMessage= response.data.missatge;
                })
                .catch(error => {
                    me.errorMessage = error.response.data.error;
                     $(me.id).modal('hide');
                })

            },
            resetError(){
            this.errorMessage= '';
            }

    },
    mounted() {
        this.alertantDelete = this.alertant;
        this.id = "deleteAlertantModal" + this.alertant.id;
        // console.log("Component mounted.");
    },

};
</script>
