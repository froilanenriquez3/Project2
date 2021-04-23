<template>
    <div class="recursosMovilsContainer">
        <!-- div para el mensaje de error -->
        <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong>Error: </strong>
            {{errorMessage}}
            <button type="button" @click="resetError()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
     	</div>
        <!-- fin del div para el mensaje de error -->
        <!-- Si no se selecciona una opción, se muestra la tabla -->
        <div v-show="action == ''">
        <!-- Filtro -->
        <filter-select :name="'Rol'" :listToFilter="usuaris" :filterBy="rols" :filterField="'nom'" :relatedId="'rols_id'"
        @applyFilterResults="filter($event)"></filter-select>

        <button type="button"
        @click="selectAction('afegir')"
        class="btn btn-primary">Afegir</button>

        <!-- Si no hay nada que cumpla con lo buscado, no sale la tabla y solo mostramos mensaje -->
        <div v-if="itemsToDisplay.length == 0"> No s'han trobat elements d'aquestes característiques</div>

        <table v-else class="table">
            <thead>
                <tr>
                    <th scope="col">Nom d'usuari</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Cogmons</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                    <!-- TODO: Añadir recurso si el usuario és recurs. -->

                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr id="my-table" v-for="usuari in paginator(itemsToDisplay)" :key="usuari.id">
                    <td>{{ usuari.username }}</td>
                    <td>{{usuari.nom}}</td>
                    <td>{{usuari.cognoms}}</td>
                    <td>{{usuari.email}}</td>
                    <td>{{usuari.rols}}</td>

                    <td>
                        <button
                            type="submit"
                            class="btn btn-warning btn-sm d-flex"
                            @click="selectAction('editar', usuari)"
                        >
                           Editar
                        </button>
                    </td>
                    <td>
                        <button
                            id="deleteB"
                            type="submit"
                            class="btn btn-secondary btn-sm d-flex"
                            @click="confirmDeleteUsuari(usuari)"
                        >
                            Esborrar
                        </button>
                    </td>
                </tr>
            <b-pagination
                     v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    aria-controls="my-table"
            ></b-pagination>
            </tbody>
        </table>
        </div>

        <!-- Si se selecciona la opción añadir, se muestra el formulario -->
        <div v-show="action == 'afegir' || action == 'editar'">
            <div class="form-group row">
                <label class="col-2" for="username">Nom d'usuari</label>
                <input v-model="usuari.username" class="col-10" type="text" id="userName" name="username" />
            </div>

            <div class="form-group row">
                <label class="col-2" for="contrasenya">Contrasenya</label>
                <input v-model="usuari.contrasenya" class="col-10" type="password" id="contrasenya" name="contrasenya" />
            </div>

            <div class="form-group row">
                <label class="col-2" for="nom">Nom</label>
                <input v-model="usuari.nom" class="col-10" type="text" id="nom" name="nom" />
            </div>

            <div class="form-group row">
                <label class="col-2" for="contrasenya">Cognoms</label>
                <input v-model="usuari.cognoms" class="col-10" type="text" id="cognoms" name="cognoms" />
            </div>

            <div class="form-group row">
                <label class="col-2" for="email">Email</label>
                <input v-model="usuari.email" class="col-10" type="text" id="email" name="email" />
            </div>

            <div class="form-group row">
            <label class="col-2" for="rols_id">Rol</label>
            <select class="form-select col-10" v-model="usuari.rols_id" aria-label="Default select example">
                <option v-for="rol in rols" :key="rol.id" :selected="rol.id == usuari.rols_id"
                v-bind:value="rol.id" >{{rol.nom}}</option>
            </select>
            </div>
            <!-- TODO: Se tiene que cambiar ese 3 porque es muy cutre y si en la db cambiara, nunca saldría el recurso. -->
            <div v-if="usuari.rols_id === 3" class="form-group row">
            <label class="col-2" for="rols_id">Recurso asignado</label>
            <select class="form-select col-10" v-model="usuari.recursos_id" aria-label="Default select example">
                <option v-for="recurs in recursos" :key="recurs.id" :selected="recurs.id == usuari.recursos_id"
                v-bind:value="recurs.id" >{{recurs.codi}} - {{recurs.recurs.tipus}}</option>
            </select>
            </div>


            <button v-if="action == 'afegir' " @click="afegirUsuari()" type="button" class="btn btn-primary">Afegir</button>
            <button v-else @click="editarUsuari()" type="button" class="btn btn-warning">Editar</button>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esborrar Usuari</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalText" class="modal-body">
            Està segur d'esborrar l'usuari {{ usuari.nom}} {{ usuari.cognoms }} ?
        </div>
        <div class="modal-footer">
            <button id="buttonDeleteModal"  @click="deleteUsuari()" type="submit" class="btn btn-secondary">Esborrar</button>
        </div>
      </div>
    </div>
  </div>
    </div>
</template>

<script>
import FilterSelect from './filterSelect.vue';
export default {
    data() {
        return {
            errorMessage:'',
            itemsToDisplay: [],
            FilterSelect,
            action: "",
            usuaris: [],
            rols: [],
            recursos: [],
            insert: false,
            perPage: 5,
            currentPage: 1,
            totalRows: '',
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
                    me.itemsToDisplay= me.usuaris;
                    me.totalRows= me.itemsToDisplay.length;
                })
                .catch(error => {
                    me.errorMessage= error.response.data.error;
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
        filter(itemsFiltered){
            this.itemsToDisplay= itemsFiltered;
            this.totalRows= this.itemsToDisplay.length;
        },
        selectAction(action, usuari) {
            this.action = action;
            // Si editamos o borramos usuario, recuperamos el usuario que queremos
            if(action == 'editar' || action == 'borrar'){
                this.usuari = usuari;
            } else {
            // Si queremos añadir un usuario, borramos usuario para que no salgan los datos del anterior.
                // this.usuari= ''
                this.usuari.id= '';
                this.usuari.username= '';
                this.usuari.contrasenya= '';
                this.usuari.nom= '';
                this.usuari.cognoms= '';
                this.usuari.email= '';
                this.usuari.rols_id= '';
                this.usuari.recursos_id= '';
            }
        },
        selectRols(){
             let me = this;
            axios
                .get("/rols")
                .then(response => {
                    me.rols = response.data;
                    console.log(me.rols);
                })
                .catch(error => {
                    me.errorMessage= error.response.data.error;
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
        selectTipus(){
             let me = this;
            axios
                .get("/recursos")
                .then(response => {
                    me.recursos = response.data;
                    console.log(me.recursos);
                })
                .catch(error => {
                    me.errorMessage= error.response.data.error;
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
        afegirUsuari(){
            let me= this;
            axios
                .post('/usuaris', me.usuari)
                .then(function (response) {
                    console.log(response);
                    me.selectUsuaris();
                    me.action=""
                })
                .catch(error => {
                    console.log(error.response.status);
                    console.log(error.response.data);
                    me.action=''
                    me.errorMessage= error.response.data.error;
                })
                .finally(() =>{
                    this.selectUsuaris();
                });
        },
        paginator(usuaris) {
        //  Devuelve parte del array que va a usar esa página concreta.
      const beginning = (this.currentPage - 1) * this.perPage;
      const end =
       beginning + this.perPage > usuaris.length
          ? usuaris.length
          : beginning  + this.perPage;
      return usuaris.slice(beginning , end );
    },
        editarUsuari(){
                let me= this;
                axios
                .put('/usuaris/' + me.usuari.id , me.usuari)
                .then(function (response) {
                    console.log(response);
                    me.selectUsuaris();
                    me.action=''
                })
                .catch(error => {
                    console.log(error.response.status);
                    console.log(error.response.data);
                    me.action=''
                    me.errorMessage= error.response.data.error;
                })
                .finally(() =>{
                    this.selectUsuaris();
                });
            },
            confirmDeleteUsuari(usuari){
                this.usuari= usuari;
                $('#deleteModal').modal('show');
            },
            deleteUsuari(){
            let me= this;
            axios
                .delete('usuaris/' + me.usuari.id)
                .then(response => {
                    me.selectUsuaris();
                    $('#deleteModal').modal('hide');
                    me.action=''
                    //me.infoMessage= response.data.missatge;
                })
                .catch(error => {
                    me.errorMessage = error.response.data.error;
                    $('#deleteModal').modal('hide');
                    me.action=''
                })

            },
            resetError(){
                this.errorMessage='';
            }
    },
    created() {
        this.selectUsuaris();
        this.selectRols();
        this.selectTipus();
    },
    mounted() {
        // console.log("Component mounted.");
    }
};
</script>
