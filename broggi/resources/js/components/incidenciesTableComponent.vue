<template>
    <div id="incTableDiv">
        <!-- Filtro -->
        <filter-select :name="'Tipus inciencia:'" :listToFilter="incidencies" :filterBy="tipusIncidencies" :filterField="'tipus'"
        :relatedId="'tipus_incidencies_id'" @applyFilterResults="filter($event)">
        </filter-select>
        <!-- Si no hay nada que cumpla con lo buscado, no sale la tabla y solo mostramos mensaje -->
        <div v-if="itemsToDisplay.length == 0"> No s'han trobat elements d'aquestes característiques</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Incidencia ID</th>
                    <th>Data</th>
                    <th>Telefon Alertant</th>
                    <th>Adreca</th>
                    <th>Tipus Incidencia</th>
                    <th>Descripcio</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="incidencia in paginator(itemsToDisplay)" :key="incidencia.id">
                    <td>{{ incidencia.id }}</td>
                    <td>{{ incidencia.data}}</td>
                    <td>{{ incidencia.telefon_alertant}}</td>
                    <td>{{ incidencia.adreca }}</td>
                    <td>{{ incidencia.tipus_incidencia.tipus}}</td>
                    <td>{{ incidencia.descripcio.substring(0,20)}}</td>
                    <td> <button class="btn btn-warning">Editar</button> </td>
                    <td> <button class="btn btn-secondary" @click="confirmDelete(incidencia)" >Esborrar</button> </td>
                </tr>
            </tbody>
        </table>
         <b-pagination
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            aria-controls="my-table">
        </b-pagination>


         <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Esborrar incidencia</h5>
                <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalText" class="modal-body">
                Està segur d'esborrar el incidencia {{ incidencia.id }} ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Tancar
                </button>
                <button id="buttonDeleteModal" @click="deleteIncidencia()" type="submit"
                class="btn btn-secondary">
                    Esborrar
                </button>
            </div>
        </div>
      </div>
    </div>



    </div>
</template>

<script>
    import FilterSelect from './filterSelect.vue';
    export default {
         components: { FilterSelect },
        data(){
            return {
                itemsToDisplay: [],
                perPage: 5,
                currentPage: 1,
                totalRows: '',
                incidencia: {
                    id: null,
                },
                incidencies: [],
                incidenciesRecursos: [],
                incRecs: [],
                tipusIncidencies: []
            }
        },
        methods : {
            paginator(incidencies){
                const beginning = (this.currentPage - 1) * this.perPage;
                const end =
                beginning + this.perPage > incidencies.length
                    ? incidencies.length
                    : beginning  + this.perPage;
                return incidencies.slice(beginning , end );
            },
            selectIncidencies(){
                let me = this;
                axios
                    .get("/incidencies")
                    .then((response) => {
                        console.log(response.data);
                    me.incidencies = response.data;
                    me.itemsToDisplay= me.incidencies;
                    console.log(me.incidencies);
                    /* response.data.forEach(incidencia => {
                        incidencia.incidencies_has_recursos.forEach( i =>{
                             me.incRecs.push(i);
                        });
                    }); */

                    me.incidencies.forEach( incidencia =>{
                        me.showIncidenciaRecurso(incidencia.id);
                    });

                    })
                    .catch((error) => {
                    console.log(error);
                    })
                    .finally(() => {
                        this.loading = false;
                        // console.log("Select incidencies" + me.incRecs);

                    });

                this.totalRows = this.incidencies.length;
            },
            filter(itemsFiltered){
            this.itemsToDisplay= itemsFiltered;
            this.totalRows= this.itemsToDisplay.length;
            },
             showIncidenciaRecurso(id){
                let me = this;
                axios
                    .get("/incidencies/" + id)
                    .then((response) => {
                        // console.log(response.data);
                        me.incidencia = response.data;
                        me.incidencia.incidencies_has_recursos.forEach(i => {
                            me.incRecs.push(i);
                        });
                        // me.itemsToDisplay= me.incRecs;
                        me.totalRows= me.itemsToDisplay.length;
                    })
                    .catch((error) => {
                    console.log(error);
                    })
                    .finally(() => {
                        this.loading = false;
                        // console.log(me.incidencia);
                    });

            },
            getTipusIncidencies(){
                let me = this;
            axios
                .get("/tipusincidencies")
                .then((response) => {
                // console.log(response.data);
                me.tipusIncidencies = response.data;
                })
                .catch((error) => {
                console.log(error);
                })
                .finally(() => (this.loading = false));
            },
            deleteIncidencia(){
                let me = this;
                axios
                    .delete("/incidencies/" + me.incidencia.id)
                    .then(response => {
                        console.log(response.data)
                        me.selectIncidencies();
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    })
                    .finally(()=> {
                        $("#deleteModal").modal("hide");
                    });
            },
            confirmDelete(incidencia){
                this.incidencia = incidencia;
                $("#deleteModal").modal("show");
            }
        },
        mounted() {
            // console.log('Component mounted.');
            this.selectIncidencies();
            this.getTipusIncidencies();
        }
    }
</script>
