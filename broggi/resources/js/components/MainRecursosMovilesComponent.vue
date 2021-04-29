<template>
    <div class="recursosMovilsContainer">
        <!-- div para el mensaje de feedback -->
        <div v-show="infoMessage !=''" class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Info: </strong>
            {{infoMessage}}
            <button type="button" @click="resetMessage()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- fin del div para el mensaje de feedback -->
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
        <filter-select :name="'Tipus de Recurs'" :listToFilter="recursos" :filterBy="tipus_recursos" :filterField="'tipus'" :relatedId="'tipus_recursos_id'"
        @applyFilterResults="filter($event)"></filter-select>
        <!-- <button type="button" @click="selectAction('afegir')" class="btn btn-primary">Afegir</button> -->
        <!-- Si no hay nada que cumpla con lo buscado, no sale la tabla y solo mostramos mensaje -->
        <div v-if="itemsToDisplay.length == 0"> No s'han trobat elements d'aquestes característiques</div>

        <table v-else class="table" id="my-table" :per-page="perPage"
      :current-page="currentPage">
            <thead>
                <tr>
                    <th scope="col">Codi</th>
                    <th scope="col">Tipus</th>
                    <th scope="col">Actiu</th>

                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="recurs in paginator(itemsToDisplay)" :key="recurs.id">
                    <td>{{ recurs.codi }}</td>
                    <td>
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value="actiu"
                                id="actiu"
                                :checked="recurs.actiu"
                                disabled/>
                            <label class="form-check-label" for="actiu"></label>
                        </div>
                    </td>

                    <td>{{ recurs.recurs }}</td>

                    <td>
                        <button
                            type="submit"
                            class="btn btn-warning btn-sm d-flex"
                             @click="selectAction('editar', recurs)">
                           Editar
                        </button>
                    </td>
                    <td>
                        <button
                            id="deleteB"
                            type="submit"
                            class="btn btn-secondary btn-sm d-flex"
                             @click="confirmDeleteRecurs(recurs)">
                            Esborrar
                        </button>
                    </td>
                </tr>
            </tbody>

        </table>
        <div class="bottomTable">
            <b-pagination
                     v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    aria-controls="my-table"
            ></b-pagination>
            </div>
            <button type="button" @click="selectAction('afegir')" class="btn btn-primary">Afegir</button>
        </div>

        <!-- Si se selecciona la opción añadir, se muestra el formulario -->
        <div v-show="action == 'afegir' || action == 'editar'">
            <div class="form-group row">
                <label class="col-2" for="codi">Codi</label>
                <input v-model="recurs.codi" class="col-5" type="text" id="codi" name="codi" />
            </div>

            <div class="form-group row">
                <label class="col-2" for="tipus_rescurs_id">Tipus</label>
                <select class="form-select col-5" v-model="recurs.tipus_recursos_id" aria-label="Default select example">
                    <option v-for="recurso in tipus_recursos" :key="recurso.id"
                    v-bind:value="recurso.id" >{{recurso.tipus}}</option>
                </select>
            </div>
            <div class="form-group row">
                <label class="form-check-label col-2" for="actiu">Actiu</label>
                <div class="custom-control custom-checkbox col-10">
                    <input class="form-check-input" type="checkbox"  v-model="recurs.actiu" value="actiu" name="actiu" id="actiu">
                </div>
            </div>

            <map-insert :recurs="this.recurs" :action="action"></map-insert>

            <button v-if="action == 'afegir' " type="button" @click="afegirRecurs()"  class="btn btn-primary">Afegir</button>
            <button v-else type="button" @click="editarRecurs()" class="btn btn_editar_recurs btn-warning" style="margin-top:20">Editar</button>

            <button type="button" @click="cerrarPagina()" class="btn btn_editar_recurs ml-3 border border-dark">Enrere</button>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  </div>
    </div>
</template>

<script>
import FilterSelect from './filterSelect.vue';
import mapInsert from './mapInsert.vue';
export default {
  components: { FilterSelect, mapInsert },
    data() {
        return {
            infoMessage:'',
            errorMessage: '',
            itemsToDisplay: [],
            action: "",
            recursos: [],
            tipus_recursos:[],
            insert: false,
             perPage: 5,
            currentPage: 1,
            totalRows: '',
            recurs: {
                id: '',
                codi: '',
                actiu: '',
                tipus_recursos_id: '',
                lat: '',
                lon: ''
            },
            newLat: '',
            newLon: ''
        };
    },
    methods: {
        selectRecursos() {
            let me = this;
            axios
                .get("/recursos")
                .then(response => {
                    me.recursos= response.data;
                    // response.data.forEach(element => {
                    //     if (element.id != 1){
                    //         me.recursos.push(element);
                    //     }
                    // });
                    // me.recursos = response.data;
                    me.recursos.splice(0,1);
                    me.itemsToDisplay= me.recursos;
                    me.totalRows= me.itemsToDisplay.length;

                })
                .catch(error => {
                    me.errorMessage= error.response.data.error;
                    console.log(error);
                    me.errorMessage= error.response.data.error;
                })
                .finally(() => (this.loading = false));
        },
        resetError(){
            this.errorMessage= '';
        },
        resetMessage(){
            this.infoMessage='';
        },
        selectAction(action, recurs) {
            this.action = action;
            if(action == 'editar' || action == 'borrar'){
                this.recurs = recurs;
            } else {
                this.cleanResource;
            }

        },

        cleanResource(){
                this.recurs.id='';
                this.recurs.codi='';
                this.recurs.actiu= false;
                this.recurs.tipus_recursos_id='';
                this.recurs.lat='';
                this.recurs.lon='';
                this.recurs.recurs='';
        },
        filter(itemsFiltered){
            this.itemsToDisplay= itemsFiltered;
            this.totalRows= this.itemsToDisplay.length;
        },
        selectTipus(){
             let me = this;
            axios
                .get("/tipusrecursos")
                .then(response => {
                    me.tipus_recursos = response.data;
                    console.log(me.tipus_recursos);

                })
                .catch(error => {
                    me.errorMessage= error.response.data.error;
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
            afegirRecurs(){
            this.retrieveLatLng();
            let me= this;
            axios
                .post('/recursos', me.recurs)
                .then(function (response) {
                    console.log(response);
                    me.selectRecursos();
                    me.action=""
                    // me.infoMessage = response.data.message;
                })
                .catch(error => {
                    console.log(error.response.status);
                    console.log(error.response.data);
                    me.action=''
                    me.errorMessage= error.response.data.error;
                })
            this.resetLatLng();
            this.cleanResource();
        },
        retrieveLatLng(){
           let latLngString= document.getElementById('latLongInfo').innerHTML;
           let latLng= latLngString.split(';');
           this.recurs.lon= latLng[0];
           this.recurs.lat= latLng[1];
        },
        resetLatLng(){
            // Volvemos a dejar los valores por defecto.
           document.getElementById('latLongInfo').innerHTML="1.8676800;41.8204600";
        },
        editarRecurs(){
                this.retrieveLatLng();
                let me= this;
                axios
                .put('/recursos/' + me.recurs.id , me.recurs)
                .then(function (response) {
                    console.log(response);
                    me.selectRecursos();
                    me.action=''
                    // me.infoMessage = response.data.message;
                })
                .catch(error => {
                    console.log(error.response.status);
                    console.log(error.response.data);
                    me.action=''
                    me.errorMessage= error.response.data.error;
                })
                .finally(() =>{
                    this.selectRecursos();
                });

                this.resetLatLng();
                this.cleanResource();

            },
            confirmDeleteRecurs(recurs){
                this.recurs= recurs;
                $('#deleteModal').modal('show');
            },
            deleteRecurs(){
            let me= this;
            axios
                .delete('recursos/' + me.recurs.id)
                .then(response => {
                    me.selectRecursos();
                    me.itemsToDisplay= me.selectRecursos()
                    $('#deleteModal').modal('hide');
                    me.action=''
                    //me.infoMessage= response.data.missatge;
                    me.infoMessage = response.data.message;
                })
                .catch(error => {
                    me.errorMessage = error.response.data.error;
                    $('#deleteModal').modal('hide');
                    me.action=''
                })
                .finally(() =>{
                    this.selectRecursos();
                });

            },
             paginator(recursos) {
        //  Devuelve parte del array que va a usar esa página concreta.
      const beginning = (this.currentPage - 1) * this.perPage;
      const end =
       beginning + this.perPage > recursos.length
          ? recursos.length
          : beginning  + this.perPage;
      return recursos.slice(beginning , end );
    }, cerrarPagina(){
        this.selectRecursos();
        this.action=""
    }
    },
    created() {
        this.selectRecursos();
        this.selectTipus();
    },
    mounted() {
        // console.log("Component mounted.");
    }
};
</script>
<style>
    .btn_editar_recurs{
        margin-top : 2em;
        float: right;
        margin-left: 2em;

    }
</style>
