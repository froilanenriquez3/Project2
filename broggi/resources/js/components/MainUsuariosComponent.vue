<template>
    <div class="recursosMovilsContainer">
        <!-- Si no se selecciona una opción, se muestra la tabla -->
        <div v-show="action == ''">
        <button type="button" @click="selectAction('afegir')" class="btn btn-primary">Afegir</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">UserName</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Cogmons</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Recurs</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="usuari in usuaris" :key="usuari.id">
                    <td>{{ usuari.username }}</td>
                    <td>{{usuari.nom}}</td>
                    <td>{{usuari.cognom}}</td>
                    <td>{{usuari.email}}</td>
                    <td>{{usuari.rols_id}}</td>
                    <td>{{usuari.recurs}}</td>



                    <td>
                        <button
                            type="submit"
                            class="btn btn-warning btn-sm d-flex"
                        >
                           Editar
                        </button>
                    </td>
                    <td>
                        <button
                            id="deleteB"
                            type="submit"
                            class="btn btn-secondary btn-sm d-flex"
                        >
                            Esborrar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>

        <!-- Si se selecciona la opción añadir, se muestra el formulario -->
        <!-- <div v-show="action == 'afegir' || action == 'editar'">
            <div class="form-group row">
                <label class="col-2" for="codi">Codi</label>
                <input v-model="recurs.codi" class="col-10" type="text" id="codi" name="codi" />
            </div>
             <div class="form-group row">
            <label class="form-check-label col-2" for="actiu">Actiu</label>
            <div class="custom-control custom-checkbox col-10">
                <input class="form-check-input" type="checkbox"  v-model="recurs.actiu" value="actiu" name="actiu" id="actiu">
            </div>
        </div>
            <div class="form-group row">
            <label class="col-2" for="tipus_rescurs_id">Tipus</label>
            <select class="form-select" v-model="recurs.tipus_recursos_id" aria-label="Default select example">
                <option v-for="recurso in tipus_recursos" :key="recurso.id" :selected="recurso.id == recurs.tipus_recursos_id"
                v-bind:value="recurso.id" >{{recurso.tipus}}</option>
            </select>
            </div>


            <button v-if="action == 'afegir' " type="button" class="btn btn-primary">Afegir</button>
            <button v-else type="button" class="btn btn-warning">Editar</button>
        </div> -->

        <!-- Modal Delete -->
        <!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esborrar Recurs</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalText" class="modal-body">
            Està segur d'esborrar el recurs amb codi {{ recurs.codi}} ?
        </div>
        <div class="modal-footer">
            <button id="buttonDeleteModal" @click="deleteRecurs()" type="submit" class="btn btn-secondary">Esborrar</button>
        </div>
      </div>
    </div>
  </div> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            action: "",
            usuaris: [],
            tipus_usuaris:[],
            tipus_recurs: [],
            insert: false,
            usuari: {
                id: '',
                username: '',
                contrasenya: '',
                nom: '',
                cognoms: '',
                email: '',
                rols_id: '',
                recursos_id: ''
            }
        };
    },
    methods: {
        selectUsuaris() {
            let me = this;
            axios
                .get("/usuaris")
                .then(response => {
                    me.usuaris = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
        // selectAction(action, recurs) {
        //     this.action = action;
        //     if(action == 'editar' || action == 'borrar'){
        //         this.recurs = recurs;
        //     }

        // },
        // selectTipus(){
        //      let me = this;
        //     axios
        //         .get("/tipusrecursos")
        //         .then(response => {
        //             me.tipus_recursos = response.data;
        //             console.log(me.tipus_recursos);
        //         })
        //         .catch(error => {
        //             console.log(error);
        //         })
        //         .finally(() => (this.loading = false));
        // },
        // afegirRecurs(){
        //     let me= this;
        //     axios
        //         .post('/recursos', me.recurs)
        //         .then(function (response) {
        //             console.log(response);
        //             me.selectRecursos();
        //             me.action=""
        //         })
        //         .catch(error => {
        //             console.log(error.response.status);
        //             console.log(error.response.data);
        //             me.action=''
        //             // me.errorMessage= error.response.data.error;
        //         })
        // },
        // editarRecurs(){
        //                let me= this;
        //         axios
        //         .put('/recursos/' + me.recurs.id , me.recurs)
        //         .then(function (response) {
        //             console.log(response);
        //             me.selectRecursos();
        //             me.action=''
        //         })
        //         .catch(error => {
        //             console.log(error.response.status);
        //             console.log(error.response.data);
        //             me.action=''
        //             // me.errorMessage= error.response.data.error;
        //         })
        //     },
        //     confirmDeleteRecurs(recurs){
        //         this.recurs= recurs;
        //         $('#deleteModal').modal('show');
        //     },
        //     deleteRecurs(){
        //     let me= this;
        //     axios
        //         .delete('recursos/' + me.recurs.id)
        //         .then(response => {
        //             me.selectRecursos();
        //             $('#deleteModal').modal('hide');
        //             me.action=''
        //             //me.infoMessage= response.data.missatge;
        //         })
        //         .catch(error => {
        //             //me.errorMessage = error.response.data.error;
        //             $('#deleteModal').modal('hide');
        //             me.action=''
        //         })

        //     }
    },
    created() {
        this.selectUsuaris();
        // this.selectTipus();
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
